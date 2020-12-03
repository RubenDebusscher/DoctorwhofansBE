<?php

use MediaWiki\MediaWikiServices;
use Wikimedia\TestingAccessWrapper;

/**
 * @group API
 * @group medium
 * @group Database
 * @covers ApiPageSet
 */
class ApiPageSetTest extends ApiTestCase {
	public static function provideRedirectMergePolicy() {
		return [
			'By default nothing is merged' => [
				null,
				[]
			],

			'A simple merge policy adds the redirect data in' => [
				function ( $current, $new ) {
					if ( !isset( $current['index'] ) || $new['index'] < $current['index'] ) {
						$current['index'] = $new['index'];
					}
					return $current;
				},
				[ 'index' => 1 ],
			],
		];
	}

	/**
	 * @dataProvider provideRedirectMergePolicy
	 */
	public function testRedirectMergePolicyWithArrayResult( $mergePolicy, $expect ) {
		list( $target, $pageSet ) = $this->createPageSetWithRedirect();
		$pageSet->setRedirectMergePolicy( $mergePolicy );
		$result = [
			$target->getArticleID() => []
		];
		$pageSet->populateGeneratorData( $result );
		$this->assertEquals( $expect, $result[$target->getArticleID()] );
	}

	/**
	 * @dataProvider provideRedirectMergePolicy
	 */
	public function testRedirectMergePolicyWithApiResult( $mergePolicy, $expect ) {
		list( $target, $pageSet ) = $this->createPageSetWithRedirect();
		$pageSet->setRedirectMergePolicy( $mergePolicy );
		$result = new ApiResult( false );
		$result->addValue( null, 'pages', [
			$target->getArticleID() => []
		] );
		$pageSet->populateGeneratorData( $result, [ 'pages' ] );
		$this->assertEquals(
			$expect,
			$result->getResultData( [ 'pages', $target->getArticleID() ] )
		);
	}

	protected function createPageSetWithRedirect() {
		$target = Title::makeTitle( NS_MAIN, 'UTRedirectTarget' );
		$sourceA = Title::makeTitle( NS_MAIN, 'UTRedirectSourceA' );
		$sourceB = Title::makeTitle( NS_MAIN, 'UTRedirectSourceB' );
		self::editPage( 'UTRedirectTarget', 'api page set test' );
		self::editPage( 'UTRedirectSourceA', '#REDIRECT [[UTRedirectTarget]]' );
		self::editPage( 'UTRedirectSourceB', '#REDIRECT [[UTRedirectTarget]]' );

		$request = new FauxRequest( [ 'redirects' => 1 ] );
		$context = new RequestContext();
		$context->setRequest( $request );
		$main = new ApiMain( $context );
		$pageSet = new ApiPageSet( $main );

		$pageSet->setGeneratorData( $sourceA, [ 'index' => 1 ] );
		$pageSet->setGeneratorData( $sourceB, [ 'index' => 3 ] );
		$pageSet->populateFromTitles( [ $sourceA, $sourceB ] );

		return [ $target, $pageSet ];
	}

	public function testHandleNormalization() {
		$context = new RequestContext();
		$context->setRequest( new FauxRequest( [ 'titles' => "a|B|a\xcc\x8a" ] ) );
		$main = new ApiMain( $context );
		$pageSet = new ApiPageSet( $main );
		$pageSet->execute();

		$this->assertSame(
			[ 0 => [ 'A' => -1, 'B' => -2, 'Å' => -3 ] ],
			$pageSet->getAllTitlesByNamespace()
		);
		$this->assertSame(
			[
				[ 'fromencoded' => true, 'from' => 'a%CC%8A', 'to' => 'å' ],
				[ 'fromencoded' => false, 'from' => 'a', 'to' => 'A' ],
				[ 'fromencoded' => false, 'from' => 'å', 'to' => 'Å' ],
			],
			$pageSet->getNormalizedTitlesAsResult()
		);
	}

	public function testSpecialRedirects() {
		$id1 = self::editPage( 'UTApiPageSet', 'UTApiPageSet in the default language' )
			->value['revision']->getTitle()->getArticleID();
		$id2 = self::editPage( 'UTApiPageSet/de', 'UTApiPageSet in German' )
			->value['revision']->getTitle()->getArticleID();

		$user = $this->getTestUser()->getUser();
		$userName = $user->getName();
		$userDbkey = str_replace( ' ', '_', $userName );
		$request = new FauxRequest( [
			'titles' => implode( '|', [
				'Special:MyContributions',
				'Special:MyPage',
				'Special:MyTalk/subpage',
				'Special:MyLanguage/UTApiPageSet',
			] ),
		] );
		$context = new RequestContext();
		$context->setRequest( $request );
		$context->setUser( $user );

		$main = new ApiMain( $context );
		$pageSet = new ApiPageSet( $main );
		$pageSet->execute();

		$this->assertEquals( [
		], $pageSet->getRedirectTitlesAsResult() );
		$this->assertEquals( [
			[ 'ns' => -1, 'title' => 'Special:MyContributions', 'special' => true ],
			[ 'ns' => -1, 'title' => 'Special:MyPage', 'special' => true ],
			[ 'ns' => -1, 'title' => 'Special:MyTalk/subpage', 'special' => true ],
			[ 'ns' => -1, 'title' => 'Special:MyLanguage/UTApiPageSet', 'special' => true ],
		], $pageSet->getInvalidTitlesAndRevisions() );
		$this->assertEquals( [
		], $pageSet->getAllTitlesByNamespace() );

		$request->setVal( 'redirects', 1 );
		$main = new ApiMain( $context );
		$pageSet = new ApiPageSet( $main );
		$pageSet->execute();

		$this->assertEquals( [
			[ 'from' => 'Special:MyPage', 'to' => "User:$userName" ],
			[ 'from' => 'Special:MyTalk/subpage', 'to' => "User talk:$userName/subpage" ],
			[ 'from' => 'Special:MyLanguage/UTApiPageSet', 'to' => 'UTApiPageSet' ],
		], $pageSet->getRedirectTitlesAsResult() );
		$this->assertEquals( [
			[ 'ns' => -1, 'title' => 'Special:MyContributions', 'special' => true ],
			[ 'ns' => 2, 'title' => "User:$userName", 'missing' => true ],
			[ 'ns' => 3, 'title' => "User talk:$userName/subpage", 'missing' => true ],
		], $pageSet->getInvalidTitlesAndRevisions() );
		$this->assertEquals( [
			0 => [ 'UTApiPageSet' => $id1 ],
			2 => [ $userDbkey => -2 ],
			3 => [ "$userDbkey/subpage" => -3 ],
		], $pageSet->getAllTitlesByNamespace() );

		$context->setLanguage( 'de' );
		$main = new ApiMain( $context );
		$pageSet = new ApiPageSet( $main );
		$pageSet->execute();

		$this->assertEquals( [
			[ 'from' => 'Special:MyPage', 'to' => "User:$userName" ],
			[ 'from' => 'Special:MyTalk/subpage', 'to' => "User talk:$userName/subpage" ],
			[ 'from' => 'Special:MyLanguage/UTApiPageSet', 'to' => 'UTApiPageSet/de' ],
		], $pageSet->getRedirectTitlesAsResult() );
		$this->assertEquals( [
			[ 'ns' => -1, 'title' => 'Special:MyContributions', 'special' => true ],
			[ 'ns' => 2, 'title' => "User:$userName", 'missing' => true ],
			[ 'ns' => 3, 'title' => "User talk:$userName/subpage", 'missing' => true ],
		], $pageSet->getInvalidTitlesAndRevisions() );
		$this->assertEquals( [
			0 => [ 'UTApiPageSet/de' => $id2 ],
			2 => [ $userDbkey => -2 ],
			3 => [ "$userDbkey/subpage" => -3 ],
		], $pageSet->getAllTitlesByNamespace() );
	}

	/**
	 * Test that ApiPageSet is calling GenderCache for provided user names to prefill the
	 * GenderCache and avoid a performance issue when loading each users' gender on it's own.
	 * The test is setting the "missLimit" to 0 on the GenderCache to trigger misses logic.
	 * When the "misses" property is no longer 0 at the end of the test,
	 * something was requested which is not part of the cache. Than the test is failing.
	 */
	public function testGenderCaching() {
		// Set up the user namespace to have gender aliases to trigger the gender cache
		$this->setMwGlobals( [
			'wgExtraGenderNamespaces' => [ NS_USER => [ 'male' => 'Male', 'female' => 'Female' ] ]
		] );
		$this->overrideMwServices();

		// User names to test with - it is not needed that the user exists in the database
		// to trigger gender cache
		$userNames = [
			'Female',
			'Unknown',
			'Male',
		];

		// Prepare the gender cache for testing - this is a fresh instance due to service override
		$genderCache = TestingAccessWrapper::newFromObject(
			MediaWikiServices::getInstance()->getGenderCache()
		);
		$genderCache->missLimit = 0;

		// Do an api request to trigger ApiPageSet code
		$this->doApiRequest( [
			'action' => 'query',
			'titles' => 'User:' . implode( '|User:', $userNames ),
		] );

		$this->assertSame( 0, $genderCache->misses,
			'ApiPageSet does not prefill the gender cache correctly' );
		$this->assertEquals( $userNames, array_keys( $genderCache->cache ),
			'ApiPageSet does not prefill all users into the gender cache' );
	}
}
