-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: doctorwhofans.be.mysql.service.one.com:3306
-- Gegenereerd op: 16 okt 2020 om 15:42
-- Serverversie: 10.3.25-MariaDB-1:10.3.25+maria~bionic
-- PHP-versie: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorwhofans_be`
--


DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afbeeldingen`
--
use doctorwhofans_be;





--
-- Tabelstructuur voor tabel `News`
--



-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `QuotesTabel`
--

CREATE TABLE `QuotesTabel` (
  `id` int(11) NOT NULL,
  `Quote` longtext NOT NULL,
  `Personage` text NOT NULL,
  `Aflevering` text NOT NULL,
  `QuotePic_old` text NOT NULL,
  `QuotePic` varchar(900) DEFAULT NULL,
  `Episode` int(11) NOT NULL,
  `Class` varchar(22) NOT NULL DEFAULT 'smallItem',
  `Level` decimal(19,4) NOT NULL DEFAULT 1.0000,
  `Q_Owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `QuotesTabel`
--

INSERT INTO `QuotesTabel` (`id`, `Quote`, `Personage`, `Aflevering`, `QuotePic_old`, `QuotePic`, `Episode`, `Class`, `Level`, `Q_Owner`) VALUES
(1, '<strong>Yaz</strong>: Have you got family?<br />\r\n<strong>The Doctor</strong>: No. Lost them a long time ago.<br />\r\n<strong>Ryan</strong>: How\'d you cope with that?<br />\r\n<strong>The Doctor</strong>: I carry them with me. What they would have thought, and said, and done. Make them a part of who I am. So even though they’re gone from the world, they’re never gone from me.', 'The Thirteenth Doctor<br />\r\nYasmin Khan (Yaz)<br />\r\nRyan', 'The Woman Who Fell to Earth', '', 'download.gif', 1465, '', '1.0000', 1),
(2, '<strong>Clara</strong>: You\'re going to help me?<br />\r\n<strong>The Doctor</strong>: Well, why wouldn\'t I help you?<br />\r\n<strong>Clara</strong>: Because what I just did. I--<br />\r\n<strong>The Doctor</strong>: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!<br />\r\n<strong>Clara</strong>: Then why are you helping me?<br />\r\n<strong>The Doctor</strong>: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor<br />\r\nClara Oswald', 'Dark Water', '', 'p02bvbyk.jpg', 1147, '', '1.0000', 1),
(3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'The Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', 1104, '', '1.0000', 1),
(4, 'People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'The Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', 1061, '', '1.0000', 1),
(5, 'No More.', 'The War Doctor<br />\r\nThe Moment disguised as Bad Wolf', 'Day of the Doctor', 'https://38.media.tumblr.com/85e176a1bc1a09035a000aaf36c3394f/tumblr_mwqao1Ruia1qijoeyo1_400.gif', 'tumblr_mwqao1Ruia1qijoeyo1_400.gif', 1135, '', '1.0000', 1),
(6, 'Everybody knows that everybody dies. But not every day. Not today. Some days are special. Some days are so, so blessed. Some days, nobody dies at all. Now and then, every once in a very long while, every day in a million days, when the wind stands fair and the Doctor comes to call, everybody lives.', 'River Song', 'Forest of the Dead', 'https://s-media-cache-ak0.pinimg.com/originals/7e/71/f0/7e71f0d49449ec12188ff26f18454f4b.jpg', '7e71f0d49449ec12188ff26f18454f4b.jpg', 1079, '', '1.0000', 1),
(7, '<strong>Clara</strong>: Who\'s that?<br />\r\n<strong>The Doctor</strong>: Never mind. Let\'s go back.<br />\r\n<strong>Clara</strong>: But who is he?<br />\r\n<strong>The Doctor</strong>: He\'s me. There\'s only me here. That\'s the point. Now let\'s get back.<br />\r\n<strong>Clara</strong>: But I never saw that one. I saw all of you. Eleven faces, all of them you! You\'re the eleventh Doctor!<br />\r\n<strong>The Doctor</strong>: I said he was me. I never said he was the Doctor.<br />\r\n<strong>Clara</strong>: I don\'t understand.<br />\r\n<strong>The Doctor</strong>: My name, my real name - that is not the point. The name I chose is the Doctor. The name you choose, is like... it\'s like a promise you make. He\'s the one who broke the promise.<br />\r\n<strong>The Doctor</strong>: Clara? Clara! Clara! The Doctor: He is my secret. ', 'The Eleventh Doctor<br />\r\nClara Oswald', 'Name of the Doctor', 'https://static2.hypable.com/wp-content/uploads/2013/12/quote8.png', '0b0bd4f3b2333a126a7ea4dc5bfd11f4.jpg', 1134, '', '1.0000', 1),
(8, 'Great men are forged in fire. It is the privilege of lesser men to light te flame. Whatever the cost.', 'The War Doctor', 'Day of The Doctor', 'https://i.imgur.com/V65alwD.jpg', 'V65alwD.jpg', 1135, '', '1.0000', 1),
(9, '<strong>The Eleventh Docto</strong>r: He\'s my secret<br />\r\n<strong>The War Doctor</strong>: What I did, I did without choice.<br />\r\n<strong>The Eleventh Doctor</strong>: I know.<br />\r\n<strong>The War Doctor</strong>: In the name of peace and Sanity.<br />\r\n<strong>The Eleventh Doctor</strong>: But not in the name of The Doctor.', 'The War Doctor<br />\r\nThe Eleventh Doctor', 'the Name of the Doctor', 'https://img.desmotivaciones.es/201305/descarga_171.jpg', '46c7fca47db66fd04ee132b902664e91.png', 1134, '', '1.0000', 1),
(10, 'I hope the ears are a bit less conspicuous this time.', 'The War Doctor', 'Day of the Doctor', '../images/Content/download.jpg', 'ears.jpg', 1135, '', '1.0000', 1),
(11, '<strong>Clara</strong>: It\'s no good, Bonnie. You can\'t win.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I don\'t care.<br />\r\n<strong>The Twelfth Doctor</strong>: Hi! Hello! Hello!<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, hello! Hi. Hi. Stop this. Stop this, please. Let me take both of these boxes away. We\'ll forgive, we\'ll forget. And the ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No.<br />\r\n<strong>Kate</strong>: Doctor, which of these buttons do I press? Doctor, which one? Truth or consequences?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Truth or consequences?<br />\r\n<strong>The Twelfth Doctor</strong>: This is the moment we\'ve all been waiting for. Make your mind up time!<br />\r\nOne of those buttons will destroy the Zygons, release the imbecile\'s gas. The other one detonates the nuclear warhead under the Black Archive. It\'ll destroy everyone in London. Bonnie. Bonnie, sweetheart! One of those buttons will unmask every Zygon in the world. The other one cancels their ability to change form. It\'ll make them human beings for ever. There are safeguards beyond safeguards. I did this on a very important day for me and this ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: This is wrong.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You are responsible for all the violence. All of the suffering.<br />\r\n<strong>The Twelfth Doctor</strong>: No, I\'m not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes.<br />\r\n<strong>The Twelfth Doctor</strong>: No.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes. You engineered this situation, Doctor. This is your fault.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not. It\'s your fault.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I had to do what I\'ve done.<br />\r\n<strong>The Twelfth Doctor</strong>: So did I.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been treated like cattle.<br />\r\n<strong>The Twelfth Doctor</strong>: So what.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been left to fend for ourselves.<br />\r\n<strong>The Twelfth Doctor</strong>: So\'s everyone.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>:&nbsp;It\'s not fair.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, it\'s not fair! Oh, I didn\'t realise that it was not fair! Well, you know what? My Tardis doesn\'t work properly and I don\'t have my own personal tailor.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: The things don\'t equate.<br />\r\n<strong>The Twelfth Doctor</strong>: These things have happened, Zygella. They are facts. You just want cruelty to beget cruelty. You\'re not superior to people who were cruel to you. you\'re just a whole bunch of new cruel people. A whole bunch of new cruel people being cruel to some other people, who\'ll end up being cruel to you. The only way anyone can live in peace is if they\'re prepared to forgive. Why don\'t you break the cycle?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why should we?<br />\r\n<strong>The Twelfth Doctor</strong>: What is it that you actually want?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: War.<br />\r\n<strong>The Twelfth Doctor</strong>: Ah. Ah, right. And when this war is over, when you have a homeland free from humans, what do you think it\'s going to be like? Do you know? Have you thought about it? Have you given it any consideration? Because you\'re very close to getting what you want. What\'s it going to be like? Paint me a picture. Are you going to live in houses? Do you want people to go to work? Will there be holidays? Oh! Will there be music? Do you think people will be allowed to play violins? Who\'s going to make the violins? Well? Oh, you don\'t actually know, do you? Because, like every other tantrumming child in history, Bonnie, you don\'t actually know what you want. So, let me ask you a question about this brave new world of yours. When you\'ve killed all the bad guys, and when it\'s all perfect and just and fair, when you have finally got it exactly the way you want it, what are you going to do with the people like you? The troublemakers. How are you going to protect your glorious revolution from the next one?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ll win.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, will you? Well, maybe, maybe you will win! But nobody wins for long. The wheel just keeps turning. So, come on. Break the cycle.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you still talking?<br />\r\n<strong>The Twelfth Doctor</strong>: Because I want to get you to see, and I\'m almost there!<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Do you know what I see, Doctor? A box. A box with everything I need. A fifty percent chance.<br />\r\n<strong>Kate</strong>: For us, too.<br />\r\n<strong>The Twelfth Doctor</strong>: And we\'re off! Fingers on buzzers! Are you feeling lucky? Are you ready to play the game? Who\'s going to be quickest? Who\'s going to be luckiest?<br />\r\n<strong>Kate</strong>: This is not a game!<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not a game, sweetheart, and I mean that most sincerely.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you doing this?<br />\r\n<strong>Kate</strong>: Yes, I\'d quite like to know that, too. You set this up. Why?<br />\r\n<strong>The Twelfth Doctor</strong>: Because it\'s not a game, Kate. This is a scale model of war. Every war ever fought, right there in front of you. Because it\'s always the same. When you fire that first shot, no matter how right you feel, you have no idea who\'s going to die! You don\'t know whose children are going to scream and burn! How many hearts will be broken! How many lives shattered! How much blood will spill until everybody does until what they were always going to have to do from the very beginning. Sit down and talk! Listen to me. Listen, I just, I just want you to think. Do you know what thinking is? It\'s just a fancy word for changing your mind.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I will not change my mind.<br />\r\n<strong>The Twelfth Doctor</strong>: Then you will die stupid. Alternatively, you could step away from that box, you can walk right out of that door and you could stand your revolution down.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No! I\'m not stopping this, Doctor. I started it. I will not stop it. You think they\'ll let me go, after what I\'ve done?<br />\r\n<strong>The Twelfth Doctor</strong>: You\'re all the same, you screaming kids. You know that? «Look at me, I\'m unforgivable.» Well, here\'s the unforeseeable. I forgive you. After all you\'ve done, I forgive you.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You don\'t understand. You will never understand.<br />\r\n<strong>The Twelfth Doctor</strong>: I don\'t understand? Are you kidding? Me? Of course I understand. I mean, do you call this a war? This funny little thing? This is not a war! I fought in a bigger war than you will ever know. I did worse things than you could ever imagine. And when I close my eyes I hear more screams than anyone could ever be able to count! And do you know what you do with all that pain? Shall I tell you where you put it? You hold it tight till it burns your hand, and you say this. No one else will ever have to live like this. No one else will have to feel this pain. Not on my watch!<br />\r\n<strong>The Twelfth Doctor</strong>: Thank you. Thank you.<br />\r\n<strong>Kate</strong>: I\'m sorry.<br />\r\n<strong>The Twelfth Doctor</strong>: I know. I know. Thank you. Well?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: It\'s empty, isn\'t it? Both boxes. There\'s nothing in them. Just buttons.<br />\r\n<strong>The Twelfth Doctor</strong>: Of course. And do you know how you know that? Because you\'ve started to think like me.<br />\r\n<strong>The Twelfth Doctor</strong>: It\'s hell, isn\'t it? No one should have to think like that. And no one will. Not on our watch. Gotcha.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: How can you be so sure?<br />\r\n<strong>The Twelfth Doctor</strong>: Because you have a disadvantage, Zygella. I know that face.<br />\r\n<strong>Kate</strong>: This is all very well, but we know the boxes are empty now. We can\'t forget that.<br />\r\n<strong>The Twelfth Doctor</strong>: No, well, er, you\'ve said that the last fifteen times. ', 'The Twelfth Doctor<br />\r\nKate Lethbridge Stewart<br />\r\nBonnie (Clara)<br />\r\nClara Oswald<br />\r\n', 'The Zygon Inversion', 'https://4.bp.blogspot.com/-mOOCMSXB_Zw/Vj-PTbzbF7I/AAAAAAAATpo/_WQGMIvi5-A/s1600/The%2BZygon%2BInversion%2BOsgood%2BBoxes.jpg', 'CTut-JZWEAAWRpT.jpg', 1157, 'wideItem', '2.0000', 1),
(12, 'A heartbreak is a burden to us all. Pitty the man with two.', 'Mme. Vastra', 'The Snowmen Prequel: Vastra Investigates ', 'https://s-media-cache-ak0.pinimg.com/736x/30/06/bb/3006bbb25afac8e546b486a3734d36ea.jpg', '3006bbb25afac8e546b486a3734d36ea.jpg', 1126, '', '1.0000', 1),
(13, 'I am not a good man! I am not a bad man. I am not a hero. And I\'m definitely not a president. And no, I\'m not an officer. Do you know what I am? I am an idiot, with a box and a screwdriver. Just passing through, helping out, learning. I don\'t need an army. I never have, because I\'ve got them. Always them. Because love, it\'s not an emotion. Love is a promise. ', 'The Twelfth Doctor', 'Death in Heaven', 'https://s-media-cache-ak0.pinimg.com/736x/b7/bf/00/b7bf0061c163ea867cdd1e0c6e28ffa8.jpg', 'b7bf0061c163ea867cdd1e0c6e28ffa8.jpg', 1148, '', '1.0000', 1),
(14, 'You gave me hope, and then you took it away. That\'s enough to make anyone dangerous. God knows what it will do to me.', 'The Eleventh Doctor', 'The Doctor\'s Wife', 'https://cdn.pastemagazine.com/www/articles/doctor-who-11%20is%20dangerous.gif', 'doctor-who-11 is dangerous.gif', 1108, '', '1.0000', 1),
(15, 'Better a broken heart than no heart at all.', 'The Eleventh Doctor', 'A Christmas Carol', 'https://25.media.tumblr.com/9abbc46e023538412436dd09f7a17923/tumblr_midplhjzqb1ron04jo1_r2_500.gif', 'tumblr_midplhjzqb1ron04jo1_r2_500.gif', 1104, '', '1.0000', 1),
(16, '<strong>The War Doctor</strong>: Are you capable of speaking without flapping your hands about?<br />\r\n<strong>The Eleventh Doctor</strong>: Yes. No. I demand to be incarcerated in the Tower immediately with my co-conspirators, Sandshoes and Grandad.<br />\r\n<strong>The War Doctor</strong>: Grandad?!<br />\r\n<strong>The Tenth Doctor</strong>: They\'re not sandshoes!<br />\r\n<strong>The War Doctor</strong>: Yes, they are!', 'The Eleventh Doctor<br />\r\nThe Tenth Doctor<br />\r\nThe War Doctor<br />\r\n', 'Day of the Doctor', 'https://s-media-cache-ak0.pinimg.com/736x/28/10/df/2810dfa35320c42fb97a451538cfa422.jpg', '2810dfa35320c42fb97a451538cfa422.jpg', 1135, '', '1.0000', 1),
(17, '<strong>River</strong>: When you love the Doctor, it\'s like loving the stars themselves! You don\'t expect a sunset to admire you back! And if I happen to find myself in danger, let me tell you, the Doctor is not stupid enough, or sentimental enough, and he is certainly not in love enough to find himself standing in it with me!<br />\r\n[She catches the Doctor\'s gaze, and the two look into each other\'s eyes.]<br />\r\n<strong>The Doctor</strong>: Hello, sweetie.<br />\r\n[River takes a moment to pull herself together.]<br />\r\n<strong>River</strong>: You are so doing those roots.<br />\r\n<strong>The Doctor</strong>: What, the roots of the sunset?<br />\r\n<strong>River</strong>: Don\'t you dare.<br />\r\n<strong>The Doctor</strong>: I\'ll have to check with the stars themselves.<br />\r\n<strong>River</strong>: Oh, shut up! I was just keeping them talking until it kicks off.', 'The Twelfth Doctor<br />\r\nRiver Song<br />\r\n', 'The Husbands of River Song', 'https://pm1.narvii.com/5960/564c5cf9bcae07a8338314a635eb0d4329c3bf30_hq.jpg', '564c5cf9bcae07a8338314a635eb0d4329c3bf30_hq.jpg', 1162, '', '1.0000', 1),
(18, 'Some people live more in 20 years then others do in 80.<br />\r\nIt is not the Time that matters, it is the person.', 'The Tenth Doctor', 'The Lazarus Experiment', 'https://static2.hypable.com/wp-content/uploads/2013/11/DWQuotes10.jpg?324e9a', '480084438-tumblr_mf7di8t5B91s0g3zwo1_500.gif', 1057, '', '1.0000', 1),
(19, 'That\'s how I see the universe. Every waking second I can see what is, what was, what could be, what must not. It\'s the burden of a Time Lord, Donna, and I\'m the only one left.', 'The Tenth Doctor', 'Fires of Pompeï', 'https://img04.deviantart.net/56a7/i/2013/018/5/6/burden_of_a_time_lord_by_lyricalmedley-d5rvcsl.jpg', '796269.gif', 1072, '', '1.0000', 1),
(20, '<strong>The Doctor</strong>: Times end, River, because they have to. Because there\'s no such thing as happy ever after. It\'s just a lie we tell ourselves because the truth is so hard.<br />\r\n<strong>River</strong>: No, Doctor. You\'re wrong. Happy ever after doesn\'t mean forever. It just means time. A little time. But that\'s not the sort of thing you could ever understand, is it?<br />\r\n<strong>The Doctor</strong>: Mmm. What do you think of the towers?<br />\r\n<strong>River</strong>: I love them.<br />\r\n<strong>The Doctor</strong>: Then why are you ignoring them?<br />\r\n<strong>River</strong>: They\'re ignoring me. But, then, you can\'t expect a monolith to love you back.<br />\r\n<strong>The Doctor</strong>: No, you can\'t. They\'ve been there for millions of years, through storms and floods and wars and … time. Nobody really understands where the music comes from. It\'s probably something to do with the precise positions, the distance between both towers. Even the locals aren\'t sure. All anyone will ever tell you is that when the wind stands fair and the night is perfect … when you least expect it … but always… when you need it the most … there is a song.<br />\r\n<strong>River</strong>: So, assuming tonight is all we have left…<br />\r\n<strong>The Doctor</strong>: I didn\'t say that.<br />\r\n<strong>River</strong>: How long … is a night on Darillium?<br />\r\n<strong>The Doctor</strong>: 24 years.<br />\r\n<strong>River</strong>: [she gasps] I hate you.<br />\r\n<strong>The Doctor</strong>: No, you don\'t.<br />\r\n', 'The Twelfth Doctor<br />\r\nRiver Song<br />\r\n', 'The Husbands of River Song', 'https://49.media.tumblr.com/048e073addb544705d5e0fedf241c3a7/tumblr_nztrbtK3nz1qijoeyo3_400.gif', 'tumblr_ovplrptbYL1v5nbpeo4_400.gif', 1162, '', '1.0000', 1),
(21, '<strong>The Doctor</strong>: Is it sad?<br />\r\n<strong>River</strong>: Why would a diary be sad?<br />\r\n<strong>The Doctor</strong>: I don\'t know, it\'s just that… you look sad.<br />\r\n<strong>River</strong>: It\'s nearly full.<br />\r\n<strong>The Doctor</strong>: So?<br />\r\n<strong>River</strong>: The man who gave me this was the sort of man who\'d know exactly how long a diary you were going to need.<br />\r\n<strong>The Doctor</strong>: He sounds awful.<br />\r\n<strong>River</strong>: I suppose he is. I\'ve never really thought about it.<br />\r\n<strong>The Doctor</strong>: Not somebody special then?<br />\r\n<strong>River</strong>: No. But terribly useful every now and then.', 'The Twelfth Doctor<br />\r\nRiver Song<br />\r\n', 'The Husbands of River Song', 'https://ichef.bbci.co.uk/images/ic/976x549_b/p03crndk.jpg', '9e091870997cae3bb51e49db54a2e819.jpg', 1162, '', '1.0000', 1),
(22, 'Through crimson stars and silent stars and tumbling nebulas like oceans set on fire; through empires of glass and civilizations of pure thought, and a whole, terrible, wonderful universe of impossibilities. You see these eyes? They\'re old eyes. And one thing I can tell you, Alex... Monsters are real.', 'The Eleventh Doctor', 'Night Terrors', 'https://s-media-cache-ak0.pinimg.com/236x/8d/58/59/8d5859370da5d2e8ddfacc3d7976851a.jpg', '88b298b964f6a468c3ad32d74e59b381.jpg', 1113, '', '1.0000', 1),
(23, 'It\'s like when you\'re a kid. The first time they tell you that the world\'s turning and you just can\'t quite believe it \'cause everything looks like it\'s standing still... I can feel it: the turn of the Earth. The ground beneath our feet is spinning at 1,000 miles an hour and the entire planet is hurtling around the sun at 67,000 miles an hour, and I can feel it. We\'re falling through space, you and me, clinging to the skin of this tiny little world, and if we let go... That\'s who I am.', 'The Ninth Doctor', 'Rose', 'https://s1.narvii.com/image/gc5fyioifo2xvartv3mrqgtjdkcxbzad_hq.jpg', 'tumblr_m98un6zwcg1qfy88jo7_250.gif', 184, '', '1.0000', 1),
(24, 'When you wake up... I\'ll be a story in your head. But that\'s okay. We\'re all stories, in the end... just make it a good one, eh? Because it was. It was the best', 'Eleventh Doctor', 'The Big Bang', 'https://i.ytimg.com/vi/td7CmB3uivI/maxresdefault.jpg', '33fba5e4df3013c2652760cf5262a7b0.gif', 1103, '', '1.0000', 1),
(25, 'The very powerful and the very stupid have one thing in common. They don\'t change their views to fit the facts. They change the facts to fit their views. Which can be uncomfortable if you happen to be one of the facts that needs changing.', 'The Fourth Doctor', 'The Face of Evil', 'https://i.pinimg.com/736x/0f/f4/fa/0ff4fa1fa20834981a56cef8b9b2d86d--doctor-quotes-the-doctor.jpg', '0ff4fa1fa20834981a56cef8b9b2d86d--doctor-quotes-the-doctor.jpg', 1165, '', '1.0000', 1),
(26, 'Nothing is sad untill it is over, then everything is.', 'The Twelfth Doctor', 'Hell Bent', 'https://66.media.tumblr.com/33dbc975a00e91a2c6e460cd5203f84a/tumblr_nyy2wo4eR91sp8b3ro1_500.jpg', 'tumblr_nyy2wo4eR91sp8b3ro1_500.jpg', 1161, '', '1.0000', 1),
(27, '<strong>The Doctor</strong>: Run like hell because you always need to. Laugh at everything, because it\' s always funny.<br />\r\n<strong>Clara</strong>: No, stop it. You\' re saying goodbye. Don\' t say goodbye.<br />\r\n<strong>The Doctor</strong>: Never be cruel and never be cowardly. And if you ever are, always make amends.<br />\r\n<strong>Clara</strong>: Stop it! Stop, stop it! The Doctor: Never eat pears. They\' re too squishy. And they always make your chin wet. That one\' s quite important. Write it down.', 'The Twelfth Doctor<br />\r\nClara Oswald<br />\r\n', 'Hell Bent', 'https://s-media-cache-ak0.pinimg.com/564x/ce/58/b7/ce58b789acb044a5ae0b2764917ea4c9.jpg', 'tumblr_nz2dxnwqYv1u1r9vlo1_400.gif', 1161, '', '1.0000', 1),
(28, 'Have you ever thought what it\'s like to be wanderers in the Fourth Dimension? Have you? To be exiles? Susan and I are cut off from our own planet - without friends or protection. But one day we shall get back. Yes, one day.', 'The First Doctor', 'An Unearthly Child', '../images/Quotes/Have_You_Ever_Fourth_Dimension.png', 'a86542016f6ff3f9d72fcbbbbf5176175c7e5041_00.gif', 1001, '', '1.0000', 1),
(29, 'Let me get this straight. A thing that looks like a police box, standing in a junkyard, it can move anywhere in time and space?', 'Ian Chesterton', 'An Unearthly Child', '../images/Quotes/3dc4658c9709678200c55986479f6bb81afd92b6_hq.jpg', '3dc4658c9709678200c55986479f6bb81afd92b6_hq.jpg', 1001, '', '1.0000', 1),
(30, 'You want weapons? We’re in a library! Books! The best weapons in the world!', 'The Tenth Doctor', 'Tooth and Claw', '../images/Quotes/Books_Weapons.jpg', 'tumblr_n9djsjqd3Q1rndtl6o7_r1_250.gif', 1016, '', '1.0000', 1),
(31, 'One may tolerate a world of demons for the sake of an angel.', 'Reinette Poisson (Madame de Pompadour)', 'The Girl In The Fireplace', 'https://i.pinimg.com/736x/e2/01/6e/e2016eb67849946455d5a2e7fda1d4ee--valentine-day-cards-doctor-who-valentines.jpg', 'af2edf32b12ec5ae5c109f41d81794250a06da38_00.gif', 1018, '', '1.0000', 1),
(32, 'You should always waste time when you don\'t have any. Time is not the boss of you. Rule 408.', 'The Eleventh Doctor', 'Let\'s Kill Hitler', 'https://i.pinimg.com/736x/73/c6/60/73c6600b56385e21c9147c86a5d3713d.jpg', '1d10ec75d8a2aae6479f7ba2f84c91bc.gif', 1112, '', '1.0000', 1),
(33, 'Never run when you\'re scared. Rule 7.', 'The Eleventh Doctor', 'Let\'s Kill Hitler', 'https://thumbs.gfycat.com/LargeConcreteCod-small.gif', 'tumblr_njcx1fYnGy1qaiaoco7_250.gif', 1112, '', '1.0000', 1),
(34, 'Right now, I\'m a stranger to myself. There\'s echoes of who I was, and a sort of call towards who I am, and I have to hold my nerve and trust all these new instincts. Shape myself towards them. I\'ll be fine, in the end. Hopefully. Well, I have to be because you guys need help. And if there is one thing I\'m certain of, when people need help, I never refuse. Right, this is going to be fun!', 'The Thirteenth Doctor', 'The Woman who Fell to Earth', '../images/gallifreyan_black.png', 'tumblr_pg9xdzw6s81qgapqso7_500.gif', 1465, '', '1.0000', 1),
(35, 'A straight line may be the shortest distance between two points, but it is by no means the most interesting.', 'The Third Doctor', 'The Time Warrior', '', 'c1a2872f37db4ebda89c6f2bb27834df.gif', 1246, 'smallItem', '1.0000', 1),
(36, 'The universe has to move forward. Pain and loss, they define us as much as happiness or love. Whether it’s a world, or a relationship… Everything has its time. And everything ends.', 'Sarah Jane Smith', 'School Reunion', '', 'fc232a664915f904267f7253dd6ab7dd.jpg', 1017, 'smallItem', '1.0000', 1),
(37, 'Human progress isn\'t measured by industry. It\'s measured by the value you place on a life... an unimportant life... a life without privilege. The boy who died on the river, that boy\'s value is your value. That\'s what defines an age. That\'s... what defines a species.', 'Twelth Doctor', 'Thin Ice', '', '8901ab8eaaa1d616fc7296d3b64bff4e.jpg', 1166, 'smallItem', '1.0000', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `QuotesTabel__history`
--

CREATE TABLE `QuotesTabel__history` (
  `history__id` int(11) NOT NULL,
  `history__language` varchar(2) DEFAULT NULL,
  `history__comments` text DEFAULT NULL,
  `history__user` varchar(32) DEFAULT NULL,
  `history__state` int(5) DEFAULT 0,
  `history__modified` datetime DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `Quote` longtext DEFAULT NULL,
  `Personage` text DEFAULT NULL,
  `Aflevering` text DEFAULT NULL,
  `QuotePic` text DEFAULT NULL,
  `QuotePic2` varchar(64) DEFAULT NULL,
  `QuotePic_old` text DEFAULT NULL,
  `Episode` int(11) DEFAULT NULL,
  `Class` varchar(22) DEFAULT NULL,
  `Level` decimal(19,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `QuotesTabel__history`
--

INSERT INTO `QuotesTabel__history` (`history__id`, `history__language`, `history__comments`, `history__user`, `history__state`, `history__modified`, `id`, `Quote`, `Personage`, `Aflevering`, `QuotePic`, `QuotePic2`, `QuotePic_old`, `Episode`, `Class`, `Level`) VALUES
(1, 'nl', '', 'Ruben', 0, '2020-03-07 15:01:31', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(2, 'nl', '', 'Ruben', 0, '2020-03-07 15:08:24', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', '', NULL, NULL, NULL, NULL),
(3, 'nl', '', 'Ruben', 0, '2020-03-07 15:14:23', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(4, 'nl', '', 'Ruben', 0, '2020-03-07 15:15:26', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', '', NULL, NULL, NULL, NULL),
(5, 'nl', '', 'Ruben', 0, '2020-03-07 15:17:10', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(6, 'nl', '', 'Ruben', 0, '2020-03-07 15:19:40', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(7, 'nl', '', 'Ruben', 0, '2020-03-07 15:19:43', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(8, 'nl', '', 'Ruben', 0, '2020-03-07 15:21:29', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(9, 'nl', '', 'Ruben', 0, '2020-03-07 15:23:50', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(10, 'nl', '', 'Ruben', 0, '2020-03-07 15:23:54', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(11, 'nl', '', 'Ruben', 0, '2020-03-07 15:25:41', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(12, 'nl', '', 'Ruben', 0, '2020-03-07 15:26:54', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(13, 'nl', '', 'Ruben', 0, '2020-03-07 15:27:28', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(14, 'nl', '', 'Ruben', 0, '2020-03-07 15:27:30', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(15, 'nl', '', 'Ruben', 0, '2020-03-07 15:46:00', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(16, 'nl', '', 'Ruben', 0, '2020-03-07 15:50:25', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(17, 'nl', '', 'Ruben', 0, '2020-03-07 15:50:27', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(18, 'nl', '', 'Ruben', 0, '2020-03-07 15:56:38', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(19, 'nl', '', 'Ruben', 0, '2020-03-07 15:58:06', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(20, 'nl', '', 'Ruben', 0, '2020-03-07 15:58:16', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(21, 'nl', '', 'Ruben', 0, '2020-03-07 16:03:20', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(22, 'nl', '', 'Ruben', 0, '2020-03-07 16:06:07', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(23, 'nl', '', 'Ruben', 0, '2020-03-07 16:06:10', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(24, 'nl', '', 'Ruben', 0, '2020-03-07 16:07:06', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(25, 'nl', '', 'Ruben', 0, '2020-03-07 16:10:40', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(26, 'nl', '', 'Ruben', 0, '2020-03-07 16:11:03', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(27, 'nl', '', 'Ruben', 0, '2020-03-07 16:11:52', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool-1.jpg', NULL, NULL, NULL, NULL),
(28, 'nl', '', 'Ruben', 0, '2020-03-07 16:12:49', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(29, 'nl', '', 'Ruben', 0, '2020-03-07 16:12:52', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(30, 'nl', '', 'Ruben', 0, '2020-03-07 16:13:05', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(31, 'nl', '', 'Ruben', 0, '2020-03-07 16:13:11', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(32, 'nl', '', 'Ruben', 0, '2020-03-07 16:14:35', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(33, 'nl', '', 'Ruben', 0, '2020-03-07 16:14:39', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(34, 'nl', '', 'Ruben', 0, '2020-03-07 16:14:48', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(35, 'nl', '', 'Ruben', 0, '2020-03-07 16:14:50', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL, NULL),
(36, 'nl', '', 'Ruben', 0, '2020-03-07 16:15:16', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'Eleventh Doctor', 'A Chtistmas Carol', 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL, NULL),
(37, 'nl', '', 'Ruben', 0, '2020-03-07 16:16:35', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(38, 'nl', '', 'Ruben', 0, '2020-03-07 16:16:47', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(39, 'nl', '', 'Ruben', 0, '2020-03-07 16:18:38', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(40, 'nl', '', 'Ruben', 0, '2020-03-07 16:18:50', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(41, 'nl', '', 'Ruben', 0, '2020-03-07 16:21:29', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL, NULL),
(42, 'nl', '', 'Ruben', 0, '2020-03-07 16:23:36', 5, 'No More.', 'War Doctor<br>The Moment disguised as Bad Wolf', 'Day of the Doctor', 'https://38.media.tumblr.com/85e176a1bc1a09035a000aaf36c3394f/tumblr_mwqao1Ruia1qijoeyo1_400.gif', 'tumblr_mwqao1Ruia1qijoeyo1_400.gif', NULL, NULL, NULL, NULL),
(43, 'nl', '', 'Ruben', 0, '2020-03-07 16:48:40', 4, ' People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'Tenth Doctor', 'Blink', '../images/Quotes/blink_by_becausebowtiesrcool.jpg', 'blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL, NULL),
(44, 'nl', '', 'Ruben', 0, '2020-03-08 18:42:39', 6, 'Everybody knows that everybody dies. But not every day. Not today. Some days are special. Some days are so, so blessed. Some days, nobody dies at all. Now and then, every once in a very long while, every day in a million days, when the wind stands fair and the Doctor comes to call, everybody lives.', 'River Song', 'Forest of the Dead', 'https://s-media-cache-ak0.pinimg.com/originals/7e/71/f0/7e71f0d49449ec12188ff26f18454f4b.jpg', '7e71f0d49449ec12188ff26f18454f4b.jpg', NULL, NULL, NULL, NULL),
(45, 'nl', '', 'Ruben', 0, '2020-03-08 18:43:48', 6, 'Everybody knows that everybody dies. But not every day. Not today. Some days are special. Some days are so, so blessed. Some days, nobody dies at all. Now and then, every once in a very long while, every day in a million days, when the wind stands fair and the Doctor comes to call, everybody lives.', 'River Song', 'Forest of the Dead', 'https://s-media-cache-ak0.pinimg.com/originals/7e/71/f0/7e71f0d49449ec12188ff26f18454f4b.jpg', '7e71f0d49449ec12188ff26f18454f4b.jpg', NULL, NULL, NULL, NULL),
(46, 'nl', '', 'Ruben', 0, '2020-03-08 21:41:50', 1, 'Yaz: Have you got family?\r\nThe Doctor: No. Lost them a long time ago.\r\nRyan: How\'d you cope with that?\r\nThe Doctor: I carry them with me. What they would have thought, and said, and done. Make them a part of who I am. So even though they’re gone from the world, they’re never gone from me.', 'Yasmin Khan (Yaz)\r\nThirteenth Doctor\r\nRyan', 'The Woman Who Fell to Eath', 'download.gif', NULL, '', NULL, NULL, NULL),
(47, 'nl', '', 'Ruben', 0, '2020-03-08 22:01:22', 2, 'Clara: You\'re going to help me?\r\nThe Doctor: Well, why wouldn\'t I help you?\r\nClara: Because what I just did. I--\r\nThe Doctor: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!\r\nClara: Then why are you helping me?\r\nThe Doctor: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor\r\nClara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(48, 'nl', '', 'Ruben', 0, '2020-03-08 22:01:31', 2, 'Clara: You\'re going to help me?\r\nThe Doctor: Well, why wouldn\'t I help you?\r\nClara: Because what I just did. I--\r\nThe Doctor: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!\r\nClara: Then why are you helping me?\r\nThe Doctor: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor\r\nClara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(49, 'nl', '', 'Ruben', 0, '2020-03-08 22:10:19', 2, 'Clara: You\'re going to help me?<br />\r\nThe Doctor: Well, why wouldn\'t I help you?<br />\r\nClara: Because what I just did. I--<br />\r\nThe Doctor: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!<br />\r\nClara: Then why are you helping me?<br />\r\nThe Doctor: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor Clara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(50, 'nl', '', 'Ruben', 0, '2020-03-08 22:11:50', 2, '<strong>Clara</strong>: You\'re going to help me?<br />\r\n<strong>The Doctor</strong>: Well, why wouldn\'t I help you?<br />\r\n<strong>Clara</strong>: Because what I just did. I--<br />\r\n<strong>The Doctor</strong>: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!<br />\r\n<strong>Clara</strong>: Then why are you helping me?<br />\r\n<strong>The Doctor</strong>: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor Clara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(51, 'nl', '', 'Ruben', 0, '2020-03-08 22:12:02', 2, '<strong>Clara</strong>: You\'re going to help me?<br />\r\n<strong>The Doctor</strong>: Well, why wouldn\'t I help you?<br />\r\n<strong>Clara</strong>: Because what I just did. I--<br />\r\n<strong>The Doctor</strong>: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!<br />\r\n<strong>Clara</strong>: Then why are you helping me?<br />\r\n<strong>The Doctor</strong>: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor<br />\r\nClara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(52, 'nl', '', 'Ruben', 0, '2020-03-08 22:13:48', 2, '<ul>\r\n	<li>\r\n		<strong>Clara</strong>: You\'re going to help me?</li>\r\n	<li>\r\n		<strong>The Doctor</strong>: Well, why wouldn\'t I help you?</li>\r\n	<li>\r\n		<strong>Clara</strong>: Because what I just did. I--</li>\r\n	<li>\r\n		<strong>The Doctor</strong>: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!</li>\r\n	<li>\r\n		<strong>Clara</strong>: Then why are you helping me?</li>\r\n	<li>\r\n		<strong>The Doctor</strong>: Why? Do you think I care for you so little that betraying me would make a difference?</li>\r\n</ul>\r\n', 'The Twelfth Doctor<br />\r\nClara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(53, 'nl', '', 'Ruben', 0, '2020-03-08 22:14:04', 2, '<strong>Clara</strong>: You\'re going to help me?<br />\r\n<strong>The Doctor</strong>: Well, why wouldn\'t I help you?<br />\r\n<strong>Clara</strong>: Because what I just did. I--<br />\r\n<strong>The Doctor</strong>: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!<br />\r\n<strong>Clara</strong>: Then why are you helping me?<br />\r\n<strong>The Doctor</strong>: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor<br />\r\nClara', 'Dark Water', 'p02bvbyk.jpg', NULL, '', NULL, NULL, NULL),
(54, 'nl', '', 'Ruben', 0, '2020-03-09 17:26:59', 7, '<strong>Clara</strong>: Who\'s that?<br />\r\n<strong>The Doctor</strong>: Never mind. Let\'s go back.<br />\r\n<strong>Clara</strong>: But who is he?<br />\r\n<strong>The Doctor</strong>: He\'s me. There\'s only me here. That\'s the point. Now let\'s get back.<br />\r\n<strong>Clara</strong>: But I never saw that one. I saw all of you. Eleven faces, all of them you! You\'re the eleventh Doctor!<br />\r\n<strong>The Doctor</strong>: I said he was me. I never said he was the Doctor.<br />\r\n<strong>Clara</strong>: I don\'t understand.<br />\r\n<strong>The Doctor</strong>: My name, my real name - that is not the point. The name I chose is the Doctor. The name you choose, is like... it\'s like a promise you make. He\'s the one who broke the promise.<br />\r\n<strong>The Doctor</strong>: Clara? Clara! Clara! The Doctor: He is my secret. ', 'Clara Oswald<br />\r\nEleventh Doctor', 'Name of the Doctor', '0b0bd4f3b2333a126a7ea4dc5bfd11f4.jpg', NULL, 'https://static2.hypable.com/wp-content/uploads/2013/12/quote8.png', NULL, NULL, NULL),
(55, 'nl', '', 'Ruben', 0, '2020-03-09 17:27:53', 1, 'Yaz: Have you got family? The Doctor: No. Lost them a long time ago. Ryan: How\'d you cope with that? The Doctor: I carry them with me. What they would have thought, and said, and done. Make them a part of who I am. So even though they’re gone from the world, they’re never gone from me.', 'Yasmin Khan (Yaz)<br />\r\nThirteenth Doctor<br />\r\nRyan', 'The Woman Who Fell to Eath', 'download.gif', NULL, '', NULL, NULL, NULL),
(56, 'nl', '', 'Ruben', 0, '2020-03-09 17:29:52', 8, 'Great men are forged in fire. It is the privilege of lesser men to light te flame. Whatever the cost.', 'The War Doctor', 'Day of The Doctor', 'V65alwD.jpg', NULL, 'https://i.imgur.com/V65alwD.jpg', NULL, NULL, NULL),
(57, 'nl', '', 'Ruben', 0, '2020-03-09 17:32:07', 9, '<strong>The Eleventh Docto</strong>r: He\'s my secret<br />\r\n<strong>The War Doctor</strong>: What I did, I did without choice.<br />\r\n<strong>The Eleventh Doctor</strong>: I know.<br />\r\n<strong>The War Doctor</strong>: In the name of peace and Sanity.<br />\r\n<strong>The Eleventh Doctor</strong>: But not in the name of The Doctor.', 'The War Doctor<br />\r\nEleventh Doctor', 'the Name of the Doctor', '46c7fca47db66fd04ee132b902664e91.png', NULL, 'https://img.desmotivaciones.es/201305/descarga_171.jpg', NULL, NULL, NULL),
(58, 'nl', '', 'Ruben', 0, '2020-03-09 17:34:31', 10, 'I hope the ears are a bit less conspicuous this time.', 'The War Doctor', 'Day of the Doctor', 'ears.jpg', NULL, '../images/Content/download.jpg', NULL, NULL, NULL),
(59, 'nl', '', 'Ruben', 0, '2020-03-09 17:42:11', 11, '<strong>Clara</strong>: It\'s no good, Bonnie. You can\'t win.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I don\'t care.<br />\r\n<strong>The Twelfth Doctor</strong>: Hi! Hello! Hello!<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, hello! Hi. Hi. Stop this. Stop this, please. Let me take both of these boxes away. We\'ll forgive, we\'ll forget. And the ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No.<br />\r\n<strong>Kate</strong>: Doctor, which of these buttons do I press? Doctor, which one? Truth or consequences?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Truth or consequences?<br />\r\n<strong>The Twelfth Doctor</strong>: This is the moment we\'ve all been waiting for. Make your mind up time!<br />\r\nOne of those buttons will destroy the Zygons, release the imbecile\'s gas. The other one detonates the nuclear warhead under the Black Archive. It\'ll destroy everyone in London. Bonnie. Bonnie, sweetheart! One of those buttons will unmask every Zygon in the world. The other one cancels their ability to change form. It\'ll make them human beings for ever. There are safeguards beyond safeguards. I did this on a very important day for me and this ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: This is wrong.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You are responsible for all the violence. All of the suffering.<br />\r\n<strong>The Twelfth Doctor</strong>: No, I\'m not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes.<br />\r\n<strong>The Twelfth Doctor</strong>: No.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes. You engineered this situation, Doctor. This is your fault.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not. It\'s your fault.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I had to do what I\'ve done.<br />\r\n<strong>The Twelfth Doctor</strong>: So did I.<br />\r\nBonnie (Clara Zygon): We\'ve been treated like cattle.<br />\r\nThe Twelfth Doctor: So what.<br />\r\nBonnie (Clara Zygon): We\'ve been left to fend for ourselves.<br />\r\nThe Twelfth Doctor: So\'s everyone.<br />\r\nBonnie (Clara Zygon): It\'s not fair.<br />\r\nThe Twelfth Doctor: Oh, it\'s not fair! Oh, I didn\'t realise that it was not fair! Well, you know what? My Tardis doesn\'t work properly and I don\'t have my own personal tailor.<br />\r\nBonnie (Clara Zygon): The things don\'t equate.<br />\r\nThe Twelfth Doctor: These things have happened, Zygella. They are facts. You just want cruelty to beget cruelty. You\'re not superior to people who were cruel to you. you\'re just a whole bunch of new cruel people. A whole bunch of new cruel people being cruel to some other people, who\'ll end up being cruel to you. The only way anyone can live in peace is if they\'re prepared to forgive. Why don\'t you break the cycle?<br />\r\nBonnie (Clara Zygon): Why should we?<br />\r\nThe Twelfth Doctor: What is it that you actually want?<br />\r\nBonnie (Clara Zygon): War.<br />\r\nThe Twelfth Doctor: Ah. Ah, right. And when this war is over, when you have a homeland free from humans, what do you think it\'s going to be like? Do you know? Have you thought about it? Have you given it any consideration? Because you\'re very close to getting what you want. What\'s it going to be like? Paint me a picture. Are you going to live in houses? Do you want people to go to work? Will there be holidays? Oh! Will there be music? Do you think people will be allowed to play violins? Who\'s going to make the violins? Well? Oh, you don\'t actually know, do you? Because, like every other tantrumming child in history, Bonnie, you don\'t actually know what you want. So, let me ask you a question about this brave new world of yours. When you\'ve killed all the bad guys, and when it\'s all perfect and just and fair, when you have finally got it exactly the way you want it, what are you going to do with the people like you? The troublemakers. How are you going to protect your glorious revolution from the next one?<br />\r\nBonnie (Clara Zygon): We\'ll win.<br />\r\nThe Twelfth Doctor: Oh, will you? Well, maybe, maybe you will win! But nobody wins for long. The wheel just keeps turning. So, come on. Break the cycle.<br />\r\nBonnie (Clara Zygon): Why are you still talking?<br />\r\nThe Twelfth Doctor: Because I want to get you to see, and I\'m almost there!<br />\r\nBonnie (Clara Zygon): Do you know what I see, Doctor? A box. A box with everything I need. A fifty percent chance.<br />\r\nKate: For us, too.<br />\r\nThe Twelfth Doctor: And we\'re off! Fingers on buzzers! Are you feeling lucky? Are you ready to play the game? Who\'s going to be quickest? Who\'s going to be luckiest?<br />\r\nKate: This is not a game!<br />\r\nThe Twelfth Doctor: No, it\'s not a game, sweetheart, and I mean that most sincerely.<br />\r\nBonnie (Clara Zygon): Why are you doing this?<br />\r\nKate: Yes, I\'d quite like to know that, too. You set this up. Why?<br />\r\nThe Twelfth Doctor: Because it\'s not a game, Kate. This is a scale model of war. Every war ever fought, right there in front of you. Because it\'s always the same. When you fire that first shot, no matter how right you feel, you have no idea who\'s going to die! You don\'t know whose children are going to scream and burn! How many hearts will be broken! How many lives shattered! How much blood will spill until everybody does until what they were always going to have to do from the very beginning. Sit down and talk! Listen to me. Listen, I just, I just want you to think. Do you know what thinking is? It\'s just a fancy word for changing your mind.<br />\r\nBonnie (Clara Zygon): I will not change my mind.<br />\r\nThe Twelfth Doctor: Then you will die stupid. Alternatively, you could step away from that box, you can walk right out of that door and you could stand your revolution down.<br />\r\nBonnie (Clara Zygon): No! I\'m not stopping this, Doctor. I started it. I will not stop it. You think they\'ll let me go, after what I\'ve done?<br />\r\nThe Twelfth Doctor: You\'re all the same, you screaming kids. You know that? «Look at me, I\'m unforgivable.» Well, here\'s the unforeseeable. I forgive you. After all you\'ve done, I forgive you.<br />\r\nBonnie (Clara Zygon): You don\'t understand. You will never understand.<br />\r\nThe Twelfth Doctor: I don\'t understand? Are you kidding? Me? Of course I understand. I mean, do you call this a war? This funny little thing? This is not a war! I fought in a bigger war than you will ever know. I did worse things than you could ever imagine. And when I close my eyes I hear more screams than anyone could ever be able to count! And do you know what you do with all that pain? Shall I tell you where you put it? You hold it tight till it burns your hand, and you say this. No one else will ever have to live like this. No one else will have to feel this pain. Not on my watch!<br />\r\nThe Twelfth Doctor: Thank you. Thank you.<br />\r\nKate: I\'m sorry.<br />\r\nThe Twelfth Doctor: I know. I know. Thank you. Well?<br />\r\nBonnie (Clara Zygon): It\'s empty, isn\'t it? Both boxes. There\'s nothing in them. Just buttons.<br />\r\nThe Twelfth Doctor: Of course. And do you know how you know that? Because you\'ve started to think like me.<br />\r\nThe Twelfth Doctor: :It\'s hell, isn\'t it? No one should have to think like that. And no one will. Not on our watch. Gotcha.<br />\r\nBonnie (Clara Zygon): How can you be so sure?<br />\r\nThe Twelfth Doctor: Because you have a disadvantage, Zygella. I know that face.<br />\r\nKate: This is all very well, but we know the boxes are empty now. We can\'t forget that.<br />\r\nThe Twelfth Doctor: No, well, er, you\'ve said that the last fifteen times. ', 'Twelfth Doctor<br />\r\nKate<br />\r\nBonnie(Clara Oswald)', 'The Zygon Inversion', '', NULL, 'https://4.bp.blogspot.com/-mOOCMSXB_Zw/Vj-PTbzbF7I/AAAAAAAATpo/_WQGMIvi5-A/s1600/The%2BZygon%2BInversion%2BOsgood%2BBoxes.jpg', NULL, NULL, NULL),
(60, 'nl', '', 'Ruben', 0, '2020-03-09 17:43:21', 11, '<strong>Clara</strong>: It\'s no good, Bonnie. You can\'t win.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I don\'t care.<br />\r\n<strong>The Twelfth Doctor</strong>: Hi! Hello! Hello!<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, hello! Hi. Hi. Stop this. Stop this, please. Let me take both of these boxes away. We\'ll forgive, we\'ll forget. And the ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No.<br />\r\n<strong>Kate</strong>: Doctor, which of these buttons do I press? Doctor, which one? Truth or consequences?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Truth or consequences?<br />\r\n<strong>The Twelfth Doctor</strong>: This is the moment we\'ve all been waiting for. Make your mind up time!<br />\r\nOne of those buttons will destroy the Zygons, release the imbecile\'s gas. The other one detonates the nuclear warhead under the Black Archive. It\'ll destroy everyone in London. Bonnie. Bonnie, sweetheart! One of those buttons will unmask every Zygon in the world. The other one cancels their ability to change form. It\'ll make them human beings for ever. There are safeguards beyond safeguards. I did this on a very important day for me and this ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: This is wrong.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You are responsible for all the violence. All of the suffering.<br />\r\n<strong>The Twelfth Doctor</strong>: No, I\'m not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes.<br />\r\n<strong>The Twelfth Doctor</strong>: No.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes. You engineered this situation, Doctor. This is your fault.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not. It\'s your fault.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I had to do what I\'ve done.<br />\r\n<strong>The Twelfth Doctor</strong>: So did I.<br />\r\nBonnie (Clara Zygon): We\'ve been treated like cattle.<br />\r\nThe Twelfth Doctor: So what.<br />\r\nBonnie (Clara Zygon): We\'ve been left to fend for ourselves.<br />\r\nThe Twelfth Doctor: So\'s everyone.<br />\r\nBonnie (Clara Zygon): It\'s not fair.<br />\r\nThe Twelfth Doctor: Oh, it\'s not fair! Oh, I didn\'t realise that it was not fair! Well, you know what? My Tardis doesn\'t work properly and I don\'t have my own personal tailor.<br />\r\nBonnie (Clara Zygon): The things don\'t equate.<br />\r\nThe Twelfth Doctor: These things have happened, Zygella. They are facts. You just want cruelty to beget cruelty. You\'re not superior to people who were cruel to you. you\'re just a whole bunch of new cruel people. A whole bunch of new cruel people being cruel to some other people, who\'ll end up being cruel to you. The only way anyone can live in peace is if they\'re prepared to forgive. Why don\'t you break the cycle?<br />\r\nBonnie (Clara Zygon): Why should we?<br />\r\nThe Twelfth Doctor: What is it that you actually want?<br />\r\nBonnie (Clara Zygon): War.<br />\r\nThe Twelfth Doctor: Ah. Ah, right. And when this war is over, when you have a homeland free from humans, what do you think it\'s going to be like? Do you know? Have you thought about it? Have you given it any consideration? Because you\'re very close to getting what you want. What\'s it going to be like? Paint me a picture. Are you going to live in houses? Do you want people to go to work? Will there be holidays? Oh! Will there be music? Do you think people will be allowed to play violins? Who\'s going to make the violins? Well? Oh, you don\'t actually know, do you? Because, like every other tantrumming child in history, Bonnie, you don\'t actually know what you want. So, let me ask you a question about this brave new world of yours. When you\'ve killed all the bad guys, and when it\'s all perfect and just and fair, when you have finally got it exactly the way you want it, what are you going to do with the people like you? The troublemakers. How are you going to protect your glorious revolution from the next one?<br />\r\nBonnie (Clara Zygon): We\'ll win.<br />\r\nThe Twelfth Doctor: Oh, will you? Well, maybe, maybe you will win! But nobody wins for long. The wheel just keeps turning. So, come on. Break the cycle.<br />\r\nBonnie (Clara Zygon): Why are you still talking?<br />\r\nThe Twelfth Doctor: Because I want to get you to see, and I\'m almost there!<br />\r\nBonnie (Clara Zygon): Do you know what I see, Doctor? A box. A box with everything I need. A fifty percent chance.<br />\r\nKate: For us, too.<br />\r\nThe Twelfth Doctor: And we\'re off! Fingers on buzzers! Are you feeling lucky? Are you ready to play the game? Who\'s going to be quickest? Who\'s going to be luckiest?<br />\r\nKate: This is not a game!<br />\r\nThe Twelfth Doctor: No, it\'s not a game, sweetheart, and I mean that most sincerely.<br />\r\nBonnie (Clara Zygon): Why are you doing this?<br />\r\nKate: Yes, I\'d quite like to know that, too. You set this up. Why?<br />\r\nThe Twelfth Doctor: Because it\'s not a game, Kate. This is a scale model of war. Every war ever fought, right there in front of you. Because it\'s always the same. When you fire that first shot, no matter how right you feel, you have no idea who\'s going to die! You don\'t know whose children are going to scream and burn! How many hearts will be broken! How many lives shattered! How much blood will spill until everybody does until what they were always going to have to do from the very beginning. Sit down and talk! Listen to me. Listen, I just, I just want you to think. Do you know what thinking is? It\'s just a fancy word for changing your mind.<br />\r\nBonnie (Clara Zygon): I will not change my mind.<br />\r\nThe Twelfth Doctor: Then you will die stupid. Alternatively, you could step away from that box, you can walk right out of that door and you could stand your revolution down.<br />\r\nBonnie (Clara Zygon): No! I\'m not stopping this, Doctor. I started it. I will not stop it. You think they\'ll let me go, after what I\'ve done?<br />\r\nThe Twelfth Doctor: You\'re all the same, you screaming kids. You know that? «Look at me, I\'m unforgivable.» Well, here\'s the unforeseeable. I forgive you. After all you\'ve done, I forgive you.<br />\r\nBonnie (Clara Zygon): You don\'t understand. You will never understand.<br />\r\nThe Twelfth Doctor: I don\'t understand? Are you kidding? Me? Of course I understand. I mean, do you call this a war? This funny little thing? This is not a war! I fought in a bigger war than you will ever know. I did worse things than you could ever imagine. And when I close my eyes I hear more screams than anyone could ever be able to count! And do you know what you do with all that pain? Shall I tell you where you put it? You hold it tight till it burns your hand, and you say this. No one else will ever have to live like this. No one else will have to feel this pain. Not on my watch!<br />\r\nThe Twelfth Doctor: Thank you. Thank you.<br />\r\nKate: I\'m sorry.<br />\r\nThe Twelfth Doctor: I know. I know. Thank you. Well?<br />\r\nBonnie (Clara Zygon): It\'s empty, isn\'t it? Both boxes. There\'s nothing in them. Just buttons.<br />\r\nThe Twelfth Doctor: Of course. And do you know how you know that? Because you\'ve started to think like me.<br />\r\nThe Twelfth Doctor: :It\'s hell, isn\'t it? No one should have to think like that. And no one will. Not on our watch. Gotcha.<br />\r\nBonnie (Clara Zygon): How can you be so sure?<br />\r\nThe Twelfth Doctor: Because you have a disadvantage, Zygella. I know that face.<br />\r\nKate: This is all very well, but we know the boxes are empty now. We can\'t forget that.<br />\r\nThe Twelfth Doctor: No, well, er, you\'ve said that the last fifteen times. ', 'Twelfth Doctor<br />\r\nKate<br />\r\nBonnie(Clara Oswald)', 'The Zygon Inversion', 'CTut-JZWEAAWRpT.jpg', NULL, 'https://4.bp.blogspot.com/-mOOCMSXB_Zw/Vj-PTbzbF7I/AAAAAAAATpo/_WQGMIvi5-A/s1600/The%2BZygon%2BInversion%2BOsgood%2BBoxes.jpg', NULL, NULL, NULL),
(61, 'nl', '', 'Ruben', 0, '2020-03-09 18:17:58', 11, '<strong>Clara</strong>: It\'s no good, Bonnie. You can\'t win.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I don\'t care.<br />\r\n<strong>The Twelfth Doctor</strong>: Hi! Hello! Hello!<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, hello! Hi. Hi. Stop this. Stop this, please. Let me take both of these boxes away. We\'ll forgive, we\'ll forget. And the ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No.<br />\r\n<strong>Kate</strong>: Doctor, which of these buttons do I press? Doctor, which one? Truth or consequences?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Truth or consequences?<br />\r\n<strong>The Twelfth Doctor</strong>: This is the moment we\'ve all been waiting for. Make your mind up time!<br />\r\nOne of those buttons will destroy the Zygons, release the imbecile\'s gas. The other one detonates the nuclear warhead under the Black Archive. It\'ll destroy everyone in London. Bonnie. Bonnie, sweetheart! One of those buttons will unmask every Zygon in the world. The other one cancels their ability to change form. It\'ll make them human beings for ever. There are safeguards beyond safeguards. I did this on a very important day for me and this ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: This is wrong.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You are responsible for all the violence. All of the suffering.<br />\r\n<strong>The Twelfth Doctor</strong>: No, I\'m not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes.<br />\r\n<strong>The Twelfth Doctor</strong>: No.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes. You engineered this situation, Doctor. This is your fault.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not. It\'s your fault.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I had to do what I\'ve done.<br />\r\n<strong>The Twelfth Doctor</strong>: So did I.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been treated like cattle.<br />\r\n<strong>The Twelfth Doctor</strong>: So what.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been left to fend for ourselves.<br />\r\n<strong>The Twelfth Doctor</strong>: So\'s everyone.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>:&nbsp;It\'s not fair.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, it\'s not fair! Oh, I didn\'t realise that it was not fair! Well, you know what? My Tardis doesn\'t work properly and I don\'t have my own personal tailor.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: The things don\'t equate.<br />\r\n<strong>The Twelfth Doctor</strong>: These things have happened, Zygella. They are facts. You just want cruelty to beget cruelty. You\'re not superior to people who were cruel to you. you\'re just a whole bunch of new cruel people. A whole bunch of new cruel people being cruel to some other people, who\'ll end up being cruel to you. The only way anyone can live in peace is if they\'re prepared to forgive. Why don\'t you break the cycle?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why should we?<br />\r\n<strong>The Twelfth Doctor</strong>: What is it that you actually want?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: War.<br />\r\n<strong>The Twelfth Doctor</strong>: Ah. Ah, right. And when this war is over, when you have a homeland free from humans, what do you think it\'s going to be like? Do you know? Have you thought about it? Have you given it any consideration? Because you\'re very close to getting what you want. What\'s it going to be like? Paint me a picture. Are you going to live in houses? Do you want people to go to work? Will there be holidays? Oh! Will there be music? Do you think people will be allowed to play violins? Who\'s going to make the violins? Well? Oh, you don\'t actually know, do you? Because, like every other tantrumming child in history, Bonnie, you don\'t actually know what you want. So, let me ask you a question about this brave new world of yours. When you\'ve killed all the bad guys, and when it\'s all perfect and just and fair, when you have finally got it exactly the way you want it, what are you going to do with the people like you? The troublemakers. How are you going to protect your glorious revolution from the next one?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ll win.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, will you? Well, maybe, maybe you will win! But nobody wins for long. The wheel just keeps turning. So, come on. Break the cycle.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you still talking?<br />\r\n<strong>The Twelfth Doctor</strong>: Because I want to get you to see, and I\'m almost there!<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Do you know what I see, Doctor? A box. A box with everything I need. A fifty percent chance.<br />\r\n<strong>Kate</strong>: For us, too.<br />\r\n<strong>The Twelfth Doctor</strong>: And we\'re off! Fingers on buzzers! Are you feeling lucky? Are you ready to play the game? Who\'s going to be quickest? Who\'s going to be luckiest?<br />\r\n<strong>Kate</strong>: This is not a game!<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not a game, sweetheart, and I mean that most sincerely.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you doing this?<br />\r\n<strong>Kate</strong>: Yes, I\'d quite like to know that, too. You set this up. Why?<br />\r\n<strong>The Twelfth Doctor</strong>: Because it\'s not a game, Kate. This is a scale model of war. Every war ever fought, right there in front of you. Because it\'s always the same. When you fire that first shot, no matter how right you feel, you have no idea who\'s going to die! You don\'t know whose children are going to scream and burn! How many hearts will be broken! How many lives shattered! How much blood will spill until everybody does until what they were always going to have to do from the very beginning. Sit down and talk! Listen to me. Listen, I just, I just want you to think. Do you know what thinking is? It\'s just a fancy word for changing your mind.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I will not change my mind.<br />\r\n<strong>The Twelfth Doctor</strong>: Then you will die stupid. Alternatively, you could step away from that box, you can walk right out of that door and you could stand your revolution down.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No! I\'m not stopping this, Doctor. I started it. I will not stop it. You think they\'ll let me go, after what I\'ve done?<br />\r\n<strong>The Twelfth Doctor</strong>: You\'re all the same, you screaming kids. You know that? «Look at me, I\'m unforgivable.» Well, here\'s the unforeseeable. I forgive you. After all you\'ve done, I forgive you.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You don\'t understand. You will never understand.<br />\r\n<strong>The Twelfth Doctor</strong>: I don\'t understand? Are you kidding? Me? Of course I understand. I mean, do you call this a war? This funny little thing? This is not a war! I fought in a bigger war than you will ever know. I did worse things than you could ever imagine. And when I close my eyes I hear more screams than anyone could ever be able to count! And do you know what you do with all that pain? Shall I tell you where you put it? You hold it tight till it burns your hand, and you say this. No one else will ever have to live like this. No one else will have to feel this pain. Not on my watch!<br />\r\n<strong>The Twelfth Doctor</strong>: Thank you. Thank you.<br />\r\n<strong>Kate</strong>: I\'m sorry.<br />\r\n<strong>The Twelfth Doctor</strong>: I know. I know. Thank you. Well?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: It\'s empty, isn\'t it? Both boxes. There\'s nothing in them. Just buttons.<br />\r\n<strong>The Twelfth Doctor</strong>: Of course. And do you know how you know that? Because you\'ve started to think like me.<br />\r\n<strong>The Twelfth Doctor</strong>: It\'s hell, isn\'t it? No one should have to think like that. And no one will. Not on our watch. Gotcha.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: How can you be so sure?<br />\r\n<strong>The Twelfth Doctor</strong>: Because you have a disadvantage, Zygella. I know that face.<br />\r\n<strong>Kate</strong>: This is all very well, but we know the boxes are empty now. We can\'t forget that.<br />\r\n<strong>The Twelfth Doctor</strong>: No, well, er, you\'ve said that the last fifteen times. ', 'The Twelfth Doctor<br />\r\nKate<br />\r\nBonnie(Clara Oswald)', 'The Zygon Inversion', 'CTut-JZWEAAWRpT.jpg', NULL, 'https://4.bp.blogspot.com/-mOOCMSXB_Zw/Vj-PTbzbF7I/AAAAAAAATpo/_WQGMIvi5-A/s1600/The%2BZygon%2BInversion%2BOsgood%2BBoxes.jpg', NULL, NULL, NULL),
(62, 'nl', '', 'Ruben', 0, '2020-03-09 18:20:05', 12, 'A heartbreak is a burden to us all. Pitty the man with two.', 'Mme. Vastra', 'The Snowmen Prequel: Vastra Investigates ', '3006bbb25afac8e546b486a3734d36ea.jpg', NULL, 'https://s-media-cache-ak0.pinimg.com/736x/30/06/bb/3006bbb25afac8e546b486a3734d36ea.jpg', NULL, NULL, NULL),
(63, 'nl', '', 'Ruben', 0, '2020-03-09 18:20:50', 13, 'I am not a good man! I am not a bad man. I am not a hero. And I\'m definitely not a president. And no, I\'m not an officer. Do you know what I am? I am an idiot, with a box and a screwdriver. Just passing through, helping out, learning. I don\'t need an army. I never have, because I\'ve got them. Always them. Because love, it\'s not an emotion. Love is a promise. ', 'Twelfth Doctor', 'Death in Heaven', 'b7bf0061c163ea867cdd1e0c6e28ffa8.jpg', NULL, 'https://s-media-cache-ak0.pinimg.com/736x/b7/bf/00/b7bf0061c163ea867cdd1e0c6e28ffa8.jpg', NULL, NULL, NULL),
(64, 'nl', '', 'Ruben', 0, '2020-03-09 18:21:22', 14, 'You gave me hope, and then you took it away. That\'s enough to make anyone dangerous. God knows what it will do to me.', 'Eleventh Doctor', 'The Doctor\'s Wife', 'doctor-who-11 is dangerous.gif', NULL, 'https://cdn.pastemagazine.com/www/articles/doctor-who-11%20is%20dangerous.gif', NULL, NULL, NULL),
(65, 'nl', '', 'Ruben', 0, '2020-03-09 18:21:53', 15, 'Better a broken heart than no heart at all.', 'Eleventh Doctor', 'A Christmas Carol', 'tumblr_midplhjzqb1ron04jo1_r2_500.gif', NULL, 'https://25.media.tumblr.com/9abbc46e023538412436dd09f7a17923/tumblr_midplhjzqb1ron04jo1_r2_500.gif', NULL, NULL, NULL),
(66, 'nl', '', 'Ruben', 0, '2020-03-09 18:23:46', 16, '<strong>The War Doctor</strong>: Are you capable of speaking without flapping your hands about?<br />\r\n<strong>The Eleventh Doctor</strong>: Yes. No. I demand to be incarcerated in the Tower immediately with my co-conspirators, Sandshoes and Grandad.<br />\r\n<strong>The War Doctor</strong>: Grandad?!<br />\r\n<strong>The Tenth Doctor</strong>: They\'re not sandshoes!<br />\r\n<strong>The War Doctor</strong>: Yes, they are!', 'The Eleventh Doctor<br />\r\nThe Tenth Doctor<br />\r\nThe War Doctor<br />\r\n', 'Day of the Doctor', '2810dfa35320c42fb97a451538cfa422.jpg', NULL, 'https://s-media-cache-ak0.pinimg.com/736x/28/10/df/2810dfa35320c42fb97a451538cfa422.jpg', NULL, NULL, NULL);
INSERT INTO `QuotesTabel__history` (`history__id`, `history__language`, `history__comments`, `history__user`, `history__state`, `history__modified`, `id`, `Quote`, `Personage`, `Aflevering`, `QuotePic`, `QuotePic2`, `QuotePic_old`, `Episode`, `Class`, `Level`) VALUES
(67, 'nl', '', 'Ruben', 0, '2020-03-09 23:07:10', 17, '<strong>River</strong>: When you love the Doctor, it\'s like loving the stars themselves! You don\'t expect a sunset to admire you back! And if I happen to find myself in danger, let me tell you, the Doctor is not stupid enough, or sentimental enough, and he is certainly not in love enough to find himself standing in it with me!<br />\r\n[She catches the Doctor\'s gaze, and the two look into each other\'s eyes.]<br />\r\n<strong>The Doctor</strong>: Hello, sweetie.<br />\r\n[River takes a moment to pull herself together.]<br />\r\n<strong>River</strong>: You are so doing those roots.<br />\r\n<strong>The Doctor</strong>: What, the roots of the sunset?<br />\r\n<strong>River</strong>: Don\'t you dare.<br />\r\n<strong>The Doctor</strong>: I\'ll have to check with the stars themselves.<br />\r\n<strong>River</strong>: Oh, shut up! I was just keeping them talking until it kicks off.', 'The Twelfth Doctor<br />\r\nRiver Song<br />\r\n', 'The Husbands of River Song', '564c5cf9bcae07a8338314a635eb0d4329c3bf30_hq.jpg', NULL, 'https://pm1.narvii.com/5960/564c5cf9bcae07a8338314a635eb0d4329c3bf30_hq.jpg', NULL, NULL, NULL),
(68, 'nl', '', 'Ruben', 0, '2020-03-09 23:08:39', 18, 'some people live more in 20 years then others do in 80.<br />\r\nIt is not the Time that matters, it is the person.', 'The Tenth Doctor', 'The Lazarus Experiment', '', NULL, 'https://static2.hypable.com/wp-content/uploads/2013/11/DWQuotes10.jpg?324e9a', NULL, NULL, NULL),
(69, 'nl', '', 'Ruben', 0, '2020-03-09 23:32:36', 18, 'Some people live more in 20 years then others do in 80.<br />\r\nIt is not the Time that matters, it is the person.', 'The Tenth Doctor', 'The Lazarus Experiment', '480084438-tumblr_mf7di8t5B91s0g3zwo1_500.gif', NULL, 'https://static2.hypable.com/wp-content/uploads/2013/11/DWQuotes10.jpg?324e9a', NULL, NULL, NULL),
(70, 'nl', '', 'Ruben', 0, '2020-03-10 19:34:06', 19, 'That\'s how I see the universe. Every waking second I can see what is, what was, what could be, what must not. It\'s the burden of a Time Lord, Donna, and I\'m the only one left.', 'Tenth Doctor', 'Fires of Pompeï', '796269.gif', NULL, 'https://img04.deviantart.net/56a7/i/2013/018/5/6/burden_of_a_time_lord_by_lyricalmedley-d5rvcsl.jpg', NULL, NULL, NULL),
(71, 'nl', '', 'Ruben', 0, '2020-03-10 21:18:46', 20, '<strong>The Doctor</strong>: Times end, River, because they have to. Because there\'s no such thing as happy ever after. It\'s just a lie we tell ourselves because the truth is so hard.<br />\r\n<strong>River</strong>: No, Doctor. You\'re wrong. Happy ever after doesn\'t mean forever. It just means time. A little time. But that\'s not the sort of thing you could ever understand, is it?<br />\r\n<strong>The Doctor</strong>: Mmm. What do you think of the towers?<br />\r\n<strong>River</strong>: I love them.<br />\r\n<strong>The Doctor</strong>: Then why are you ignoring them?<br />\r\n<strong>River</strong>: They\'re ignoring me. But, then, you can\'t expect a monolith to love you back.<br />\r\n<strong>The Doctor</strong>: No, you can\'t. They\'ve been there for millions of years, through storms and floods and wars and … time. Nobody really understands where the music comes from. It\'s probably something to do with the precise positions, the distance between both towers. Even the locals aren\'t sure. All anyone will ever tell you is that when the wind stands fair and the night is perfect … when you least expect it … but always… when you need it the most … there is a song.<br />\r\n<strong>River</strong>: So, assuming tonight is all we have left…<br />\r\n<strong>The Doctor</strong>: I didn\'t say that.<br />\r\n<strong>River</strong>: How long … is a night on Darillium?<br />\r\n<strong>The Doctor</strong>: 24 years.<br />\r\n<strong>River</strong>: [she gasps] I hate you.<br />\r\n<strong>The Doctor</strong>: No, you don\'t.<br />\r\n', 'River Song<br />\r\nThe Twelfth Doctor', 'The Husbands of River Song', 'tumblr_ovplrptbYL1v5nbpeo4_400.gif', NULL, 'https://49.media.tumblr.com/048e073addb544705d5e0fedf241c3a7/tumblr_nztrbtK3nz1qijoeyo3_400.gif', NULL, NULL, NULL),
(72, 'nl', '', 'Ruben', 0, '2020-03-10 21:19:50', 20, '<strong>The Doctor</strong>: Times end, River, because they have to. Because there\'s no such thing as happy ever after. It\'s just a lie we tell ourselves because the truth is so hard.<br />\r\n<strong>River</strong>: No, Doctor. You\'re wrong. Happy ever after doesn\'t mean forever. It just means time. A little time. But that\'s not the sort of thing you could ever understand, is it?<br />\r\n<strong>The Doctor</strong>: Mmm. What do you think of the towers?<br />\r\n<strong>River</strong>: I love them.<br />\r\n<strong>The Doctor</strong>: Then why are you ignoring them?<br />\r\n<strong>River</strong>: They\'re ignoring me. But, then, you can\'t expect a monolith to love you back.<br />\r\n<strong>The Doctor</strong>: No, you can\'t. They\'ve been there for millions of years, through storms and floods and wars and … time. Nobody really understands where the music comes from. It\'s probably something to do with the precise positions, the distance between both towers. Even the locals aren\'t sure. All anyone will ever tell you is that when the wind stands fair and the night is perfect … when you least expect it … but always… when you need it the most … there is a song.<br />\r\n<strong>River</strong>: So, assuming tonight is all we have left…<br />\r\n<strong>The Doctor</strong>: I didn\'t say that.<br />\r\n<strong>River</strong>: How long … is a night on Darillium?<br />\r\n<strong>The Doctor</strong>: 24 years.<br />\r\n<strong>River</strong>: [she gasps] I hate you.<br />\r\n<strong>The Doctor</strong>: No, you don\'t.<br />\r\n', 'River Song<br />\r\nThe Twelfth Doctor', 'The Husbands of River Song', 'tumblr_ovplrptbYL1v5nbpeo4_400.gif', NULL, 'https://49.media.tumblr.com/048e073addb544705d5e0fedf241c3a7/tumblr_nztrbtK3nz1qijoeyo3_400.gif', NULL, NULL, NULL),
(73, 'nl', '', 'Ruben', 0, '2020-03-10 21:24:11', 21, '<strong>The Doctor</strong>: Is it sad?<br />\r\n<strong>River</strong>: Why would a diary be sad?<br />\r\n<strong>The Doctor</strong>: I don\'t know, it\'s just that… you look sad.<br />\r\n<strong>River</strong>: It\'s nearly full.<br />\r\n<strong>The Doctor</strong>: So?<br />\r\n<strong>River</strong>: The man who gave me this was the sort of man who\'d know exactly how long a diary you were going to need.<br />\r\n<strong>The Doctor</strong>: He sounds awful.<br />\r\n<strong>River</strong>: I suppose he is. I\'ve never really thought about it.<br />\r\n<strong>The Doctor</strong>: Not somebody special then?<br />\r\n<strong>River</strong>: No. But terribly useful every now and then.', 'River Song<br />\r\nTwelfth Doctor', 'The Husbands of River Song', '9e091870997cae3bb51e49db54a2e819.jpg', NULL, 'https://ichef.bbci.co.uk/images/ic/976x549_b/p03crndk.jpg', NULL, NULL, NULL),
(74, 'nl', '', 'Ruben', 0, '2020-03-10 21:24:23', 21, '<strong>The Doctor</strong>: Is it sad?<br />\r\n<strong>River</strong>: Why would a diary be sad?<br />\r\n<strong>The Doctor</strong>: I don\'t know, it\'s just that… you look sad.<br />\r\n<strong>River</strong>: It\'s nearly full.<br />\r\n<strong>The Doctor</strong>: So?<br />\r\n<strong>River</strong>: The man who gave me this was the sort of man who\'d know exactly how long a diary you were going to need.<br />\r\n<strong>The Doctor</strong>: He sounds awful.<br />\r\n<strong>River</strong>: I suppose he is. I\'ve never really thought about it.<br />\r\n<strong>The Doctor</strong>: Not somebody special then?<br />\r\n<strong>River</strong>: No. But terribly useful every now and then.', 'River Song<br />\r\nThe Twelfth Doctor', 'The Husbands of River Song', '9e091870997cae3bb51e49db54a2e819.jpg', NULL, 'https://ichef.bbci.co.uk/images/ic/976x549_b/p03crndk.jpg', NULL, NULL, NULL),
(75, 'nl', '', 'Ruben', 0, '2020-03-10 21:27:53', 22, 'Through crimson stars and silent stars and tumbling nebulas like oceans set on fire; through empires of glass and civilizations of pure thought, and a whole, terrible, wonderful universe of impossibilities. You see these eyes? They\'re old eyes. And one thing I can tell you, Alex... Monsters are real.', 'The Eleventh Doctor', 'Night Terrors', '88b298b964f6a468c3ad32d74e59b381.jpg', NULL, 'https://s-media-cache-ak0.pinimg.com/236x/8d/58/59/8d5859370da5d2e8ddfacc3d7976851a.jpg', NULL, NULL, NULL),
(76, 'nl', '', 'Ruben', 0, '2020-03-10 21:31:08', 23, 'It\'s like when you\'re a kid. The first time they tell you that the world\'s turning and you just can\'t quite believe it \'cause everything looks like it\'s standing still... I can feel it: the turn of the Earth. The ground beneath our feet is spinning at 1,000 miles an hour and the entire planet is hurtling around the sun at 67,000 miles an hour, and I can feel it. We\'re falling through space, you and me, clinging to the skin of this tiny little world, and if we let go... That\'s who I am.', 'The Ninth Doctor', 'Rose', 'tumblr_m98un6zwcg1qfy88jo7_250.gif', NULL, 'https://s1.narvii.com/image/gc5fyioifo2xvartv3mrqgtjdkcxbzad_hq.jpg', NULL, NULL, NULL),
(77, 'nl', '', 'Ruben', 0, '2020-03-10 21:32:54', 24, 'When you wake up... I\'ll be a story in your head. But that\'s okay. We\'re all stories, in the end... just make it a good one, eh? Because it was. It was the best', 'Eleventh Doctor', 'The Big Bang', '33fba5e4df3013c2652760cf5262a7b0.gif', NULL, 'https://i.ytimg.com/vi/td7CmB3uivI/maxresdefault.jpg', NULL, NULL, NULL),
(78, 'nl', '', 'Ruben', 0, '2020-03-10 21:39:56', 25, 'The very powerful and the very stupid have one thing in common. They don\'t change their views to fit the facts. They change the facts to fit their views. Which can be uncomfortable if you happen to be one of the facts that needs changing.', 'The Fourth Doctor', 'The Face of Evil', '0ff4fa1fa20834981a56cef8b9b2d86d--doctor-quotes-the-doctor.jpg', NULL, 'https://i.pinimg.com/736x/0f/f4/fa/0ff4fa1fa20834981a56cef8b9b2d86d--doctor-quotes-the-doctor.jpg', NULL, NULL, NULL),
(79, 'nl', '', 'Ruben', 0, '2020-03-10 21:42:51', 26, 'Nothing is sad untill it is over, then everything is.', 'Twelfth Doctor', 'Hell Bent', 'tumblr_nyy2wo4eR91sp8b3ro1_500.jpg', NULL, 'https://66.media.tumblr.com/33dbc975a00e91a2c6e460cd5203f84a/tumblr_nyy2wo4eR91sp8b3ro1_500.jpg', NULL, NULL, NULL),
(80, 'nl', '', 'Ruben', 0, '2020-03-10 21:43:01', 26, 'Nothing is sad untill it is over, then everything is.', 'The Twelfth Doctor', 'Hell Bent', 'tumblr_nyy2wo4eR91sp8b3ro1_500.jpg', NULL, 'https://66.media.tumblr.com/33dbc975a00e91a2c6e460cd5203f84a/tumblr_nyy2wo4eR91sp8b3ro1_500.jpg', NULL, NULL, NULL),
(81, 'nl', '', 'Ruben', 0, '2020-03-10 21:44:29', 27, '<strong>The Doctor</strong>: Run like hell because you always need to. Laugh at everything, because it\' s always funny.<br />\r\n<strong>Clara</strong>: No, stop it. You\' re saying goodbye. Don\' t say goodbye.<br />\r\n<strong>The Doctor</strong>: Never be cruel and never be cowardly. And if you ever are, always make amends.<br />\r\n<strong>Clara</strong>: Stop it! Stop, stop it! The Doctor: Never eat pears. They\' re too squishy. And they always make your chin wet. That one\' s quite important. Write it down.', 'The Twelfth Doctor<br />\r\nClara<br />\r\n', 'Hell Bent', 'tumblr_nz2dxnwqYv1u1r9vlo1_400.gif', NULL, 'https://s-media-cache-ak0.pinimg.com/564x/ce/58/b7/ce58b789acb044a5ae0b2764917ea4c9.jpg', NULL, NULL, NULL),
(82, 'nl', '', 'Ruben', 0, '2020-03-10 21:53:43', 28, 'Have you ever thought what it\'s like to be wanderers in the Fourth Dimension? Have you? To be exiles? Susan and I are cut off from our own planet - without friends or protection. But one day we shall get back. Yes, one day.', 'The First Doctor', 'An Unearthly Child', 'a86542016f6ff3f9d72fcbbbbf5176175c7e5041_00.gif', NULL, '../images/Quotes/Have_You_Ever_Fourth_Dimension.png', NULL, NULL, NULL),
(83, 'nl', '', 'Ruben', 0, '2020-03-10 21:54:18', 28, 'Have you ever thought what it\'s like to be wanderers in the Fourth Dimension? Have you? To be exiles? Susan and I are cut off from our own planet - without friends or protection. But one day we shall get back. Yes, one day.', 'The First Doctor', 'An Unearthly Child', 'a86542016f6ff3f9d72fcbbbbf5176175c7e5041_00.gif', NULL, '../images/Quotes/Have_You_Ever_Fourth_Dimension.png', NULL, NULL, NULL),
(84, 'nl', '', 'Ruben', 0, '2020-03-10 21:56:11', 29, 'Let me get this straight. A thing that looks like a police box, standing in a junkyard, it can move anywhere in time and space?', 'Ian Chesterton', 'An Unearthly Child', '3dc4658c9709678200c55986479f6bb81afd92b6_hq.jpg', NULL, '../images/Quotes/3dc4658c9709678200c55986479f6bb81afd92b6_hq.jpg', NULL, NULL, NULL),
(85, 'nl', '', 'Ruben', 0, '2020-03-10 21:58:08', 30, 'You want weapons? We’re in a library! Books! The best weapons in the world!', 'The Tenth Doctor', 'Tooth and Claw', 'tumblr_n9djsjqd3Q1rndtl6o7_r1_250.gif', NULL, '../images/Quotes/Books_Weapons.jpg', NULL, NULL, NULL),
(86, 'nl', '', 'Ruben', 0, '2020-03-10 22:00:14', 31, 'One may tolerate a world of demons for the sake of an angel.', 'Reinette Poisson (Madame de Pompadour)', 'The Girl In The Fireplace', 'af2edf32b12ec5ae5c109f41d81794250a06da38_00.gif', NULL, 'https://i.pinimg.com/736x/e2/01/6e/e2016eb67849946455d5a2e7fda1d4ee--valentine-day-cards-doctor-who-valentines.jpg', NULL, NULL, NULL),
(87, 'nl', '', 'Ruben', 0, '2020-03-10 22:05:16', 32, 'You should always waste time when you don\'t have any. Time is not the boss of you. Rule 408.', 'The Eleventh Doctor', 'Let\'s Kill Hitler', '1d10ec75d8a2aae6479f7ba2f84c91bc.gif', NULL, 'https://i.pinimg.com/736x/73/c6/60/73c6600b56385e21c9147c86a5d3713d.jpg', NULL, NULL, NULL),
(88, 'nl', '', 'Ruben', 0, '2020-03-10 22:11:41', 33, 'Never run when you\'re scared. Rule 7.', 'Eleventh Doctor', 'Let\'s Kill Hitler', 'tumblr_njcx1fYnGy1qaiaoco7_250.gif', NULL, 'https://thumbs.gfycat.com/LargeConcreteCod-small.gif', NULL, NULL, NULL),
(89, 'nl', '', 'Ruben', 0, '2020-03-10 22:12:37', 33, 'Never run when you\'re scared. Rule 7.', 'The Eleventh Doctor', 'Let\'s Kill Hitler', 'tumblr_njcx1fYnGy1qaiaoco7_250.gif', NULL, 'https://thumbs.gfycat.com/LargeConcreteCod-small.gif', NULL, NULL, NULL),
(90, 'nl', '', 'Ruben', 0, '2020-03-10 22:14:58', 34, 'Right now, I\'m a stranger to myself. There\'s echoes of who I was, and a sort of call towards who I am, and I have to hold my nerve and trust all these new instincts. Shape myself towards them. I\'ll be fine, in the end. Hopefully. Well, I have to be because you guys need help. And if there is one thing I\'m certain of, when people need help, I never refuse. Right, this is going to be fun!', 'The Thirteenth Doctor', 'The Woman who Fell to Earth', 'tumblr_pg9xdzw6s81qgapqso7_500.gif', NULL, '../images/gallifreyan_black.png', NULL, NULL, NULL),
(91, 'nl', '', 'Ruben', 0, '2020-03-10 22:16:36', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'The Eleventh Doctor', 'A Chtistmas Carol', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, NULL, NULL),
(92, 'nl', '', 'Ruben', 0, '2020-03-10 22:16:49', 4, 'People assume that time is a strict progression of cause to effect, but actually from a non-linear, non-subjective viewpoint, it\'s more like a big ball of wibbly-wobbly, timey-wimey stuff. ', 'The Tenth Doctor', 'Blink', 'blink_by_becausebowtiesrcool.jpg', NULL, '../images/Quotes/blink_by_becausebowtiesrcool.jpg', NULL, NULL, NULL),
(93, 'nl', '', 'Ruben', 0, '2020-03-10 22:17:01', 5, 'No More.', 'The War Doctor<br />\r\nThe Moment disguised as Bad Wolf', 'Day of the Doctor', 'tumblr_mwqao1Ruia1qijoeyo1_400.gif', NULL, 'https://38.media.tumblr.com/85e176a1bc1a09035a000aaf36c3394f/tumblr_mwqao1Ruia1qijoeyo1_400.gif', NULL, NULL, NULL),
(94, 'nl', '', 'Ruben', 0, '2020-03-10 22:17:26', 7, '<strong>Clara</strong>: Who\'s that?<br />\r\n<strong>The Doctor</strong>: Never mind. Let\'s go back.<br />\r\n<strong>Clara</strong>: But who is he?<br />\r\n<strong>The Doctor</strong>: He\'s me. There\'s only me here. That\'s the point. Now let\'s get back.<br />\r\n<strong>Clara</strong>: But I never saw that one. I saw all of you. Eleven faces, all of them you! You\'re the eleventh Doctor!<br />\r\n<strong>The Doctor</strong>: I said he was me. I never said he was the Doctor.<br />\r\n<strong>Clara</strong>: I don\'t understand.<br />\r\n<strong>The Doctor</strong>: My name, my real name - that is not the point. The name I chose is the Doctor. The name you choose, is like... it\'s like a promise you make. He\'s the one who broke the promise.<br />\r\n<strong>The Doctor</strong>: Clara? Clara! Clara! The Doctor: He is my secret. ', 'The Eleventh Doctor<br />\r\nClara', 'Name of the Doctor', '0b0bd4f3b2333a126a7ea4dc5bfd11f4.jpg', NULL, 'https://static2.hypable.com/wp-content/uploads/2013/12/quote8.png', NULL, NULL, NULL),
(95, 'nl', '', 'Ruben', 0, '2020-03-10 22:17:43', 9, '<strong>The Eleventh Docto</strong>r: He\'s my secret<br />\r\n<strong>The War Doctor</strong>: What I did, I did without choice.<br />\r\n<strong>The Eleventh Doctor</strong>: I know.<br />\r\n<strong>The War Doctor</strong>: In the name of peace and Sanity.<br />\r\n<strong>The Eleventh Doctor</strong>: But not in the name of The Doctor.', 'The War Doctor<br />\r\nThe Eleventh Doctor', 'the Name of the Doctor', '46c7fca47db66fd04ee132b902664e91.png', NULL, 'https://img.desmotivaciones.es/201305/descarga_171.jpg', NULL, NULL, NULL),
(96, 'nl', '', 'Ruben', 0, '2020-03-10 22:19:54', 9, '<strong>The Eleventh Docto</strong>r: He\'s my secret<br />\r\n<strong>The War Doctor</strong>: What I did, I did without choice.<br />\r\n<strong>The Eleventh Doctor</strong>: I know.<br />\r\n<strong>The War Doctor</strong>: In the name of peace and Sanity.<br />\r\n<strong>The Eleventh Doctor</strong>: But not in the name of The Doctor.', 'The War Doctor<br />\r\nThe Eleventh Doctor', 'the Name of the Doctor', '46c7fca47db66fd04ee132b902664e91.png', NULL, 'https://img.desmotivaciones.es/201305/descarga_171.jpg', NULL, NULL, NULL),
(97, 'nl', '', 'Ruben', 0, '2020-03-10 22:20:24', 11, '<strong>Clara</strong>: It\'s no good, Bonnie. You can\'t win.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I don\'t care.<br />\r\n<strong>The Twelfth Doctor</strong>: Hi! Hello! Hello!<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, hello! Hi. Hi. Stop this. Stop this, please. Let me take both of these boxes away. We\'ll forgive, we\'ll forget. And the ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No.<br />\r\n<strong>Kate</strong>: Doctor, which of these buttons do I press? Doctor, which one? Truth or consequences?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Truth or consequences?<br />\r\n<strong>The Twelfth Doctor</strong>: This is the moment we\'ve all been waiting for. Make your mind up time!<br />\r\nOne of those buttons will destroy the Zygons, release the imbecile\'s gas. The other one detonates the nuclear warhead under the Black Archive. It\'ll destroy everyone in London. Bonnie. Bonnie, sweetheart! One of those buttons will unmask every Zygon in the world. The other one cancels their ability to change form. It\'ll make them human beings for ever. There are safeguards beyond safeguards. I did this on a very important day for me and this ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: This is wrong.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You are responsible for all the violence. All of the suffering.<br />\r\n<strong>The Twelfth Doctor</strong>: No, I\'m not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes.<br />\r\n<strong>The Twelfth Doctor</strong>: No.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes. You engineered this situation, Doctor. This is your fault.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not. It\'s your fault.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I had to do what I\'ve done.<br />\r\n<strong>The Twelfth Doctor</strong>: So did I.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been treated like cattle.<br />\r\n<strong>The Twelfth Doctor</strong>: So what.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been left to fend for ourselves.<br />\r\n<strong>The Twelfth Doctor</strong>: So\'s everyone.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>:&nbsp;It\'s not fair.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, it\'s not fair! Oh, I didn\'t realise that it was not fair! Well, you know what? My Tardis doesn\'t work properly and I don\'t have my own personal tailor.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: The things don\'t equate.<br />\r\n<strong>The Twelfth Doctor</strong>: These things have happened, Zygella. They are facts. You just want cruelty to beget cruelty. You\'re not superior to people who were cruel to you. you\'re just a whole bunch of new cruel people. A whole bunch of new cruel people being cruel to some other people, who\'ll end up being cruel to you. The only way anyone can live in peace is if they\'re prepared to forgive. Why don\'t you break the cycle?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why should we?<br />\r\n<strong>The Twelfth Doctor</strong>: What is it that you actually want?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: War.<br />\r\n<strong>The Twelfth Doctor</strong>: Ah. Ah, right. And when this war is over, when you have a homeland free from humans, what do you think it\'s going to be like? Do you know? Have you thought about it? Have you given it any consideration? Because you\'re very close to getting what you want. What\'s it going to be like? Paint me a picture. Are you going to live in houses? Do you want people to go to work? Will there be holidays? Oh! Will there be music? Do you think people will be allowed to play violins? Who\'s going to make the violins? Well? Oh, you don\'t actually know, do you? Because, like every other tantrumming child in history, Bonnie, you don\'t actually know what you want. So, let me ask you a question about this brave new world of yours. When you\'ve killed all the bad guys, and when it\'s all perfect and just and fair, when you have finally got it exactly the way you want it, what are you going to do with the people like you? The troublemakers. How are you going to protect your glorious revolution from the next one?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ll win.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, will you? Well, maybe, maybe you will win! But nobody wins for long. The wheel just keeps turning. So, come on. Break the cycle.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you still talking?<br />\r\n<strong>The Twelfth Doctor</strong>: Because I want to get you to see, and I\'m almost there!<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Do you know what I see, Doctor? A box. A box with everything I need. A fifty percent chance.<br />\r\n<strong>Kate</strong>: For us, too.<br />\r\n<strong>The Twelfth Doctor</strong>: And we\'re off! Fingers on buzzers! Are you feeling lucky? Are you ready to play the game? Who\'s going to be quickest? Who\'s going to be luckiest?<br />\r\n<strong>Kate</strong>: This is not a game!<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not a game, sweetheart, and I mean that most sincerely.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you doing this?<br />\r\n<strong>Kate</strong>: Yes, I\'d quite like to know that, too. You set this up. Why?<br />\r\n<strong>The Twelfth Doctor</strong>: Because it\'s not a game, Kate. This is a scale model of war. Every war ever fought, right there in front of you. Because it\'s always the same. When you fire that first shot, no matter how right you feel, you have no idea who\'s going to die! You don\'t know whose children are going to scream and burn! How many hearts will be broken! How many lives shattered! How much blood will spill until everybody does until what they were always going to have to do from the very beginning. Sit down and talk! Listen to me. Listen, I just, I just want you to think. Do you know what thinking is? It\'s just a fancy word for changing your mind.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I will not change my mind.<br />\r\n<strong>The Twelfth Doctor</strong>: Then you will die stupid. Alternatively, you could step away from that box, you can walk right out of that door and you could stand your revolution down.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No! I\'m not stopping this, Doctor. I started it. I will not stop it. You think they\'ll let me go, after what I\'ve done?<br />\r\n<strong>The Twelfth Doctor</strong>: You\'re all the same, you screaming kids. You know that? «Look at me, I\'m unforgivable.» Well, here\'s the unforeseeable. I forgive you. After all you\'ve done, I forgive you.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You don\'t understand. You will never understand.<br />\r\n<strong>The Twelfth Doctor</strong>: I don\'t understand? Are you kidding? Me? Of course I understand. I mean, do you call this a war? This funny little thing? This is not a war! I fought in a bigger war than you will ever know. I did worse things than you could ever imagine. And when I close my eyes I hear more screams than anyone could ever be able to count! And do you know what you do with all that pain? Shall I tell you where you put it? You hold it tight till it burns your hand, and you say this. No one else will ever have to live like this. No one else will have to feel this pain. Not on my watch!<br />\r\n<strong>The Twelfth Doctor</strong>: Thank you. Thank you.<br />\r\n<strong>Kate</strong>: I\'m sorry.<br />\r\n<strong>The Twelfth Doctor</strong>: I know. I know. Thank you. Well?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: It\'s empty, isn\'t it? Both boxes. There\'s nothing in them. Just buttons.<br />\r\n<strong>The Twelfth Doctor</strong>: Of course. And do you know how you know that? Because you\'ve started to think like me.<br />\r\n<strong>The Twelfth Doctor</strong>: It\'s hell, isn\'t it? No one should have to think like that. And no one will. Not on our watch. Gotcha.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: How can you be so sure?<br />\r\n<strong>The Twelfth Doctor</strong>: Because you have a disadvantage, Zygella. I know that face.<br />\r\n<strong>Kate</strong>: This is all very well, but we know the boxes are empty now. We can\'t forget that.<br />\r\n<strong>The Twelfth Doctor</strong>: No, well, er, you\'ve said that the last fifteen times. ', 'The Twelfth Doctor<br />\r\nKate<br />\r\nBonnie (Clara)<br />\r\nClara<br />\r\n', 'The Zygon Inversion', 'CTut-JZWEAAWRpT.jpg', NULL, 'https://4.bp.blogspot.com/-mOOCMSXB_Zw/Vj-PTbzbF7I/AAAAAAAATpo/_WQGMIvi5-A/s1600/The%2BZygon%2BInversion%2BOsgood%2BBoxes.jpg', NULL, NULL, NULL),
(98, 'nl', '', 'Ruben', 0, '2020-03-10 22:21:30', 1, '<strong>Yaz</strong>: Have you got family?<br />\r\n<strong>The Doctor</strong>: No. Lost them a long time ago.<br />\r\n<strong>Ryan</strong>: How\'d you cope with that?<br />\r\n<strong>The Doctor</strong>: I carry them with me. What they would have thought, and said, and done. Make them a part of who I am. So even though they’re gone from the world, they’re never gone from me.', 'The Thirteenth Doctor<br />\r\nYasmin Khan (Yaz)<br />\r\nRyan', 'The Woman Who Fell to Eath', 'download.gif', NULL, '', NULL, NULL, NULL),
(99, 'nl', '', 'Ruben', 0, '2020-03-10 22:22:03', 1, '<strong>Yaz</strong>: Have you got family?<br />\r\n<strong>The Doctor</strong>: No. Lost them a long time ago.<br />\r\n<strong>Ryan</strong>: How\'d you cope with that?<br />\r\n<strong>The Doctor</strong>: I carry them with me. What they would have thought, and said, and done. Make them a part of who I am. So even though they’re gone from the world, they’re never gone from me.', 'The Thirteenth Doctor<br />\r\nYasmin Khan (Yaz)<br />\r\nRyan', 'The Woman Who Fell to Eath', 'download.gif', NULL, '', NULL, NULL, NULL),
(100, 'nl', '', 'Ruben', 0, '2020-03-10 22:22:26', 13, 'I am not a good man! I am not a bad man. I am not a hero. And I\'m definitely not a president. And no, I\'m not an officer. Do you know what I am? I am an idiot, with a box and a screwdriver. Just passing through, helping out, learning. I don\'t need an army. I never have, because I\'ve got them. Always them. Because love, it\'s not an emotion. Love is a promise. ', 'The Twelfth Doctor', 'Death in Heaven', 'b7bf0061c163ea867cdd1e0c6e28ffa8.jpg', NULL, 'https://s-media-cache-ak0.pinimg.com/736x/b7/bf/00/b7bf0061c163ea867cdd1e0c6e28ffa8.jpg', NULL, NULL, NULL),
(101, 'nl', '', 'Ruben', 0, '2020-03-10 22:22:42', 14, 'You gave me hope, and then you took it away. That\'s enough to make anyone dangerous. God knows what it will do to me.', 'The Eleventh Doctor', 'The Doctor\'s Wife', 'doctor-who-11 is dangerous.gif', NULL, 'https://cdn.pastemagazine.com/www/articles/doctor-who-11%20is%20dangerous.gif', NULL, NULL, NULL),
(102, 'nl', '', 'Ruben', 0, '2020-03-10 22:22:56', 15, 'Better a broken heart than no heart at all.', 'The Eleventh Doctor', 'A Christmas Carol', 'tumblr_midplhjzqb1ron04jo1_r2_500.gif', NULL, 'https://25.media.tumblr.com/9abbc46e023538412436dd09f7a17923/tumblr_midplhjzqb1ron04jo1_r2_500.gif', NULL, NULL, NULL),
(103, 'nl', '', 'Ruben', 0, '2020-03-10 22:23:19', 19, 'That\'s how I see the universe. Every waking second I can see what is, what was, what could be, what must not. It\'s the burden of a Time Lord, Donna, and I\'m the only one left.', 'The Tenth Doctor', 'Fires of Pompeï', '796269.gif', NULL, 'https://img04.deviantart.net/56a7/i/2013/018/5/6/burden_of_a_time_lord_by_lyricalmedley-d5rvcsl.jpg', NULL, NULL, NULL),
(104, 'nl', '', 'Ruben', 0, '2020-03-10 22:23:45', 20, '<strong>The Doctor</strong>: Times end, River, because they have to. Because there\'s no such thing as happy ever after. It\'s just a lie we tell ourselves because the truth is so hard.<br />\r\n<strong>River</strong>: No, Doctor. You\'re wrong. Happy ever after doesn\'t mean forever. It just means time. A little time. But that\'s not the sort of thing you could ever understand, is it?<br />\r\n<strong>The Doctor</strong>: Mmm. What do you think of the towers?<br />\r\n<strong>River</strong>: I love them.<br />\r\n<strong>The Doctor</strong>: Then why are you ignoring them?<br />\r\n<strong>River</strong>: They\'re ignoring me. But, then, you can\'t expect a monolith to love you back.<br />\r\n<strong>The Doctor</strong>: No, you can\'t. They\'ve been there for millions of years, through storms and floods and wars and … time. Nobody really understands where the music comes from. It\'s probably something to do with the precise positions, the distance between both towers. Even the locals aren\'t sure. All anyone will ever tell you is that when the wind stands fair and the night is perfect … when you least expect it … but always… when you need it the most … there is a song.<br />\r\n<strong>River</strong>: So, assuming tonight is all we have left…<br />\r\n<strong>The Doctor</strong>: I didn\'t say that.<br />\r\n<strong>River</strong>: How long … is a night on Darillium?<br />\r\n<strong>The Doctor</strong>: 24 years.<br />\r\n<strong>River</strong>: [she gasps] I hate you.<br />\r\n<strong>The Doctor</strong>: No, you don\'t.<br />\r\n', 'The Twelfth Doctor<br />\r\nRiver Song<br />\r\n', 'The Husbands of River Song', 'tumblr_ovplrptbYL1v5nbpeo4_400.gif', NULL, 'https://49.media.tumblr.com/048e073addb544705d5e0fedf241c3a7/tumblr_nztrbtK3nz1qijoeyo3_400.gif', NULL, NULL, NULL),
(105, 'nl', '', 'Ruben', 0, '2020-03-10 22:24:01', 21, '<strong>The Doctor</strong>: Is it sad?<br />\r\n<strong>River</strong>: Why would a diary be sad?<br />\r\n<strong>The Doctor</strong>: I don\'t know, it\'s just that… you look sad.<br />\r\n<strong>River</strong>: It\'s nearly full.<br />\r\n<strong>The Doctor</strong>: So?<br />\r\n<strong>River</strong>: The man who gave me this was the sort of man who\'d know exactly how long a diary you were going to need.<br />\r\n<strong>The Doctor</strong>: He sounds awful.<br />\r\n<strong>River</strong>: I suppose he is. I\'ve never really thought about it.<br />\r\n<strong>The Doctor</strong>: Not somebody special then?<br />\r\n<strong>River</strong>: No. But terribly useful every now and then.', 'The Twelfth Doctor<br />\r\nRiver Song<br />\r\n', 'The Husbands of River Song', '9e091870997cae3bb51e49db54a2e819.jpg', NULL, 'https://ichef.bbci.co.uk/images/ic/976x549_b/p03crndk.jpg', NULL, NULL, NULL),
(106, 'nl', '', 'Ruben', 0, '2020-06-09 15:32:53', 2, '<strong>Clara</strong>: You\'re going to help me?<br />\r\n<strong>The Doctor</strong>: Well, why wouldn\'t I help you?<br />\r\n<strong>Clara</strong>: Because what I just did. I--<br />\r\n<strong>The Doctor</strong>: You betrayed me. You betrayed my trust, you betrayed our friendship, you betrayed everything I ever stood for. You let me down!<br />\r\n<strong>Clara</strong>: Then why are you helping me?<br />\r\n<strong>The Doctor</strong>: Why? Do you think I care for you so little that betraying me would make a difference?', 'The Twelfth Doctor<br />\r\nClara Oswald', 'Dark Water', 'p02bvbyk.jpg', NULL, '', 1147, '', '1.0000'),
(107, 'nl', '', 'Ruben', 0, '2020-06-09 15:33:10', 7, '<strong>Clara</strong>: Who\'s that?<br />\r\n<strong>The Doctor</strong>: Never mind. Let\'s go back.<br />\r\n<strong>Clara</strong>: But who is he?<br />\r\n<strong>The Doctor</strong>: He\'s me. There\'s only me here. That\'s the point. Now let\'s get back.<br />\r\n<strong>Clara</strong>: But I never saw that one. I saw all of you. Eleven faces, all of them you! You\'re the eleventh Doctor!<br />\r\n<strong>The Doctor</strong>: I said he was me. I never said he was the Doctor.<br />\r\n<strong>Clara</strong>: I don\'t understand.<br />\r\n<strong>The Doctor</strong>: My name, my real name - that is not the point. The name I chose is the Doctor. The name you choose, is like... it\'s like a promise you make. He\'s the one who broke the promise.<br />\r\n<strong>The Doctor</strong>: Clara? Clara! Clara! The Doctor: He is my secret. ', 'The Eleventh Doctor<br />\r\nClara Oswald', 'Name of the Doctor', '0b0bd4f3b2333a126a7ea4dc5bfd11f4.jpg', NULL, 'https://static2.hypable.com/wp-content/uploads/2013/12/quote8.png', 1134, '', '1.0000'),
(108, 'nl', '', 'Ruben', 0, '2020-06-09 15:33:56', 11, '<strong>Clara</strong>: It\'s no good, Bonnie. You can\'t win.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I don\'t care.<br />\r\n<strong>The Twelfth Doctor</strong>: Hi! Hello! Hello!<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, hello! Hi. Hi. Stop this. Stop this, please. Let me take both of these boxes away. We\'ll forgive, we\'ll forget. And the ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No.<br />\r\n<strong>Kate</strong>: Doctor, which of these buttons do I press? Doctor, which one? Truth or consequences?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Truth or consequences?<br />\r\n<strong>The Twelfth Doctor</strong>: This is the moment we\'ve all been waiting for. Make your mind up time!<br />\r\nOne of those buttons will destroy the Zygons, release the imbecile\'s gas. The other one detonates the nuclear warhead under the Black Archive. It\'ll destroy everyone in London. Bonnie. Bonnie, sweetheart! One of those buttons will unmask every Zygon in the world. The other one cancels their ability to change form. It\'ll make them human beings for ever. There are safeguards beyond safeguards. I did this on a very important day for me and this ceasefire will stand.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: This is wrong.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You are responsible for all the violence. All of the suffering.<br />\r\n<strong>The Twelfth Doctor</strong>: No, I\'m not.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes.<br />\r\n<strong>The Twelfth Doctor</strong>: No.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Yes. You engineered this situation, Doctor. This is your fault.<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not. It\'s your fault.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I had to do what I\'ve done.<br />\r\n<strong>The Twelfth Doctor</strong>: So did I.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been treated like cattle.<br />\r\n<strong>The Twelfth Doctor</strong>: So what.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ve been left to fend for ourselves.<br />\r\n<strong>The Twelfth Doctor</strong>: So\'s everyone.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>:&nbsp;It\'s not fair.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, it\'s not fair! Oh, I didn\'t realise that it was not fair! Well, you know what? My Tardis doesn\'t work properly and I don\'t have my own personal tailor.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: The things don\'t equate.<br />\r\n<strong>The Twelfth Doctor</strong>: These things have happened, Zygella. They are facts. You just want cruelty to beget cruelty. You\'re not superior to people who were cruel to you. you\'re just a whole bunch of new cruel people. A whole bunch of new cruel people being cruel to some other people, who\'ll end up being cruel to you. The only way anyone can live in peace is if they\'re prepared to forgive. Why don\'t you break the cycle?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why should we?<br />\r\n<strong>The Twelfth Doctor</strong>: What is it that you actually want?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: War.<br />\r\n<strong>The Twelfth Doctor</strong>: Ah. Ah, right. And when this war is over, when you have a homeland free from humans, what do you think it\'s going to be like? Do you know? Have you thought about it? Have you given it any consideration? Because you\'re very close to getting what you want. What\'s it going to be like? Paint me a picture. Are you going to live in houses? Do you want people to go to work? Will there be holidays? Oh! Will there be music? Do you think people will be allowed to play violins? Who\'s going to make the violins? Well? Oh, you don\'t actually know, do you? Because, like every other tantrumming child in history, Bonnie, you don\'t actually know what you want. So, let me ask you a question about this brave new world of yours. When you\'ve killed all the bad guys, and when it\'s all perfect and just and fair, when you have finally got it exactly the way you want it, what are you going to do with the people like you? The troublemakers. How are you going to protect your glorious revolution from the next one?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: We\'ll win.<br />\r\n<strong>The Twelfth Doctor</strong>: Oh, will you? Well, maybe, maybe you will win! But nobody wins for long. The wheel just keeps turning. So, come on. Break the cycle.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you still talking?<br />\r\n<strong>The Twelfth Doctor</strong>: Because I want to get you to see, and I\'m almost there!<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Do you know what I see, Doctor? A box. A box with everything I need. A fifty percent chance.<br />\r\n<strong>Kate</strong>: For us, too.<br />\r\n<strong>The Twelfth Doctor</strong>: And we\'re off! Fingers on buzzers! Are you feeling lucky? Are you ready to play the game? Who\'s going to be quickest? Who\'s going to be luckiest?<br />\r\n<strong>Kate</strong>: This is not a game!<br />\r\n<strong>The Twelfth Doctor</strong>: No, it\'s not a game, sweetheart, and I mean that most sincerely.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: Why are you doing this?<br />\r\n<strong>Kate</strong>: Yes, I\'d quite like to know that, too. You set this up. Why?<br />\r\n<strong>The Twelfth Doctor</strong>: Because it\'s not a game, Kate. This is a scale model of war. Every war ever fought, right there in front of you. Because it\'s always the same. When you fire that first shot, no matter how right you feel, you have no idea who\'s going to die! You don\'t know whose children are going to scream and burn! How many hearts will be broken! How many lives shattered! How much blood will spill until everybody does until what they were always going to have to do from the very beginning. Sit down and talk! Listen to me. Listen, I just, I just want you to think. Do you know what thinking is? It\'s just a fancy word for changing your mind.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: I will not change my mind.<br />\r\n<strong>The Twelfth Doctor</strong>: Then you will die stupid. Alternatively, you could step away from that box, you can walk right out of that door and you could stand your revolution down.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: No! I\'m not stopping this, Doctor. I started it. I will not stop it. You think they\'ll let me go, after what I\'ve done?<br />\r\n<strong>The Twelfth Doctor</strong>: You\'re all the same, you screaming kids. You know that? «Look at me, I\'m unforgivable.» Well, here\'s the unforeseeable. I forgive you. After all you\'ve done, I forgive you.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: You don\'t understand. You will never understand.<br />\r\n<strong>The Twelfth Doctor</strong>: I don\'t understand? Are you kidding? Me? Of course I understand. I mean, do you call this a war? This funny little thing? This is not a war! I fought in a bigger war than you will ever know. I did worse things than you could ever imagine. And when I close my eyes I hear more screams than anyone could ever be able to count! And do you know what you do with all that pain? Shall I tell you where you put it? You hold it tight till it burns your hand, and you say this. No one else will ever have to live like this. No one else will have to feel this pain. Not on my watch!<br />\r\n<strong>The Twelfth Doctor</strong>: Thank you. Thank you.<br />\r\n<strong>Kate</strong>: I\'m sorry.<br />\r\n<strong>The Twelfth Doctor</strong>: I know. I know. Thank you. Well?<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: It\'s empty, isn\'t it? Both boxes. There\'s nothing in them. Just buttons.<br />\r\n<strong>The Twelfth Doctor</strong>: Of course. And do you know how you know that? Because you\'ve started to think like me.<br />\r\n<strong>The Twelfth Doctor</strong>: It\'s hell, isn\'t it? No one should have to think like that. And no one will. Not on our watch. Gotcha.<br />\r\n<strong>Bonnie (Clara Zygon)</strong>: How can you be so sure?<br />\r\n<strong>The Twelfth Doctor</strong>: Because you have a disadvantage, Zygella. I know that face.<br />\r\n<strong>Kate</strong>: This is all very well, but we know the boxes are empty now. We can\'t forget that.<br />\r\n<strong>The Twelfth Doctor</strong>: No, well, er, you\'ve said that the last fifteen times. ', 'The Twelfth Doctor<br />\r\nKate Lethbridge Stewart<br />\r\nBonnie (Clara)<br />\r\nClara Oswald<br />\r\n', 'The Zygon Inversion', 'CTut-JZWEAAWRpT.jpg', NULL, 'https://4.bp.blogspot.com/-mOOCMSXB_Zw/Vj-PTbzbF7I/AAAAAAAATpo/_WQGMIvi5-A/s1600/The%2BZygon%2BInversion%2BOsgood%2BBoxes.jpg', 1157, 'wideItem', '2.0000'),
(109, 'nl', '', 'Ruben', 0, '2020-06-09 15:34:14', 27, '<strong>The Doctor</strong>: Run like hell because you always need to. Laugh at everything, because it\' s always funny.<br />\r\n<strong>Clara</strong>: No, stop it. You\' re saying goodbye. Don\' t say goodbye.<br />\r\n<strong>The Doctor</strong>: Never be cruel and never be cowardly. And if you ever are, always make amends.<br />\r\n<strong>Clara</strong>: Stop it! Stop, stop it! The Doctor: Never eat pears. They\' re too squishy. And they always make your chin wet. That one\' s quite important. Write it down.', 'The Twelfth Doctor<br />\r\nClara Oswald<br />\r\n', 'Hell Bent', 'tumblr_nz2dxnwqYv1u1r9vlo1_400.gif', NULL, 'https://s-media-cache-ak0.pinimg.com/564x/ce/58/b7/ce58b789acb044a5ae0b2764917ea4c9.jpg', 1161, '', '1.0000'),
(110, 'nl', '', 'Ruben', 0, '2020-09-26 22:29:21', 3, 'In 900 years of time and space, I\'ve never met anyone who wasn\'t important.', 'The Eleventh Doctor', 'A Chtistmas Carol', 'tumblr_lp7kbaYor71qejx1wo1_500.gif', NULL, 'https://38.media.tumblr.com/tumblr_lp7kbaYor71qejx1wo1_500.gif', 1104, '', '1.0000'),
(111, 'nl', '', 'Ruben', 0, '2020-09-26 22:29:39', 1, '<strong>Yaz</strong>: Have you got family?<br />\r\n<strong>The Doctor</strong>: No. Lost them a long time ago.<br />\r\n<strong>Ryan</strong>: How\'d you cope with that?<br />\r\n<strong>The Doctor</strong>: I carry them with me. What they would have thought, and said, and done. Make them a part of who I am. So even though they’re gone from the world, they’re never gone from me.', 'The Thirteenth Doctor<br />\r\nYasmin Khan (Yaz)<br />\r\nRyan', 'The Woman Who Fell to Earth', 'download.gif', NULL, '', 1465, '', '1.0000'),
(112, 'nl', '', 'Ruben', 0, '2020-09-26 22:38:16', 32, 'You should always waste time when you don\'t have any. Time is not the boss of you. Rule 408.', 'The Eleventh Doctor', 'Let\'s Kill Hitler', '1d10ec75d8a2aae6479f7ba2f84c91bc.gif', NULL, 'https://i.pinimg.com/736x/73/c6/60/73c6600b56385e21c9147c86a5d3713d.jpg', 1112, '', '1.0000'),
(113, 'nl', '', 'Ruben', 0, '2020-09-30 21:06:00', 35, '<span style=\"color: rgb(29, 28, 28); font-family: SofiaPro, sans-serif; font-size: 16px;\">A straight line may be the shortest distance between two points, but it is by no means the most interesting.</span>', 'Third Doctor', 'The Time Warrior', 'c1a2872f37db4ebda89c6f2bb27834df.gif', NULL, '', 1246, 'smallItem', '1.0000'),
(114, 'nl', '', 'Ruben', 0, '2020-09-30 21:06:11', 35, '<span style=\"color: rgb(29, 28, 28); font-family: SofiaPro, sans-serif; font-size: 16px;\">A straight line may be the shortest distance between two points, but it is by no means the most interesting.</span>', 'The Third Doctor', 'The Time Warrior', 'c1a2872f37db4ebda89c6f2bb27834df.gif', NULL, '', 1246, 'smallItem', '1.0000'),
(115, 'nl', '', 'Ruben', 0, '2020-09-30 21:08:29', 36, 'The universe has to move forward. Pain and loss, they define us as much as happiness or love. Whether it’s a world, or a relationship… Everything has its time. And everything ends.', 'Sarah-Jane Smith', 'School Reunion', 'fc232a664915f904267f7253dd6ab7dd.jpg', NULL, '', 1017, 'smallItem', '1.0000'),
(116, 'nl', '', 'Ruben', 0, '2020-09-30 21:08:44', 35, 'A straight line may be the shortest distance between two points, but it is by no means the most interesting.', 'The Third Doctor', 'The Time Warrior', 'c1a2872f37db4ebda89c6f2bb27834df.gif', NULL, '', 1246, 'smallItem', '1.0000'),
(117, 'nl', '', 'Ruben', 0, '2020-09-30 21:09:29', 36, 'The universe has to move forward. Pain and loss, they define us as much as happiness or love. Whether it’s a world, or a relationship… Everything has its time. And everything ends.', 'Sarah Jane Smith', 'School Reunion', 'fc232a664915f904267f7253dd6ab7dd.jpg', NULL, '', 1017, 'smallItem', '1.0000'),
(118, 'nl', '', 'Ruben', 0, '2020-09-30 21:16:14', 37, 'Human progress isn\'t measured by industry. It\'s measured by the value you place on a life... an unimportant life... a life without privilege. The boy who died on the river, that boy\'s value is your value. That\'s what defines an age. That\'s... what defines a species.', 'Twelth Doctor', 'Thin Ice', '8901ab8eaaa1d616fc7296d3b64bff4e.jpg', NULL, '', 1166, 'smallItem', '1.0000');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Roles`
--

CREATE TABLE `Roles` (
  `Rol_Id` int(11) NOT NULL,
  `Rol_Naam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Roles`
--

INSERT INTO `Roles` (`Rol_Id`, `Rol_Naam`) VALUES
(1, 'Admin'),
(2, 'Content-writer');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `talen`
--

CREATE TABLE `talen` (
  `taal_id` int(11) NOT NULL,
  `taal_naam` varchar(20) NOT NULL,
  `T_Owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `talen`
--

INSERT INTO `talen` (`taal_id`, `taal_naam`, `T_Owner`) VALUES
(1, 'nl_BE', 1),
(2, 'en_UK', 1),
(3, 'nl_NL', 1),
(4, 'en_US', 1),
(5, 'nl', 1),
(6, 'en', 1),
(27, 'en$', 1),
(28, 'l', 1),
(29, 'enb', 1),
(30, 'nl_NLµ', 1),
(31, 'vs', 1),
(32, 'us', 1),
(33, 'fr', 1),
(34, 'e', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `talen__history`
--

CREATE TABLE `talen__history` (
  `history__id` int(11) NOT NULL,
  `history__language` varchar(2) DEFAULT NULL,
  `history__comments` text DEFAULT NULL,
  `history__user` varchar(32) DEFAULT NULL,
  `history__state` int(5) DEFAULT 0,
  `history__modified` datetime DEFAULT NULL,
  `taal_id` int(11) DEFAULT NULL,
  `taal_naam` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `talen__history`
--

INSERT INTO `talen__history` (`history__id`, `history__language`, `history__comments`, `history__user`, `history__state`, `history__modified`, `taal_id`, `taal_naam`) VALUES
(1, 'nl', '', 'Ruben', 0, '2020-01-27 19:52:38', 3, 'nl_NL'),
(2, 'nl', '', 'Ruben', 0, '2020-01-27 19:52:43', 4, 'en_US'),
(3, 'nl', '', 'Ruben', 0, '2020-01-27 20:36:02', 5, 'nl'),
(4, 'nl', '', 'Ruben', 0, '2020-01-27 20:37:02', 6, 'en'),
(5, 'nl', '', 'Ruben', 0, '2020-01-27 20:40:39', 7, 'n'),
(6, 'nl', '', 'Ruben', 0, '2020-01-28 12:19:48', 8, 'edn'),
(7, 'nl', '', 'Ruben', 0, '2020-02-10 14:08:47', 9, 'nl_BEµ'),
(8, 'nl', '', 'Ruben', 0, '2020-03-18 00:14:52', 10, 'nl$'),
(9, 'nl', '', 'Ruben', 0, '2020-03-22 17:44:54', 11, 'l'),
(10, 'nl', '', 'Ruben', 0, '2020-03-22 18:01:16', 12, 'ezn'),
(11, 'nl', '', 'Ruben', 0, '2020-03-31 11:50:22', 13, 'n'),
(12, 'nl', '', 'Ruben', 0, '2020-04-11 10:16:06', 14, 'e'),
(13, 'nl', '', 'Ruben', 0, '2020-04-16 11:06:42', 15, 'en$'),
(14, 'nl', '', 'Ruben', 0, '2020-04-18 10:41:44', 16, 'en_USµ'),
(15, 'nl', '', 'Ruben', 0, '2020-04-22 20:07:36', 17, 'e'),
(16, 'nl', '', 'Ruben', 0, '2020-04-23 19:11:19', 18, 'en_USµ'),
(17, 'nl', '', 'Ruben', 0, '2020-04-23 19:11:24', 18, 'en_US'),
(18, 'nl', '', 'Ruben', 0, '2020-05-09 22:06:46', 19, 'nl_NLµ'),
(19, 'nl', '', 'Ruben', 0, '2020-05-10 19:37:21', 20, 'nl$'),
(20, 'nl', '', 'Ruben', 0, '2020-05-10 21:29:59', 21, 'e'),
(21, 'nl', '', 'Ruben', 0, '2020-05-19 19:44:01', 22, 'nl$en'),
(22, 'nl', '', 'Ruben', 0, '2020-05-25 18:29:57', 23, 'nl$'),
(23, 'nl', '', 'Ruben', 0, '2020-06-13 21:31:11', 24, 'n'),
(24, 'nl', '', 'Ruben', 0, '2020-06-26 21:04:17', 25, 'en$'),
(25, 'nl', '', 'Ruben', 0, '2020-07-05 18:35:15', 26, 'en_UKe'),
(26, 'nl', '', 'Ruben', 0, '2020-07-05 18:35:19', 26, 'en_UK'),
(27, 'nl', '', 'Ruben', 0, '2020-07-05 18:36:33', 27, 'en$'),
(28, 'nl', '', 'Ruben', 0, '2020-07-05 21:42:31', 28, 'l'),
(29, 'nl', '', 'Ruben', 0, '2020-07-19 20:52:24', 29, 'enb'),
(30, 'nl', '', 'Ruben', 0, '2020-09-13 18:45:49', 30, 'nl_NLµ'),
(31, 'nl', '', 'Ruben', 0, '2020-10-02 20:13:12', 31, 'vs'),
(32, 'nl', '', 'Ruben', 0, '2020-10-02 20:53:23', 32, 'us'),
(33, 'nl', '', 'Ruben', 0, '2020-10-02 20:54:25', 33, 'fr'),
(34, 'nl', '', 'Ruben', 0, '2020-10-05 21:21:39', 34, 'e');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Topics`
--

CREATE TABLE `Topics` (
  `id` int(11) NOT NULL,
  `topic` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `link` text NOT NULL,
  `MagEditeren` varchar(20) NOT NULL DEFAULT 'Nee',
  `Uitklapbaar` int(2) NOT NULL DEFAULT 0,
  `Actief` int(2) NOT NULL DEFAULT 1,
  `Episode_Order` decimal(19,4) NOT NULL DEFAULT 0.0000,
  `T_Owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Topics`
--

INSERT INTO `Topics` (`id`, `topic`, `parent_id`, `link`, `MagEditeren`, `Uitklapbaar`, `Actief`, `Episode_Order`, `T_Owner`) VALUES
(1, 'doctorwhofans.be', 0, 'Home', '0', 0, 1, '0.0000', 1),
(2, 'Wiki', 1, 'Wiki', '0', 1, 1, '0.0000', 1),
(3, 'Characters', 2, 'Characters', '0', 1, 1, '0.0000', 1),
(4, 'The Doctor', 3, 'The_Doctor', '0', 1, 1, '0.0000', 1),
(5, 'First Doctor', 4, 'First_Doctor', '0', 0, 1, '1000.0000', 1),
(6, 'Second Doctor', 4, 'Second_Doctor', '0', 0, 1, '2000.0000', 1),
(7, 'Third Doctor', 4, 'Third_Doctor', '0', 0, 1, '3000.0000', 1),
(8, 'Fourth Doctor', 4, 'Fourth_Doctor', '0', 0, 1, '4000.0000', 1),
(9, 'Fifth Doctor', 4, 'Fifth_Doctor', '0', 0, 1, '5000.0000', 1),
(10, 'Sixth Doctor', 4, 'Sixth_Doctor', '0', 0, 1, '6000.0000', 1),
(11, 'Seventh Doctor', 4, 'Seventh_Doctor', '0', 0, 1, '7000.0000', 1),
(12, 'Eighth Doctor', 4, 'Eighth_Doctor', '0', 0, 1, '8000.0000', 1),
(13, 'War Doctor', 4, 'War_Doctor', '0', 0, 1, '9000.0000', 1),
(14, 'Ninth Doctor', 4, 'Ninth_Doctor', '0', 0, 1, '10000.0000', 1),
(15, 'Tenth Doctor', 4, 'Tenth_Doctor', '0', 0, 1, '11000.0000', 1),
(16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, '12000.0000', 1),
(17, 'Twelfth Doctor', 4, 'Twelfth_Doctor', '0', 0, 1, '13000.0000', 1),
(18, 'Thirtheenth Doctor', 4, 'Thirteenth_Doctor', '0', 0, 1, '14000.0000', 1),
(19, 'Companions', 3, 'Category:Companions', '0', 0, 1, '0.0000', 1),
(20, 'Other Doctors', 4, 'Other_Doctors', 'Nee', 1, 1, '100000000.0000', 1),
(21, 'Peter Cushing Doctor', 20, 'Peter_Cushing_Doctor', '0', 0, 1, '0.0000', 1),
(22, 'Scream of the Shalka Doctor', 20, 'Scream_of_the_Shalka_Doctor', 'Ja', 0, 1, '0.0000', 1),
(23, 'The Watcher', 20, 'The_Watcher', '0', 0, 1, '0.0000', 1),
(24, 'Classic Who', 28, 'Classic_Who', '0', 1, 1, '1.0000', 1),
(25, 'New Who', 28, 'New_Who', '0', 1, 1, '1000.0000', 1),
(26, 'Susan Foreman', 143, 'Susan_Foreman', '0', 0, 1, '0.0000', 1),
(27, 'Barbara Wright', 1578, 'Barbara_Wright', '0', 0, 1, '0.0000', 1),
(28, 'Episodes', 2, 'Episodes', '0', 1, 1, '0.0000', 1),
(29, 'Site', 1, 'Site', '0', 1, 1, '0.0000', 1),
(30, 'Weeping Angels', 148, 'Weeping_Angels', '0', 0, 1, '0.0000', 1),
(31, 'Vicki', 1578, 'Vicki', '0', 0, 1, '0.0000', 1),
(32, 'Steven Taylor', 1578, 'Steven_Taylor', '0', 0, 1, '0.0000', 1),
(33, 'Katarina', 1578, 'Katarina', '0', 0, 1, '0.0000', 1),
(34, 'Sara Kingdom', 1578, 'Sara_Kingdom', '0', 0, 1, '0.0000', 1),
(35, 'Dorothea &laquo;Dodo&raquo; Chaplet', 1578, 'Dodo_Chaplet', '0', 0, 1, '0.0000', 1),
(36, 'Polly Wright', 1578, 'Polly_Wright', '0', 0, 1, '0.0000', 1),
(37, 'Ben Jackson', 1578, 'Ben_Jackson', '0', 0, 1, '0.0000', 1),
(38, 'James Robert &laquo;Jamie&raquo; McCrimmon', 1578, 'Jamie_McCrimmon', '0', 0, 1, '0.0000', 1),
(39, 'Victoria Waterfield', 1578, 'Victoria_Waterfield', '0', 0, 1, '0.0000', 1),
(40, 'Zoe Heriot', 1578, 'Zoe_Heriot', '0', 0, 1, '0.0000', 1),
(41, 'Alistair Gordon Lethbridge-Stewart', 1578, 'Alistair_Gordon_LethBridge_Stewart', '0', 0, 1, '0.0000', 1),
(42, 'Elizabeth &laquo;Liz&raquo; Shaw', 1578, 'Liz_Shaw', '0', 0, 1, '0.0000', 1),
(43, 'Jo Grant', 1578, 'Jo_Grant', '0', 0, 1, '0.0000', 1),
(44, 'Sarah Jane Smith', 1578, 'Sarah_Jane_Smith', '0', 0, 1, '0.0000', 1),
(45, 'John Benton', 1578, 'John_Benton', '0', 0, 1, '0.0000', 1),
(46, 'Mike Yates', 1578, 'Mike_Yates', '0', 0, 1, '0.0000', 1),
(47, 'Harry Sullivan', 1578, 'Harry_Sullivan', '0', 0, 1, '0.0000', 1),
(48, 'Leela', 1578, 'Leela', '0', 0, 1, '0.0000', 1),
(49, 'K9', 1581, 'K9', '0', 0, 1, '0.0000', 1),
(50, 'Romana(dvoratrelundar)', 143, 'Romana', '0', 0, 1, '0.0000', 1),
(51, 'Adric', 1579, 'Adric', '0', 0, 1, '0.0000', 1),
(52, 'Tegan Jovanka', 1578, 'Tegan_Jovanka', '0', 0, 1, '0.0000', 1),
(53, 'Nyssa', 1580, 'Nyssa', '0', 0, 1, '0.0000', 1),
(54, 'Vislor Turlough', 1582, 'Vislor_Turlough', '0', 0, 1, '0.0000', 1),
(55, 'Kamelion', 1583, 'Kamelion', '0', 0, 1, '0.0000', 1),
(56, 'Perpugilliam &laquo;Peri&raquo; Brown', 1578, 'Peri_Brown', '0', 0, 1, '0.0000', 1),
(57, 'Melanie &laquo;Mel&raquo; Bush', 1578, 'Mel_Bush', '0', 0, 1, '0.0000', 1),
(58, 'Ace', 1578, 'Ace', '0', 0, 1, '0.0000', 1),
(59, 'Grace Holloway', 1578, 'Grace_Holloway', '0', 0, 1, '0.0000', 1),
(60, 'Rose Tyler', 1578, 'Rose_Tyler', '0', 0, 1, '0.0000', 1),
(61, 'Mickey Smith', 1578, 'Mickey_Smith', '0', 0, 1, '0.0000', 1),
(62, 'Adam Mitchell', 1578, 'Adam_Mitchell', '0', 0, 1, '0.0000', 1),
(63, 'Captain Jack Harkness ', 1578, 'Jack_Harkness', '0', 0, 1, '0.0000', 1),
(64, 'Donna Noble', 1578, 'Donna_Noble', '0', 0, 1, '0.0000', 1),
(65, 'Martha Jones', 1578, 'Martha_Jones', '0', 0, 1, '0.0000', 1),
(66, 'Astrid Peth', 1601, 'Astrid_Peth', '0', 0, 1, '0.0000', 1),
(67, 'Jackson Lake', 1578, 'Jackson_Lake', '0', 0, 1, '0.0000', 1),
(68, 'Christina de Souza', 1578, 'Christina_de_Souza', '0', 0, 1, '0.0000', 1),
(69, 'Adelaide Brooke', 1578, 'Adelaide_Brooke', '0', 0, 1, '0.0000', 1),
(70, 'Wilfred &laquo;Wilf&raquo; Mott', 1578, 'Wilfred_Mott', '0', 0, 1, '0.0000', 1),
(71, 'Amelia &laquo;Amy&raquo; Pond', 1578, 'Amelia_Pond', '0', 0, 1, '0.0000', 1),
(72, 'Rory Williams', 1578, 'Rory_Williams', '0', 0, 1, '0.0000', 1),
(73, 'River Song/ Melody Pond', 1578, 'River_Song', '0', 0, 1, '0.0000', 1),
(74, 'Craig Owens', 1578, 'Craig_Owens', '0', 0, 1, '0.0000', 1),
(75, 'Canton Everett Delaware III', 1578, 'Canton_Everett_Delaware_III', '0', 0, 1, '0.0000', 1),
(76, 'Clara &laquo;Oswin&raquo; Oswald', 1578, 'Clara_Oswald', '0', 0, 1, '0.0000', 1),
(77, 'Danny Pink', 1578, 'Danny_Pink', '0', 0, 1, '0.0000', 1),
(78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, '0.0000', 1),
(79, 'Nardole', 1601, 'Nardole', '0', 0, 1, '0.0000', 1),
(80, 'Season 1 (1963-1964)', 24, 'Season_1_(Classic_Who)', '0', 1, 1, '1.0000', 1),
(81, 'Season 2 (1964-1965)', 24, 'Season_2_(Classic_Who)', '0', 1, 1, '2.0000', 1),
(82, 'Season 3 (1965-1966)', 24, 'Season_3_(Classic_Who)', '0', 1, 1, '3.0000', 1),
(83, 'Season 4 (1966-1967)', 24, 'Season_4_(Classic_Who)', '0', 1, 1, '4.0000', 1),
(84, 'The Master', 143, 'The_Master', '0', 0, 1, '0.0000', 1),
(85, 'Spin off', 28, 'Spin_off', '0', 1, 1, '2000.0000', 1),
(86, 'K-9 and Company', 85, 'K9_And_Company', '0', 0, 1, '0.0000', 1),
(87, 'Doctor Who Confidential', 85, 'Doctor_Who_Confidential', '0', 0, 1, '0.0000', 1),
(88, 'Torchwood', 85, 'Torchwood', '0', 1, 1, '0.0000', 1),
(89, 'Totally Doctor Who', 85, 'Totally_Doctor_Who', '0', 1, 1, '0.0000', 1),
(90, 'The Sarah Jane Adventures', 85, 'Sarah_Jane_Adventures', '0', 1, 1, '0.0000', 1),
(91, 'Dreamland', 85, 'Dreamland', '0', 0, 1, '0.0000', 1),
(92, 'K9 (Series)', 85, 'K9_Series', '0', 0, 1, '0.0000', 1),
(93, 'Class', 85, 'Class', '0', 0, 1, '0.0000', 1),
(94, 'The Infinite Quest', 89, 'The_Infinite_Quest', '0', 0, 1, '0.0000', 1),
(95, 'Charity', 85, 'Charity', '0', 0, 1, '0.0000', 1),
(96, 'Season 5 (1967-1968)', 24, 'Season_5_(Classic_Who)', '0', 1, 1, '5.0000', 1),
(97, 'Season 6 (1968-1969)', 24, 'Season_6_(Classic_Who)', '0', 1, 1, '6.0000', 1),
(98, 'Season 7 (1970)', 24, 'Season_7_(Classic_Who)', '0', 1, 1, '7.0000', 1),
(99, 'Season 8 (1971)', 24, 'Season_8_(Classic_Who)', '0', 1, 1, '8.0000', 1),
(100, 'Season 9 (1972)', 24, 'Season_9_(Classic_Who)', '0', 1, 1, '9.0000', 1),
(101, 'Season 10 (1972-1973)', 24, 'Season_10_(Classic_Who)', '0', 1, 1, '10.0000', 1),
(102, 'Season 11 (1973-1974)', 24, 'Season_11_(Classic_Who)', '0', 1, 1, '11.0000', 1),
(103, 'Season 12 (1974-1975)', 24, 'Season_12_(Classic_Who)', '0', 1, 1, '12.0000', 1),
(104, 'Season 13 (1975-1976)', 24, 'Season_13_(Classic_Who)', '0', 1, 1, '13.0000', 1),
(105, 'Season 14 (1976-1977)', 24, 'Season_14_(Classic_Who)', '0', 1, 1, '14.0000', 1),
(106, 'Season 15 (1977-1978)', 24, 'Season_15_(Classic_Who)', '0', 1, 1, '15.0000', 1),
(107, 'Season 16 (1978-1979)', 24, 'Season_16_(Classic_Who)', '0', 1, 1, '16.0000', 1),
(108, 'Season 17 (1979-1980)', 24, 'Season_17_(Classic_Who)', '0', 1, 1, '17.0000', 1),
(109, 'Season 18 (1980-1981)', 24, 'Season_18_(Classic_Who)', '0', 1, 1, '18.0000', 1),
(110, 'Season 19 (1982)', 24, 'Season_19_(Classic_Who)', '0', 1, 1, '19.0000', 1),
(111, 'Season 20 (1983)', 24, 'Season_20_(Classic_Who)', '0', 1, 1, '20.0000', 1),
(112, 'Season 21 (1984)', 24, 'Season_21_(Classic_Who)', '0', 1, 1, '21.0000', 1),
(113, 'Season 22 (1985)', 24, 'Season_22_(Classic_Who)', '0', 1, 1, '22.0000', 1),
(114, 'Season 23 (1986)', 24, 'Season_23_(Classic_Who)', '0', 1, 1, '23.0000', 1),
(115, 'Season 24 (1987)', 24, 'Season_24_(Classic_Who)', '0', 1, 1, '24.0000', 1),
(116, 'Season 25 (1988-1989)', 24, 'Season_25_(Classic_Who)', '0', 1, 1, '25.0000', 1),
(117, 'Season 26 (1989)', 24, 'Season_26_(Classic_Who)', '0', 1, 1, '26.0000', 1),
(118, 'The Movie (1996)', 24, 'Doctor_Who_The_Movie', '0', 0, 1, '27.0000', 1),
(119, 'Series 1 (2005)', 25, 'Series_1_(New_Who)', '0', 1, 1, '1.0000', 1),
(120, 'Series 2 (2006)', 25, 'Series_2_(New_Who)', '0', 1, 1, '2.0000', 1),
(121, 'Series 3 (2007)', 25, 'Series_3_(New_Who)', '0', 1, 1, '3.0000', 1),
(122, 'Series 4 (2008)', 25, 'Series_4_(New_Who)', '0', 1, 1, '4.0000', 1),
(123, 'Series 5 (2010)', 25, 'Series_5_(New_Who)', '0', 1, 1, '5.0000', 1),
(124, 'Series 6 (2011)', 25, 'Series_6_(New_Who)', '0', 1, 1, '6.0000', 1),
(125, 'Series 7 (2012-2013)', 25, 'Series_7_(New_Who)', '0', 1, 1, '7.0000', 1),
(126, 'Series 8 (2014)', 25, 'Series_8_(New_Who)', '0', 1, 1, '8.0000', 1),
(127, 'Series 9 (2015)', 25, 'Series_9_(New_Who)', '0', 1, 1, '9.0000', 1),
(128, 'Series 10 (2017)', 25, 'Series_10_(New_Who)', '0', 1, 1, '10.0000', 1),
(129, 'The Valeyard', 20, 'The_Valeyard', '0', 0, 1, '0.0000', 1),
(130, 'Doctor Who Magazine (Special Issues)', 173, 'Doctor_Who_Magazine_Special_Issues', '0', 1, 1, '0.0000', 1),
(131, 'Summer 1980', 130, 'DWMSI_Summer_1980', '0', 0, 1, '1.0000', 1),
(132, 'Concepts', 2, 'Concepts', '', 1, 1, '0.0000', 1),
(133, 'T.A.R.D.I.S', 1370, 'TARDIS', '0', 0, 1, '0.0000', 1),
(134, 'Sonic Screwdriver', 1370, 'Sonic_Screwdriver', '0', 0, 1, '0.0000', 1),
(135, 'Places', 2, 'Places', '', 1, 1, '0.0000', 1),
(136, 'Times', 2, 'Times', '', 1, 1, '0.0000', 1),
(137, 'Quotes', 2, 'Quotes', '', 0, 1, '0.0000', 1),
(138, 'Fans', 1, 'Fans', '0', 1, 1, '0.0000', 1),
(139, 'Cast', 2, 'Cast', '0', 1, 1, '0.0000', 1),
(140, 'Crew', 2, 'Crew', '0', 1, 1, '0.0000', 1),
(141, 'Main Cast', 139, 'Main_Cast', '0', 1, 1, '0.0000', 1),
(142, 'Contact', 29, 'Contact', '0', 0, 1, '0.0000', 1),
(143, 'Gallifreyan', 148, 'Gallifreyan', '0', 1, 1, '0.0000', 1),
(144, 'Daleks', 148, 'Daleks', '', 1, 1, '0.0000', 1),
(145, 'Cybermen', 148, 'Cybermen', '', 1, 1, '0.0000', 1),
(146, 'Sontarans', 148, 'Sontarans', '', 1, 1, '0.0000', 1),
(147, 'Helen A', 1578, 'Helen_A', '', 0, 1, '0.0000', 1),
(148, 'Species', 3, 'Species', '0', 1, 1, '0.0000', 1),
(149, 'Abzorbaloff', 148, 'Abzorbaloff', '0', 0, 1, '0.0000', 1),
(150, 'The Great Old Ones', 148, 'The_Great_Old_Ones', '0', 1, 1, '0.0000', 1),
(151, 'Rassilon', 143, 'Rassilon', '0', 0, 1, '0.0000', 1),
(152, 'Azal', 1592, 'Azal', '', 0, 1, '0.0000', 1),
(153, 'Music', 160, 'Music', '0', 0, 1, '0.0000', 1),
(154, 'Reviews', 2, 'Reviews', '0', 1, 1, '0.0000', 1),
(155, 'Media', 2, 'Media', '0', 1, 1, '0.0000', 1),
(156, 'DVD', 155, 'DVD', '', 0, 1, '0.0000', 1),
(157, 'Books', 155, 'Books', '', 1, 1, '0.0000', 1),
(158, 'Comics', 155, 'Comics', '', 0, 1, '0.0000', 1),
(159, 'Non Fiction', 157, 'Non_Fiction', '', 1, 1, '0.0000', 1),
(160, 'Audio', 155, 'Audio', '', 1, 1, '0.0000', 1),
(161, 'Merchandise', 2, 'Merchandise', '0', 1, 1, '0.0000', 1),
(162, 'Toys', 161, 'Toys', '0', 0, 1, '0.0000', 1),
(163, 'Pictures', 138, 'Pictures', '0', 1, 1, '0.0000', 1),
(164, 'Video', 138, 'Video', '0', 0, 1, '0.0000', 1),
(165, 'Transcripts', 138, 'Transcripts', '0', 0, 1, '0.0000', 1),
(166, 'Events', 138, 'Events', '0', 0, 1, '0.0000', 1),
(167, 'Fanclubs', 138, 'Fanclubs', '0', 0, 1, '0.0000', 1),
(168, 'Links', 138, 'Links', '0', 0, 1, '0.0000', 1),
(169, 'DIY', 138, 'DIY', '0', 1, 1, '0.0000', 1),
(170, 'Cosplay', 138, 'Cosplay', '0', 0, 1, '0.0000', 1),
(171, 'News', 29, 'News', '0', 0, 1, '0.0000', 1),
(172, 'In their Own Words 1982-86', 1343, 'DWMSE_18', '', 0, 1, '18.0000', 1),
(173, 'Magazines', 155, 'Magazines', '', 1, 1, '0.0000', 1),
(174, 'Omega', 143, 'Omega', '0', 0, 1, '0.0000', 1),
(175, 'Borusa', 143, 'Borusa', '0', 0, 1, '0.0000', 1),
(176, 'History', 2, 'History', '', 0, 1, '0.0000', 1),
(177, 'Ian Chesterton', 1578, 'Ian_Chesterton', '0', 0, 1, '0.0000', 1),
(178, 'Regeneration', 132, 'Regeneration', '0', 0, 1, '0.0000', 1),
(179, 'Synopsis', 2, 'Synopsis', '0', 0, 1, '0.0000', 1),
(180, 'U.N.I.T', 132, 'UNIT', '', 0, 1, '0.0000', 1),
(181, 'Writers', 140, 'Writers', '0', 1, 1, '0.0000', 1),
(182, 'Zoeken', 29, 'Zoeken', '0', 0, 1, '0.0000', 1),
(183, 'Sitemap', 29, 'Sitemap', '0', 0, 1, '0.0000', 1),
(184, ' Rose', 119, 'Rose_(TV_Story)', '', 0, 1, '1000.0000', 1),
(185, ' The End of the World', 119, 'The_End_of_the_World_(TV_Story)', '', 0, 1, '2000.0000', 1),
(186, 'Time Vortex', 132, 'Time_Vortex', '', 0, 1, '0.0000', 1),
(187, 'Time War', 132, 'Time_War', '', 0, 1, '0.0000', 1),
(188, 'Blinovitch Limitation Effect', 132, 'Blinovitch_Limitation_Effect', '', 0, 1, '0.0000', 1),
(189, 'Whoniverse', 132, 'Whoniverse', '', 0, 1, '0.0000', 1),
(190, 'Torchwood Institute', 132, 'Torchwood_Institute', '', 0, 1, '0.0000', 1),
(191, 'Davros', 144, 'Davros', '', 0, 1, '0.0000', 1),
(192, '(001-043) Doctor Who Weekly', 173, 'Doctor_Who_Weekly', '', 1, 1, '1.0000', 1),
(193, 'Issue 001', 192, 'Issue_1_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(194, 'Issue 002', 192, 'Issue_2_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(195, 'Issue 003', 192, 'Issue_3_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(196, 'Issue 004', 192, 'Issue_4_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(197, 'Issue 005', 192, 'Issue_5_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(198, 'Issue 006', 192, 'Issue_6_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(199, 'Issue 007', 192, 'Issue_7_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(200, 'Issue 008', 192, 'Issue_8_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(201, 'Issue 009', 192, 'Issue_9_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(202, 'Issue 010', 192, 'Issue_10_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(203, 'Issue 011', 192, 'Issue_11_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(204, 'Issue 012', 192, 'Issue_12_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(205, 'Issue 013', 192, 'Issue_13_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(206, 'Issue 014', 192, 'Issue_14_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(207, 'Issue 015', 192, 'Issue_15_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(208, 'Issue 016', 192, 'Issue_16_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(209, 'Issue 017', 192, 'Issue_17_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(210, 'Issue 018', 192, 'Issue_18_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(211, 'Issue 019', 192, 'Issue_19_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(212, 'Issue 020', 192, 'Issue_20_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(213, 'Issue 021', 192, 'Issue_21_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(214, 'Issue 022', 192, 'Issue_22_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(215, 'Issue 023', 192, 'Issue_23_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(216, 'Issue 024', 192, 'Issue_24_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(217, 'Issue 025', 192, 'Issue_25_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(218, 'Issue 026', 192, 'Issue_26_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(219, 'Issue 027', 192, 'Issue_27_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(220, 'Issue 028', 192, 'Issue_28_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(221, 'Issue 029', 192, 'Issue_29_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(222, 'Issue 030', 192, 'Issue_30_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(223, 'Issue 031', 192, 'Issue_31_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(224, 'Issue 032', 192, 'Issue_32_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(225, 'Issue 033', 192, 'Issue_33_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(226, 'Issue 034', 192, 'Issue_34_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(227, 'Issue 035', 192, 'Issue_35_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(228, 'Issue 036', 192, 'Issue_36_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(229, 'Issue 037', 192, 'Issue_37_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(230, 'Issue 038', 192, 'Issue_38_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(231, 'Issue 039', 192, 'Issue_39_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(232, 'Issue 040', 192, 'Issue_40_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(233, 'Issue 041', 192, 'Issue_41_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(234, 'Issue 042', 192, 'Issue_42_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(235, 'Issue 043', 192, 'Issue_43_(Doctor_Who_Weekly)', '', 0, 1, '0.0000', 1),
(236, '(044-060) Doctor Who - A Marvel Monthly', 173, 'Doctor_Who_A_Marvel_Monthly', '', 1, 1, '2.0000', 1),
(237, 'Cult of Skaro', 144, 'Cult_of_Skaro', '', 0, 1, '0.0000', 1),
(238, 'Strax', 146, 'Strax', '', 0, 1, '0.0000', 1),
(239, 'Issue 044', 236, 'Issue_44_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(240, 'Issue 045', 236, 'Issue_45_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(241, 'Issue 046', 236, 'Issue_46_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(242, 'Issue 047', 236, 'Issue_47_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(243, 'Issue 048', 236, 'Issue_48_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(244, 'Issue 049', 236, 'Issue_49_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(245, 'Issue 050', 236, 'Issue_50_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(246, 'Issue 051', 236, 'Issue_51_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(247, 'Issue 052', 236, 'Issue_52_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(248, 'Issue 053', 236, 'Issue_53_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(249, 'Issue 054', 236, 'Issue_54_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(250, 'Issue 055', 236, 'Issue_55_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(251, 'Issue 056', 236, 'Issue_56_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(252, 'Issue 057', 236, 'Issue_57_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(253, 'Issue 058', 236, 'Issue_58_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(254, 'Issue 059', 236, 'Issue_59_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(255, 'Issue 060', 236, 'Issue_60_(Doctor_Who_Marvel_Monthly)', '', 0, 1, '0.0000', 1),
(256, 'Silurians', 148, 'Silurians', '', 1, 1, '0.0000', 1),
(257, 'Unmade Serials', 28, 'Unmade_Serials', '0', 0, 1, '3000.0000', 1),
(258, 'Christmas special: the Return of Doctor Mysterio', 154, 'Return_Of_Doctor_Mysterio_Review', '', 0, 1, '0.0000', 1),
(259, '(061-084) Doctor Who - Monthly', 173, 'Doctor_Who_Monthly', '', 1, 1, '3.0000', 1),
(260, 'Issue 061', 259, 'Issue_61_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(261, 'Issue 062', 259, 'Issue_62_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(262, 'Issue 063', 259, 'Issue_63_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(263, 'Issue 064', 259, 'Issue_64_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(264, 'Issue 065', 259, 'Issue_65_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(265, 'Issue 066', 259, 'Issue_66_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(266, 'Issue 067', 259, 'Issue_67_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(267, 'Issue 068', 259, 'Issue_68_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(268, 'Issue 069', 259, 'Issue_69_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(269, 'Issue 070', 259, 'Issue_70_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(270, 'Issue 071', 259, 'Issue_71_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(271, 'Issue 072', 259, 'Issue_72_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(272, 'Issue 073', 259, 'Issue_73_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(273, 'Issue 074', 259, 'Issue_74_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(274, 'Issue 075', 259, 'Issue_75_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(275, 'Issue 076', 259, 'Issue_76_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(276, 'Issue 077', 259, 'Issue_77_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(277, 'Issue 078', 259, 'Issue_78_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(278, 'Issue 079', 259, 'Issue_79_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(279, 'Issue 080', 259, 'Issue_80_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(280, 'Issue 081', 259, 'Issue_81_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(281, 'Issue 082', 259, 'Issue_82_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(282, 'Issue 083', 259, 'Issue_83_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(283, 'Issue 084', 259, 'Issue_84_(Doctor_Who_Monthly)', '', 0, 1, '0.0000', 1),
(284, '(085-098) The Official Doctor Who Magazine', 173, 'The_Official_Doctor_Who_Magazine', '', 1, 1, '4.0000', 1),
(285, 'Issue 085', 284, 'Issue_85_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(286, 'Issue 086', 284, 'Issue_86_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(287, 'Issue 087', 284, 'Issue_87_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(288, 'Issue 088', 284, 'Issue_88_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(289, 'Issue 089', 284, 'Issue_89_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(290, 'Issue 090', 284, 'Issue_90_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(291, 'Issue 091', 284, 'Issue_91_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(292, 'Issue 092', 284, 'Issue_92_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(293, 'Issue 093', 284, 'Issue_93_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(294, 'Issue 094', 284, 'Issue_94_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(295, 'Issue 095', 284, 'Issue_95_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(296, 'Issue 096', 284, 'Issue_96_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(297, 'Issue 097', 284, 'Issue_97_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(298, 'Issue 098', 284, 'Issue_98_(The_Official_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(299, '(099-106) The Doctor Who Magazine', 173, 'The_Doctor_Who_Magazine', '', 1, 1, '5.0000', 1),
(300, 'Issue 099', 299, 'Issue_99_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(301, 'Issue 100', 299, 'Issue_100_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(302, 'Issue 101', 299, 'Issue_101_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(303, 'Issue 102', 299, 'Issue_102_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(304, 'Issue 103', 299, 'Issue_103_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(305, 'Issue 104', 299, 'Issue_104_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(306, 'Issue 105', 299, 'Issue_105_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(307, 'Issue 106', 299, 'Issue_106_(The_Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(308, '(107-...) Doctor Who Magazine', 173, 'Doctor_Who_Magazine', '', 1, 1, '6.0000', 1),
(309, 'Gallifrey', 135, 'Gallifrey', '', 0, 1, '0.0000', 1),
(310, 'Issue 107 ', 308, 'Issue_107_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(311, 'Issue 108 ', 308, 'Issue_108_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(312, 'Issue 109 ', 308, 'Issue_109_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(313, 'Issue 110 ', 308, 'Issue_110_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(314, 'Issue 111 ', 308, 'Issue_111_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(315, 'Issue 112 ', 308, 'Issue_112_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(316, 'Issue 113 ', 308, 'Issue_113_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(317, 'Issue 114 ', 308, 'Issue_114_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(318, 'Issue 115 ', 308, 'Issue_115_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(319, 'Issue 116 ', 308, 'Issue_116_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(320, 'Issue 117 ', 308, 'Issue_117_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(321, 'Issue 118 ', 308, 'Issue_118_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(322, 'Issue 119 ', 308, 'Issue_119_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(323, 'Issue 120 ', 308, 'Issue_120_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(324, 'Issue 121 ', 308, 'Issue_121_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(325, 'Issue 122 ', 308, 'Issue_122_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(326, 'Issue 123 ', 308, 'Issue_123_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(327, 'Issue 124 ', 308, 'Issue_124_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(328, 'Issue 125 ', 308, 'Issue_125_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(329, 'Issue 126 ', 308, 'Issue_126_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(330, 'Issue 127 ', 308, 'Issue_127_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(331, 'Issue 128 ', 308, 'Issue_128_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(332, 'Issue 129 ', 308, 'Issue_129_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(333, 'Issue 130 ', 308, 'Issue_130_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(334, 'Issue 131 ', 308, 'Issue_131_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(335, 'Issue 132 ', 308, 'Issue_132_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(336, 'Issue 133 ', 308, 'Issue_133_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(337, 'Issue 134 ', 308, 'Issue_134_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(338, 'Issue 135 ', 308, 'Issue_135_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(339, 'Issue 136 ', 308, 'Issue_136_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(340, 'Issue 137 ', 308, 'Issue_137_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(341, 'Issue 138 ', 308, 'Issue_138_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(342, 'Issue 139 ', 308, 'Issue_139_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(343, 'Issue 140 ', 308, 'Issue_140_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(344, 'Issue 141 ', 308, 'Issue_141_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(345, 'Issue 142 ', 308, 'Issue_142_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(346, 'Issue 143 ', 308, 'Issue_143_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(347, 'Issue 144 ', 308, 'Issue_144_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(348, 'Issue 145 ', 308, 'Issue_145_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(349, 'Issue 146 ', 308, 'Issue_146_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(350, 'Issue 147 ', 308, 'Issue_147_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(351, 'Issue 148 ', 308, 'Issue_148_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(352, 'Issue 149 ', 308, 'Issue_149_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(353, 'Issue 150 ', 308, 'Issue_150_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(354, 'Issue 151 ', 308, 'Issue_151_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(355, 'Issue 152 ', 308, 'Issue_152_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(356, 'Issue 153 ', 308, 'Issue_153_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(357, 'Issue 154 ', 308, 'Issue_154_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(358, 'Issue 155 ', 308, 'Issue_155_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(359, 'Issue 156 ', 308, 'Issue_156_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(360, 'Issue 157 ', 308, 'Issue_157_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(361, 'Issue 158 ', 308, 'Issue_158_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(362, 'Issue 159 ', 308, 'Issue_159_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(363, 'Issue 160 ', 308, 'Issue_160_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(364, 'Issue 161 ', 308, 'Issue_161_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(365, 'Issue 162 ', 308, 'Issue_162_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(366, 'Issue 163 ', 308, 'Issue_163_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(367, 'Issue 164 ', 308, 'Issue_164_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(368, 'Issue 165 ', 308, 'Issue_165_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(369, 'Issue 166 ', 308, 'Issue_166_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(370, 'Issue 167 ', 308, 'Issue_167_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(371, 'Issue 168 ', 308, 'Issue_168_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(372, 'Issue 169 ', 308, 'Issue_169_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(373, 'Issue 170 ', 308, 'Issue_170_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(374, 'Issue 171 ', 308, 'Issue_171_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(375, 'Issue 172 ', 308, 'Issue_172_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(376, 'Issue 173 ', 308, 'Issue_173_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(377, 'Issue 174 ', 308, 'Issue_174_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(378, 'Issue 175 ', 308, 'Issue_175_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(379, 'Issue 176 ', 308, 'Issue_176_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(380, 'Issue 177 ', 308, 'Issue_177_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(381, 'Issue 178 ', 308, 'Issue_178_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(382, 'Issue 179 ', 308, 'Issue_179_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(383, 'Issue 180 ', 308, 'Issue_180_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(384, 'Issue 181 ', 308, 'Issue_181_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(385, 'Issue 182 ', 308, 'Issue_182_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(386, 'Issue 183 ', 308, 'Issue_183_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(387, 'Issue 184 ', 308, 'Issue_184_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(388, 'Issue 185 ', 308, 'Issue_185_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(389, 'Issue 186 ', 308, 'Issue_186_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(390, 'Issue 187 ', 308, 'Issue_187_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(391, 'Issue 188 ', 308, 'Issue_188_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(392, 'Issue 189 ', 308, 'Issue_189_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(393, 'Issue 190 ', 308, 'Issue_190_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(394, 'Issue 191 ', 308, 'Issue_191_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(395, 'Issue 192 ', 308, 'Issue_192_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(396, 'Issue 193 ', 308, 'Issue_193_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(397, 'Issue 194 ', 308, 'Issue_194_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(398, 'Issue 195 ', 308, 'Issue_195_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(399, 'Issue 196 ', 308, 'Issue_196_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(400, 'Issue 197 ', 308, 'Issue_197_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(401, 'Issue 198 ', 308, 'Issue_198_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(402, 'Issue 199 ', 308, 'Issue_199_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(403, 'Issue 200 ', 308, 'Issue_200_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(404, 'Issue 201 ', 308, 'Issue_201_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(405, 'Issue 202 ', 308, 'Issue_202_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(406, 'Issue 203 ', 308, 'Issue_203_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(407, 'Issue 204 ', 308, 'Issue_204_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(408, 'Issue 205 ', 308, 'Issue_205_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(409, 'Issue 206 ', 308, 'Issue_206_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(410, 'Issue 207 ', 308, 'Issue_207_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(411, 'Issue 208 ', 308, 'Issue_208_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(412, 'Issue 209 ', 308, 'Issue_209_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(413, 'Issue 210 ', 308, 'Issue_210_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(414, 'Issue 211 ', 308, 'Issue_211_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(415, 'Issue 212 ', 308, 'Issue_212_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(416, 'Issue 213 ', 308, 'Issue_213_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(417, 'Issue 214 ', 308, 'Issue_214_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(418, 'Issue 215 ', 308, 'Issue_215_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(419, 'Issue 216 ', 308, 'Issue_216_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(420, 'Issue 217 ', 308, 'Issue_217_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(421, 'Issue 218 ', 308, 'Issue_218_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(422, 'Issue 219 ', 308, 'Issue_219_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(423, 'Issue 220 ', 308, 'Issue_220_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(424, 'Issue 221 ', 308, 'Issue_221_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(425, 'Issue 222 ', 308, 'Issue_222_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(426, 'Issue 223 ', 308, 'Issue_223_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(427, 'Issue 224 ', 308, 'Issue_224_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(428, 'Issue 225 ', 308, 'Issue_225_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(429, 'Issue 226 ', 308, 'Issue_226_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(430, 'Issue 227 ', 308, 'Issue_227_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(431, 'Issue 228 ', 308, 'Issue_228_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(432, 'Issue 229 ', 308, 'Issue_229_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(433, 'Issue 230 ', 308, 'Issue_230_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(434, 'Issue 231 ', 308, 'Issue_231_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(435, 'Issue 232 ', 308, 'Issue_232_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(436, 'Issue 233 ', 308, 'Issue_233_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(437, 'Issue 234 ', 308, 'Issue_234_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(438, 'Issue 235 ', 308, 'Issue_235_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(439, 'Issue 236 ', 308, 'Issue_236_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(440, 'Issue 237 ', 308, 'Issue_237_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(441, 'Issue 238 ', 308, 'Issue_238_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(442, 'Issue 239 ', 308, 'Issue_239_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(443, 'Issue 240 ', 308, 'Issue_240_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(444, 'Issue 241 ', 308, 'Issue_241_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(445, 'Issue 242 ', 308, 'Issue_242_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(446, 'Issue 243 ', 308, 'Issue_243_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(447, 'Issue 244 ', 308, 'Issue_244_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(448, 'Issue 245 ', 308, 'Issue_245_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(449, 'Issue 246 ', 308, 'Issue_246_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(450, 'Issue 247 ', 308, 'Issue_247_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(451, 'Issue 248 ', 308, 'Issue_248_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(452, 'Issue 249 ', 308, 'Issue_249_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(453, 'Issue 250 ', 308, 'Issue_250_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(454, 'Issue 251 ', 308, 'Issue_251_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(455, 'Issue 252 ', 308, 'Issue_252_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(456, 'Issue 253 ', 308, 'Issue_253_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(457, 'Issue 254 ', 308, 'Issue_254_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(458, 'Issue 255 ', 308, 'Issue_255_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(459, 'Issue 256 ', 308, 'Issue_256_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(460, 'Issue 257 ', 308, 'Issue_257_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(461, 'Issue 258 ', 308, 'Issue_258_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(462, 'Issue 259 ', 308, 'Issue_259_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(463, 'Issue 260 ', 308, 'Issue_260_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(464, 'Issue 261 ', 308, 'Issue_261_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(465, 'Issue 262 ', 308, 'Issue_262_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(466, 'Issue 263 ', 308, 'Issue_263_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(467, 'Issue 264 ', 308, 'Issue_264_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(468, 'Issue 265 ', 308, 'Issue_265_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(469, 'Issue 266 ', 308, 'Issue_266_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(470, 'Issue 267 ', 308, 'Issue_267_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(471, 'Issue 268 ', 308, 'Issue_268_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(472, 'Issue 269 ', 308, 'Issue_269_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(473, 'Issue 270 ', 308, 'Issue_270_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(474, 'Issue 271 ', 308, 'Issue_271_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(475, 'Issue 272 ', 308, 'Issue_272_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(476, 'Issue 273 ', 308, 'Issue_273_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(477, 'Issue 274 ', 308, 'Issue_274_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(478, 'Issue 275 ', 308, 'Issue_275_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(479, 'Issue 276 ', 308, 'Issue_276_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(480, 'Issue 277 ', 308, 'Issue_277_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(481, 'Issue 278 ', 308, 'Issue_278_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(482, 'Issue 279 ', 308, 'Issue_279_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(483, 'Issue 280 ', 308, 'Issue_280_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(484, 'Issue 281 ', 308, 'Issue_281_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(485, 'Issue 282 ', 308, 'Issue_282_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(486, 'Issue 283 ', 308, 'Issue_283_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(487, 'Issue 284 ', 308, 'Issue_284_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(488, 'Issue 285 ', 308, 'Issue_285_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(489, 'Issue 286 ', 308, 'Issue_286_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(490, 'Issue 287 ', 308, 'Issue_287_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(491, 'Issue 288 ', 308, 'Issue_288_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(492, 'Issue 289 ', 308, 'Issue_289_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(493, 'Issue 290 ', 308, 'Issue_290_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(494, 'Issue 291 ', 308, 'Issue_291_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(495, 'Issue 292 ', 308, 'Issue_292_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(496, 'Issue 293 ', 308, 'Issue_293_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(497, 'Issue 294 ', 308, 'Issue_294_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(498, 'Issue 295 ', 308, 'Issue_295_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(499, 'Issue 296 ', 308, 'Issue_296_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(500, 'Issue 297 ', 308, 'Issue_297_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(501, 'Issue 298 ', 308, 'Issue_298_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(502, 'Issue 299 ', 308, 'Issue_299_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(503, 'Issue 300 ', 308, 'Issue_300_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(504, 'Issue 301 ', 308, 'Issue_301_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(505, 'Issue 302 ', 308, 'Issue_302_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(506, 'Issue 303 ', 308, 'Issue_303_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(507, 'Issue 304 ', 308, 'Issue_304_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(508, 'Issue 305 ', 308, 'Issue_305_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(509, 'Issue 306 ', 308, 'Issue_306_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(510, 'Issue 307 ', 308, 'Issue_307_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(511, 'Issue 308 ', 308, 'Issue_308_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(512, 'Issue 309 ', 308, 'Issue_309_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(513, 'Issue 310 ', 308, 'Issue_310_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(514, 'Issue 311 ', 308, 'Issue_311_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(515, 'Issue 312 ', 308, 'Issue_312_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(516, 'Issue 313 ', 308, 'Issue_313_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(517, 'Issue 314 ', 308, 'Issue_314_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(518, 'Issue 315 ', 308, 'Issue_315_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(519, 'Issue 316 ', 308, 'Issue_316_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(520, 'Issue 317 ', 308, 'Issue_317_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(521, 'Issue 318 ', 308, 'Issue_318_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(522, 'Issue 319 ', 308, 'Issue_319_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(523, 'Issue 320 ', 308, 'Issue_320_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(524, 'Issue 321 ', 308, 'Issue_321_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(525, 'Issue 322 ', 308, 'Issue_322_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(526, 'Issue 323 ', 308, 'Issue_323_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(527, 'Issue 324 ', 308, 'Issue_324_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(528, 'Issue 325 ', 308, 'Issue_325_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(529, 'Issue 326 ', 308, 'Issue_326_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(530, 'Issue 327 ', 308, 'Issue_327_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(531, 'Issue 328 ', 308, 'Issue_328_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(532, 'Issue 329 ', 308, 'Issue_329_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(533, 'Issue 330 ', 308, 'Issue_330_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(534, 'Issue 331 ', 308, 'Issue_331_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(535, 'Issue 332 ', 308, 'Issue_332_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(536, 'Issue 333 ', 308, 'Issue_333_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(537, 'Issue 334 ', 308, 'Issue_334_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(538, 'Issue 335 ', 308, 'Issue_335_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(539, 'Issue 336 ', 308, 'Issue_336_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(540, 'Issue 337 ', 308, 'Issue_337_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(541, 'Issue 338 ', 308, 'Issue_338_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(542, 'Issue 339 ', 308, 'Issue_339_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(543, 'Issue 340 ', 308, 'Issue_340_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(544, 'Issue 341 ', 308, 'Issue_341_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(545, 'Issue 342 ', 308, 'Issue_342_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(546, 'Issue 343 ', 308, 'Issue_343_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(547, 'Issue 344 ', 308, 'Issue_344_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(548, 'Issue 345 ', 308, 'Issue_345_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(549, 'Issue 346 ', 308, 'Issue_346_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(550, 'Issue 347 ', 308, 'Issue_347_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(551, 'Issue 348 ', 308, 'Issue_348_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(552, 'Issue 349 ', 308, 'Issue_349_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(553, 'Issue 350 ', 308, 'Issue_350_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(554, 'Issue 351 ', 308, 'Issue_351_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(555, 'Issue 352 ', 308, 'Issue_352_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(556, 'Issue 353 ', 308, 'Issue_353_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(557, 'Issue 354 ', 308, 'Issue_354_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(558, 'Issue 355 ', 308, 'Issue_355_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(559, 'Issue 356 ', 308, 'Issue_356_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(560, 'Issue 357 ', 308, 'Issue_357_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(561, 'Issue 358 ', 308, 'Issue_358_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(562, 'Issue 359 ', 308, 'Issue_359_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(563, 'Issue 360 ', 308, 'Issue_360_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(564, 'Issue 361 ', 308, 'Issue_361_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(565, 'Issue 362 ', 308, 'Issue_362_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(566, 'Issue 363 ', 308, 'Issue_363_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(567, 'Issue 364 ', 308, 'Issue_364_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(568, 'Issue 365 ', 308, 'Issue_365_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(569, 'Issue 366 ', 308, 'Issue_366_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(570, 'Issue 367 ', 308, 'Issue_367_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(571, 'Issue 368 ', 308, 'Issue_368_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(572, 'Issue 369 ', 308, 'Issue_369_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(573, 'Issue 370 ', 308, 'Issue_370_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(574, 'Issue 371 ', 308, 'Issue_371_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(575, 'Issue 372 ', 308, 'Issue_372_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(576, 'Issue 373 ', 308, 'Issue_373_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(577, 'Issue 374 ', 308, 'Issue_374_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(578, 'Issue 375 ', 308, 'Issue_375_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(579, 'Issue 376 ', 308, 'Issue_376_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(580, 'Issue 377 ', 308, 'Issue_377_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(581, 'Issue 378 ', 308, 'Issue_378_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(582, 'Issue 379 ', 308, 'Issue_379_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(583, 'Issue 380 ', 308, 'Issue_380_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(584, 'Issue 381 ', 308, 'Issue_381_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(585, 'Issue 382 ', 308, 'Issue_382_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(586, 'Issue 383 ', 308, 'Issue_383_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(587, 'Issue 384 ', 308, 'Issue_384_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(588, 'Issue 385 ', 308, 'Issue_385_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(589, 'Issue 386 ', 308, 'Issue_386_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(590, 'Issue 387 ', 308, 'Issue_387_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(591, 'Issue 388 ', 308, 'Issue_388_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(592, 'Issue 389 ', 308, 'Issue_389_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(593, 'Issue 390 ', 308, 'Issue_390_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(594, 'Issue 391 ', 308, 'Issue_391_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(595, 'Issue 392 ', 308, 'Issue_392_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(596, 'Issue 393 ', 308, 'Issue_393_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(597, 'Issue 394 ', 308, 'Issue_394_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(598, 'Issue 395 ', 308, 'Issue_395_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(599, 'Issue 396 ', 308, 'Issue_396_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(600, 'Issue 397 ', 308, 'Issue_397_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(601, 'Issue 398 ', 308, 'Issue_398_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(602, 'Issue 399 ', 308, 'Issue_399_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(603, 'Issue 400 ', 308, 'Issue_400_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(604, 'Issue 401 ', 308, 'Issue_401_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(605, 'Issue 402 ', 308, 'Issue_402_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(606, 'Issue 403 ', 308, 'Issue_403_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(607, 'Issue 404 ', 308, 'Issue_404_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(608, 'Issue 405 ', 308, 'Issue_405_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(609, 'Issue 406 ', 308, 'Issue_406_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(610, 'Issue 407 ', 308, 'Issue_407_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(611, 'Issue 408 ', 308, 'Issue_408_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(612, 'Issue 409 ', 308, 'Issue_409_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(613, 'Issue 410 ', 308, 'Issue_410_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(614, 'Issue 411 ', 308, 'Issue_411_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(615, 'Issue 412 ', 308, 'Issue_412_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(616, 'Issue 413 ', 308, 'Issue_413_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(617, 'Issue 414 ', 308, 'Issue_414_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(618, 'Issue 415 ', 308, 'Issue_415_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(619, 'Issue 416 ', 308, 'Issue_416_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(620, 'Issue 417 ', 308, 'Issue_417_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(621, 'Issue 418 ', 308, 'Issue_418_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(622, 'Issue 419 ', 308, 'Issue_419_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(623, 'Issue 420 ', 308, 'Issue_420_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(624, 'Issue 421 ', 308, 'Issue_421_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(625, 'Issue 422 ', 308, 'Issue_422_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(626, 'Issue 423 ', 308, 'Issue_423_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(627, 'Issue 424 ', 308, 'Issue_424_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(628, 'Issue 425 ', 308, 'Issue_425_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(629, 'Issue 426 ', 308, 'Issue_426_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(630, 'Issue 427 ', 308, 'Issue_427_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(631, 'Issue 428 ', 308, 'Issue_428_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(632, 'Issue 429 ', 308, 'Issue_429_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(633, 'Issue 430 ', 308, 'Issue_430_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(634, 'Issue 431 ', 308, 'Issue_431_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(635, 'Issue 432 ', 308, 'Issue_432_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(636, 'Issue 433 ', 308, 'Issue_433_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(637, 'Issue 434 ', 308, 'Issue_434_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(638, 'Issue 435 ', 308, 'Issue_435_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(639, 'Issue 436 ', 308, 'Issue_436_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(640, 'Issue 437 ', 308, 'Issue_437_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(641, 'Issue 438 ', 308, 'Issue_438_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1);
INSERT INTO `Topics` (`id`, `topic`, `parent_id`, `link`, `MagEditeren`, `Uitklapbaar`, `Actief`, `Episode_Order`, `T_Owner`) VALUES
(642, 'Issue 439 ', 308, 'Issue_439_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(643, 'Issue 440 ', 308, 'Issue_440_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(644, 'Issue 441 ', 308, 'Issue_441_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(645, 'Issue 442 ', 308, 'Issue_442_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(646, 'Issue 443 ', 308, 'Issue_443_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(647, 'Issue 444 ', 308, 'Issue_444_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(648, 'Issue 445 ', 308, 'Issue_445_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(649, 'Issue 446 ', 308, 'Issue_446_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(650, 'Issue 447 ', 308, 'Issue_447_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(651, 'Issue 448 ', 308, 'Issue_448_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(652, 'Issue 449 ', 308, 'Issue_449_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(653, 'Issue 450 ', 308, 'Issue_450_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(654, 'Issue 451 ', 308, 'Issue_451_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(655, 'Issue 452 ', 308, 'Issue_452_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(656, 'Issue 453 ', 308, 'Issue_453_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(657, 'Issue 454 ', 308, 'Issue_454_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(658, 'Issue 455 ', 308, 'Issue_455_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(659, 'Issue 456 ', 308, 'Issue_456_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(660, 'Issue 457 ', 308, 'Issue_457_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(661, 'Issue 458 ', 308, 'Issue_458_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(662, 'Issue 459 ', 308, 'Issue_459_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(663, 'Issue 460 ', 308, 'Issue_460_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(664, 'Issue 461 ', 308, 'Issue_461_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(665, 'Issue 462 ', 308, 'Issue_462_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(666, 'Issue 463 ', 308, 'Issue_463_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(667, 'Issue 464 ', 308, 'Issue_464_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(668, 'Issue 465 ', 308, 'Issue_465_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(669, 'Issue 466 ', 308, 'Issue_466_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(670, 'Issue 467 ', 308, 'Issue_467_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(671, 'Issue 468 ', 308, 'Issue_468_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(672, 'Issue 469 ', 308, 'Issue_469_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(673, 'Issue 470 ', 308, 'Issue_470_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(674, 'Issue 471 ', 308, 'Issue_471_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(675, 'Issue 472 ', 308, 'Issue_472_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(676, 'Issue 473 ', 308, 'Issue_473_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(677, 'Issue 474 ', 308, 'Issue_474_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(678, 'Issue 475 ', 308, 'Issue_475_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(679, 'Issue 476 ', 308, 'Issue_476_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(680, 'Issue 477 ', 308, 'Issue_477_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(681, 'Issue 478 ', 308, 'Issue_478_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(682, 'Issue 479 ', 308, 'Issue_479_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(683, 'Issue 480 ', 308, 'Issue_480_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(684, 'Issue 481 ', 308, 'Issue_481_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(685, 'Issue 482 ', 308, 'Issue_482_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(686, 'Issue 483 ', 308, 'Issue_483_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(687, 'Issue 484 ', 308, 'Issue_484_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(688, 'Issue 485 ', 308, 'Issue_485_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(689, 'Issue 486 ', 308, 'Issue_486_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(690, 'Issue 487 ', 308, 'Issue_487_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(691, 'Issue 488 ', 308, 'Issue_488_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(692, 'Issue 489 ', 308, 'Issue_489_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(693, 'Issue 490 ', 308, 'Issue_490_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(694, 'Issue 491 ', 308, 'Issue_491_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(695, 'Issue 492 ', 308, 'Issue_492_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(696, 'Issue 493 ', 308, 'Issue_493_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(697, 'Issue 494 ', 308, 'Issue_494_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(698, 'Issue 495 ', 308, 'Issue_495_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(699, 'Issue 496 ', 308, 'Issue_496_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(700, 'Issue 497 ', 308, 'Issue_497_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(701, 'Issue 498 ', 308, 'Issue_498_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(702, 'Issue 499 ', 308, 'Issue_499_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(703, 'Issue 500 ', 308, 'Issue_500_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(704, 'Issue 501 ', 308, 'Issue_501_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(705, 'Issue 502 ', 308, 'Issue_502_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(706, 'Issue 503 ', 308, 'Issue_503_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(707, 'Issue 504 ', 308, 'Issue_504_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(708, 'Issue 505 ', 308, 'Issue_505_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(709, 'Issue 506 ', 308, 'Issue_506_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(710, 'Issue 507 ', 308, 'Issue_507_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(711, 'Issue 508 ', 308, 'Issue_508_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(712, 'Issue 509 ', 308, 'Issue_509_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(713, 'Issue 510 ', 308, 'Issue_510_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(714, 'Issue 511 ', 308, 'Issue_511_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(715, 'Issue 512 ', 308, 'Issue_512_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(716, 'Issue 513 ', 308, 'Issue_513_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(717, 'Issue 514 ', 308, 'Issue_514_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(718, 'Issue 515 ', 308, 'Issue_515_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(719, 'Issue 516 ', 308, 'Issue_516_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(720, 'Issue 517 ', 308, 'Issue_517_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(721, 'Issue 518 ', 308, 'Issue_518_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(722, 'Issue 519 ', 308, 'Issue_519_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(723, 'Issue 520 ', 308, 'Issue_520_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(724, 'Issue 521 ', 308, 'Issue_521_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(725, 'William Hartnell ', 141, 'William_Hartnell', '', 0, 1, '0.0000', 1),
(726, 'Patrick Troughton ', 141, 'Patrick_Troughton', '', 0, 1, '0.0000', 1),
(727, 'Jon Pertwee ', 141, 'Jon_Pertwee', '', 0, 1, '0.0000', 1),
(728, 'Tom Baker ', 141, 'Tom_Baker', '', 0, 1, '0.0000', 1),
(729, 'Peter Davison ', 141, 'Peter_Davison', '', 0, 1, '0.0000', 1),
(730, 'Colin Baker ', 141, 'Colin_Baker', '', 0, 1, '0.0000', 1),
(731, 'Sylvester McCoy ', 141, 'Sylvester_McCoy', '', 0, 1, '0.0000', 1),
(732, 'Paul McGann ', 141, 'Paul_McGann', '', 0, 1, '0.0000', 1),
(733, 'John Hurt ', 141, 'John_Hurt', '', 0, 1, '0.0000', 1),
(734, 'Christopher Eccleston ', 141, 'Christopher_Eccleston', '', 0, 1, '0.0000', 1),
(735, 'David Tennant ', 141, 'David_Tennant', '', 0, 1, '0.0000', 1),
(736, 'Matt Smith ', 141, 'Matt_Smith', '', 0, 1, '0.0000', 1),
(737, 'Peter Capaldi ', 141, 'Peter_Capaldi', '', 0, 1, '0.0000', 1),
(738, 'Peter Cushing ', 141, 'Peter_Cushing', '', 0, 1, '0.0000', 1),
(739, 'Jodie Whittaker ', 141, 'Jodie_Whittaker', '', 0, 1, '0.0000', 1),
(740, 'Carole Ann Ford ', 141, 'Carole_Ann_Ford', '', 0, 1, '0.0000', 1),
(741, 'Jacqueline Hill ', 141, 'Jacqueline_Hill', '', 0, 1, '0.0000', 1),
(742, 'William Russell ', 141, 'William_Russell', '', 0, 1, '0.0000', 1),
(743, 'Maureen O&#39; Brien', 141, 'Maureen_O_Brien', '', 0, 1, '0.0000', 1),
(744, 'Peter Purves ', 141, 'Peter_Purves', '', 0, 1, '0.0000', 1),
(745, 'Adrienne Hill ', 141, 'Adrienne_Hill', '', 0, 1, '0.0000', 1),
(746, 'Jean Marsh ', 141, 'Jean_Marsh', '', 0, 1, '0.0000', 1),
(747, 'Jackie Lane ', 141, 'Jackie_Lane', '', 0, 1, '0.0000', 1),
(748, 'Anneke Wills ', 141, 'Anneke_Wills', '', 0, 1, '0.0000', 1),
(749, 'Michael Craze ', 141, 'Michael_Craze', '', 0, 1, '0.0000', 1),
(750, 'Frazer Hines ', 141, 'Frazer_Hines', '', 0, 1, '0.0000', 1),
(751, 'Deborah Watling ', 141, 'Deborah_Watling', '', 0, 1, '0.0000', 1),
(752, 'Wendy Padbury ', 141, 'Wendy_Padbury', '', 0, 1, '0.0000', 1),
(753, 'Caroline John ', 141, 'Caroline_John', '', 0, 1, '0.0000', 1),
(754, 'Katy Manning ', 141, 'Katy_Manning', '', 0, 1, '0.0000', 1),
(755, 'Elisabeth Sladen ', 141, 'Elisabeth_Sladen', '', 0, 1, '0.0000', 1),
(756, 'Ian Marter ', 141, 'Ian_Marter', '', 0, 1, '0.0000', 1),
(757, 'Louise Jameson ', 141, 'Louise_Jameson', '', 0, 1, '0.0000', 1),
(758, 'John Leeson ', 141, 'John_Leeson', '', 0, 1, '0.0000', 1),
(759, 'Mary Tamm ', 141, 'Mary_Tamm', '', 0, 1, '0.0000', 1),
(760, 'Lalla Ward ', 141, 'Lalla_Ward', '', 0, 1, '0.0000', 1),
(761, 'Matthew Waterhouse ', 141, 'Matthew_Waterhouse', '', 0, 1, '0.0000', 1),
(762, 'Janet Fielding ', 141, 'Janet_Fielding', '', 0, 1, '0.0000', 1),
(763, 'Sarah Sutton ', 141, 'Sarah_Sutton', '', 0, 1, '0.0000', 1),
(764, 'Mark Strickson ', 141, 'Mark_Strickson', '', 0, 1, '0.0000', 1),
(765, 'Gerald Flood ', 141, 'Gerald_Flood', '', 0, 1, '0.0000', 1),
(766, 'Nicola Bryant ', 141, 'Nicola_Bryant', '', 0, 1, '0.0000', 1),
(767, 'Bonnie Langford ', 141, 'Bonnie_Langford', '', 0, 1, '0.0000', 1),
(768, 'Sophie Aldred ', 141, 'Sophie_Aldred', '', 0, 1, '0.0000', 1),
(769, 'Daphne Ashbrook ', 141, 'Daphne_Ashbrook', '', 0, 1, '0.0000', 1),
(770, 'Billie Piper ', 141, 'Billie_Piper', '', 0, 1, '0.0000', 1),
(771, 'Bruno Langley ', 141, 'Bruno_Langley', '', 0, 1, '0.0000', 1),
(772, 'John Barrowman ', 141, 'John_Barrowman', '', 0, 1, '0.0000', 1),
(773, 'Noel Clarke ', 141, 'Noel_Clarke', '', 0, 1, '0.0000', 1),
(774, 'Catherine Tate ', 141, 'Catherine_Tate', '', 0, 1, '0.0000', 1),
(775, 'Freema Agyeman ', 141, 'Freema_Agyeman', '', 0, 1, '0.0000', 1),
(776, 'Kylie Minogue ', 141, 'Kylie_Minogue', '', 0, 1, '0.0000', 1),
(777, 'Bernard Cribbins ', 141, 'Bernard_Cribbins', '', 0, 1, '0.0000', 1),
(778, 'Karen Gillan ', 141, 'Karen_Gillan', '', 0, 1, '0.0000', 1),
(779, 'Arthur Darvill ', 141, 'Arthur_Darvill', '', 0, 1, '0.0000', 1),
(780, 'Alex Kingston ', 141, 'Alex_Kingston', '', 0, 1, '0.0000', 1),
(781, 'James Corden ', 141, 'James_Corden', '', 0, 1, '0.0000', 1),
(782, 'Jenna-Louise Coleman ', 141, 'Jenna-Louise_Coleman', '', 0, 1, '0.0000', 1),
(783, 'Neve McIntosh ', 141, 'Neve_McIntosh', '', 0, 1, '0.0000', 1),
(784, 'Catrin Stewart ', 141, 'Catrin_Stewart', '', 0, 1, '0.0000', 1),
(785, 'Dan Starkey ', 141, 'Dan_Starkey', '', 0, 1, '0.0000', 1),
(786, 'Pearl Mackie ', 141, 'Pearl_Mackie', '', 0, 1, '0.0000', 1),
(787, 'Matt Lucas ', 141, 'Matt_Lucas', '', 0, 1, '0.0000', 1),
(788, 'Directors', 140, 'Directors', '0', 1, 1, '0.0000', 1),
(789, 'Adam Smith ', 788, 'Adam_Smith', '', 0, 1, '0.0000', 1),
(790, 'Alan Bromly ', 788, 'Alan_Bromly', '', 0, 1, '0.0000', 1),
(791, 'Alan Wareing ', 788, 'Alan_Wareing', '', 0, 1, '0.0000', 1),
(792, 'Alice Troughton ', 788, 'Alice_Troughton', '', 0, 1, '0.0000', 1),
(793, 'Andrew Gunn ', 788, 'Andrew_Gunn', '', 0, 1, '0.0000', 1),
(794, 'Andrew Morgan ', 788, 'Andrew_Morgan', '', 0, 1, '0.0000', 1),
(795, 'Andy Goddard ', 788, 'Andy_Goddard', '', 0, 1, '0.0000', 1),
(796, 'Ashley Way ', 788, 'Ashley_Way', '', 0, 1, '0.0000', 1),
(797, 'Barry Letts ', 788, 'Barry_Letts', '', 0, 1, '0.0000', 1),
(798, 'Ben Wheatley ', 788, 'Ben_Wheatley', '', 0, 1, '0.0000', 1),
(799, 'Bill Sellars ', 788, 'Bill_Sellars', '', 0, 1, '0.0000', 1),
(800, 'Brian Grant ', 788, 'Brian_Grant', '', 0, 1, '0.0000', 1),
(801, 'Catherine Morshead ', 788, 'Catherine_Morshead', '', 0, 1, '0.0000', 1),
(802, 'Charles Palmer ', 788, 'Charles_Palmer', '', 0, 1, '0.0000', 1),
(803, 'Chris Clough ', 788, 'Chris_Clough', '', 0, 1, '0.0000', 1),
(804, 'Christopher Barry ', 788, 'Christopher_Barry', '', 0, 1, '0.0000', 1),
(805, 'Colin Teague ', 788, 'Colin_Teague', '', 0, 1, '0.0000', 1),
(806, 'Colm McCarthy ', 788, 'Colm_McCarthy', '', 0, 1, '0.0000', 1),
(807, 'Dan Zeff ', 788, 'Dan_Zeff', '', 0, 1, '0.0000', 1),
(808, 'Daniel Nettheim ', 788, 'Daniel_Nettheim', '', 0, 1, '0.0000', 1),
(809, 'Daniel O&#39; Hara ', 788, 'Daniel_O_Hara', '', 0, 1, '0.0000', 1),
(810, 'Darrol Blake ', 788, 'Darrol_Blake', '', 0, 1, '0.0000', 1),
(811, 'David Maloney ', 788, 'David_Maloney', '', 0, 1, '0.0000', 1),
(812, 'Derek Martinus ', 788, 'Derek_Martinus', '', 0, 1, '0.0000', 1),
(813, 'Derrick Goodwin ', 788, 'Derrick_Goodwin', '', 0, 1, '0.0000', 1),
(814, 'Douglas Camfield ', 788, 'Douglas_Camfield', '', 0, 1, '0.0000', 1),
(815, 'Douglas Mackinnon ', 788, 'Douglas_Mackinnon', '', 0, 1, '0.0000', 1),
(816, 'Ed Bazalgette ', 788, 'Ed_Bazalgette', '', 0, 1, '0.0000', 1),
(817, 'Euros Lyn ', 788, 'Euros_Lyn', '', 0, 1, '0.0000', 1),
(818, 'Farren Blackburn ', 788, 'Farren_Blackburn', '', 0, 1, '0.0000', 1),
(819, 'Fiona Cumming ', 788, 'Fiona_Cumming', '', 0, 1, '0.0000', 1),
(820, 'Frank Cox ', 788, 'Frank_Cox', '', 0, 1, '0.0000', 1),
(821, 'Geoffrey Sax ', 788, 'Geoffrey_Sax', '', 0, 1, '0.0000', 1),
(822, 'George Spenton-Foster ', 788, 'George_Spenton_Foster', '', 0, 1, '0.0000', 1),
(823, 'Gerald Blake ', 788, 'Gerald_Blake', '', 0, 1, '0.0000', 1),
(824, 'Gerry Mill ', 788, 'Gerry_Mill', '', 0, 1, '0.0000', 1),
(825, 'Gordon Flemyng ', 788, 'Gordon_Flemyng', '', 0, 1, '0.0000', 1),
(826, 'Graeme Harper ', 788, 'Graeme_Harper', '', 0, 1, '0.0000', 1),
(827, 'Henric Hirsch ', 788, 'Henric_Hirsch', '', 0, 1, '0.0000', 1),
(828, 'Hettie MacDonald ', 788, 'Hettie_MacDonald', '', 0, 1, '0.0000', 1),
(829, 'Hugh David ', 788, 'Hugh_David', '', 0, 1, '0.0000', 1),
(830, 'James Hawes ', 788, 'James_Hawes', '', 0, 1, '0.0000', 1),
(831, 'James Strong ', 788, 'James_Strong', '', 0, 1, '0.0000', 1),
(832, 'Jamie Payne ', 788, 'Jamie_Payne', '', 0, 1, '0.0000', 1),
(833, 'Jeremy Webb ', 788, 'Jeremy_Webb', '', 0, 1, '0.0000', 1),
(834, 'Joe Ahearne ', 788, 'Joe_Ahearne', '', 0, 1, '0.0000', 1),
(835, 'John Black ', 788, 'John_Black', '', 0, 1, '0.0000', 1),
(836, 'John Crockett ', 788, 'John_Crockett', '', 0, 1, '0.0000', 1),
(837, 'John Davies ', 788, 'John_Davies', '', 0, 1, '0.0000', 1),
(838, 'John Gorrie ', 788, 'John_Gorrie', '', 0, 1, '0.0000', 1),
(839, 'Jonny Campbell ', 788, 'Jonny_Campbell', '', 0, 1, '0.0000', 1),
(840, 'Julia Smith ', 788, 'Julia_Smith', '', 0, 1, '0.0000', 1),
(841, 'Julian Simpson ', 788, 'Julian_Simpson', '', 0, 1, '0.0000', 1),
(842, 'Justin Molotnikov ', 788, 'Justin_Molotnikov', '', 0, 1, '0.0000', 1),
(843, 'Keith Boak ', 788, 'Keith_Boak', '', 0, 1, '0.0000', 1),
(844, 'Ken Grieve ', 788, 'Ken_Grieve', '', 0, 1, '0.0000', 1),
(845, 'Kenny McBain ', 788, 'Kenny_McBain', '', 0, 1, '0.0000', 1),
(846, 'Lennie Mayne ', 788, 'Lennie_Mayne', '', 0, 1, '0.0000', 1),
(847, 'Lovett Bickford ', 788, 'Lovett_Bickford', '', 0, 1, '0.0000', 1),
(848, 'Marvyn Pinfield ', 788, 'Marvyn_Pinfield', '', 0, 1, '0.0000', 1),
(849, 'Mary Ridge ', 788, 'Mary_Ridge', '', 0, 1, '0.0000', 1),
(850, 'Mat King ', 788, 'Mat_King', '', 0, 1, '0.0000', 1),
(851, 'Matthew Robinson ', 788, 'Matthew_Robinson', '', 0, 1, '0.0000', 1),
(852, 'Mervyn Pinfield ', 788, 'Mervyn_Pinfield', '', 0, 1, '0.0000', 1),
(853, 'Michael E. Briant ', 788, 'Michael_E_Briant', '', 0, 1, '0.0000', 1),
(854, 'Michael Ferguson ', 788, 'Michael_Ferguson', '', 0, 1, '0.0000', 1),
(855, 'Michael Hart ', 788, 'Michael_Hart', '', 0, 1, '0.0000', 1),
(856, 'Michael Hayes ', 788, 'Michael_Hayes', '', 0, 1, '0.0000', 1),
(857, 'Michael Imison ', 788, 'Michael_Imison', '', 0, 1, '0.0000', 1),
(858, 'Michael Kerrigan ', 788, 'Michael_Kerrigan', '', 0, 1, '0.0000', 1),
(859, 'Michael Leeston-Smith ', 788, 'Michael_Leeston_Smith', '', 0, 1, '0.0000', 1),
(860, 'Michael Owen Morris ', 788, 'Michael_Owen_Morris', '', 0, 1, '0.0000', 1),
(861, 'Morris Barry ', 788, 'Morris_Barry', '', 0, 1, '0.0000', 1),
(862, 'Nicholas Mallett ', 788, 'Nicholas_Mallett', '', 0, 1, '0.0000', 1),
(863, 'Nick Hurran ', 788, 'Nick_Hurran', '', 0, 1, '0.0000', 1),
(864, 'Norman Stewart ', 788, 'Norman_Stewart', '', 0, 1, '0.0000', 1),
(865, 'Paddy Russell ', 788, 'Paddy_Russell', '', 0, 1, '0.0000', 1),
(866, 'Paul Bernard ', 788, 'Paul_Bernard', '', 0, 1, '0.0000', 1),
(867, 'Paul Joyce ', 788, 'Paul_Joyce', '', 0, 1, '0.0000', 1),
(868, 'Paul Murphy ', 788, 'Paul_Murphy', '', 0, 1, '0.0000', 1),
(869, 'Paul Wilmshurst ', 788, 'Paul_Wilmshurst', '', 0, 1, '0.0000', 1),
(870, 'Pennant Roberts ', 788, 'Pennant_Roberts', '', 0, 1, '0.0000', 1),
(871, 'Peter Grimwade ', 788, 'Peter_Grimwade_Director', '', 0, 1, '0.0000', 1),
(872, 'Peter Hoar ', 788, 'Peter_Hoar', '', 0, 1, '0.0000', 1),
(873, 'Peter Moffatt ', 788, 'Peter_Moffatt', '', 0, 1, '0.0000', 1),
(874, 'Rachel Talalay ', 788, 'Rachel_Talalay', '', 0, 1, '0.0000', 1),
(875, 'Rex Tucker ', 788, 'Rex_Tucker', '', 0, 1, '0.0000', 1),
(876, 'Richard Clark ', 788, 'Richard_Clark', '', 0, 1, '0.0000', 1),
(877, 'Richard Martin ', 788, 'Richard_Martin', '', 0, 1, '0.0000', 1),
(878, 'Richard Senior ', 788, 'Richard_Senior', '', 0, 1, '0.0000', 1),
(879, 'Rodney Bennett ', 788, 'Rodney_Bennett', '', 0, 1, '0.0000', 1),
(880, 'Ron Jones ', 788, 'Ron_Jones', '', 0, 1, '0.0000', 1),
(881, 'Sarah Hellings ', 788, 'Sarah_Hellings', '', 0, 1, '0.0000', 1),
(882, 'Saul Metzstein ', 788, 'Saul_Metzstein', '', 0, 1, '0.0000', 1),
(883, 'Sheree Folkson ', 788, 'Sheree_Folkson', '', 0, 1, '0.0000', 1),
(884, 'Stephen Woolfenden ', 788, 'Stephen_Woolfenden', '', 0, 1, '0.0000', 1),
(885, 'Steve Hughes ', 788, 'Steve_Hughes', '', 0, 1, '0.0000', 1),
(886, 'Terency Dudley ', 788, 'Terency_Dudley', '', 0, 1, '0.0000', 1),
(887, 'Timothy Combe ', 788, 'Timothy_Combe', '', 0, 1, '0.0000', 1),
(888, 'Toby Haynes ', 788, 'Toby_Haynes', '', 0, 1, '0.0000', 1),
(889, 'Tony Virgo ', 788, 'Tony_Virgo', '', 0, 1, '0.0000', 1),
(890, 'Tristan DeVere Cole ', 788, 'Tristan_DeVere_Cole', '', 0, 1, '0.0000', 1),
(891, 'Waris Hussein ', 788, 'Waris_Hussein', '', 0, 1, '0.0000', 1),
(892, 'Lawrence Gough ', 788, 'Lawrence_Gough', '', 0, 1, '0.0000', 1),
(893, 'Bill Anderson ', 788, 'Bill_Anderson', '', 0, 1, '0.0000', 1),
(894, 'Varia', 155, 'Varia', '', 0, 1, '0.0000', 1),
(895, 'Wayne Yip ', 788, 'Wayne_Yip', '', 0, 1, '0.0000', 1),
(896, 'Andrew McCulloch ', 181, 'Andrew_McCulloch', '', 0, 1, '0.0000', 1),
(897, 'Andrew Smith ', 181, 'Andrew_Smith', '', 0, 1, '0.0000', 1),
(898, 'Anthony Coburn ', 181, 'Anthony_Coburn', '', 0, 1, '0.0000', 1),
(899, 'Anthony Read ', 181, 'Anthony_Read', '', 0, 1, '0.0000', 1),
(900, 'Anthony Steven ', 181, 'Anthony_Steven', '', 0, 1, '0.0000', 1),
(901, 'Barbara Clegg ', 181, 'Barbara_Clegg', '', 0, 1, '0.0000', 1),
(902, 'Paul Carson', 1352, 'Paul_Carson', '', 0, 1, '0.0000', 1),
(903, 'Ben Aaronovitch ', 181, 'Ben_Aaronovitch', '', 0, 1, '0.0000', 1),
(904, 'Bill Strutton ', 181, 'Bill_Strutton', '', 0, 1, '0.0000', 1),
(905, 'Bob Baker ', 181, 'Bob_Baker', '', 0, 1, '0.0000', 1),
(906, 'Brian Hayles ', 181, 'Brian_Hayles', '', 0, 1, '0.0000', 1),
(907, 'Catherine Tregenna ', 181, 'Catherine_Tregenna', '', 0, 1, '0.0000', 1),
(908, 'Chris Boucher ', 181, 'Chris_Boucher', '', 0, 1, '0.0000', 1),
(909, 'Chris Chibnall ', 181, 'Chris_Chibnall', '', 0, 1, '0.0000', 1),
(910, 'Christopher Bailey ', 181, 'Christopher_Bailey', '', 0, 1, '0.0000', 1),
(911, 'Christopher H. Bidmead ', 181, 'Christopher_H_Bidmead', '', 0, 1, '0.0000', 1),
(912, 'Dave Martin ', 181, 'Dave_Martin', '', 0, 1, '0.0000', 1),
(913, 'David Agnew ', 181, 'David_Agnew', '', 0, 1, '0.0000', 1),
(914, 'David Ellis ', 181, 'David_Ellis', '', 0, 1, '0.0000', 1),
(915, 'David Fisher ', 181, 'David_Fisher', '', 0, 1, '0.0000', 1),
(916, 'David Whitaker ', 181, 'David_Whitaker', '', 0, 1, '0.0000', 1),
(917, 'Dennis Spooner ', 181, 'Dennis_Spooner', '', 0, 1, '0.0000', 1),
(918, 'Derrick Sherwin ', 181, 'Derrick_Sherwin', '', 0, 1, '0.0000', 1),
(919, 'Don Houghton ', 181, 'Don_Houghton', '', 0, 1, '0.0000', 1),
(920, 'Donald Cotton ', 181, 'Donald_Cotton', '', 0, 1, '0.0000', 1),
(921, 'Donald Tosh ', 181, 'Donald_Tosh', '', 0, 1, '0.0000', 1),
(922, 'Douglas Adams ', 181, 'Douglas_Adams', '', 0, 1, '0.0000', 1),
(923, 'Elwyn Jones ', 181, 'Elwyn_Jones', '', 0, 1, '0.0000', 1),
(924, 'Eric Pringle ', 181, 'Eric_Pringle', '', 0, 1, '0.0000', 1),
(925, 'Eric Saward ', 181, 'Eric_Saward', '', 0, 1, '0.0000', 1),
(926, 'Frank Cottrell-Boyce ', 181, 'Frank_Cottrell-Boyce', '', 0, 1, '0.0000', 1),
(927, 'Gareth Roberts ', 181, 'Gareth_Roberts', '', 0, 1, '0.0000', 1),
(928, 'Geoffrey Orme ', 181, 'Geoffrey_Orme', '', 0, 1, '0.0000', 1),
(929, 'Gerry Davis ', 181, 'Gerry_Davis', '', 0, 1, '0.0000', 1),
(930, 'Glen McCoy ', 181, 'Glen_McCoy', '', 0, 1, '0.0000', 1),
(931, 'Glyn Jones ', 181, 'Glyn_Jones', '', 0, 1, '0.0000', 1),
(932, 'Graeme Curry ', 181, 'Graeme_Curry', '', 0, 1, '0.0000', 1),
(933, 'Graham Williams ', 181, 'Graham_Williams', '', 0, 1, '0.0000', 1),
(934, 'Guy Leopold ', 181, 'Guy_Leopold', '', 0, 1, '0.0000', 1),
(935, 'Helen Raynor ', 181, 'Helen_Raynor', '', 0, 1, '0.0000', 1),
(936, 'Henry Lincoln ', 181, 'Henry_Lincoln', '', 0, 1, '0.0000', 1),
(937, 'Ian Briggs ', 181, 'Ian_Briggs', '', 0, 1, '0.0000', 1),
(938, 'Ian Stuart Black ', 181, 'Ian_Stuart_Black', '', 0, 1, '0.0000', 1),
(939, 'James Moran ', 181, 'James_Moran', '', 0, 1, '0.0000', 1),
(940, 'Jamie Mathieson ', 181, 'Jamie_Mathieson', '', 0, 1, '0.0000', 1),
(941, 'Jane Baker ', 181, 'Jane_Baker', '', 0, 1, '0.0000', 1),
(942, 'John Flanagan ', 181, 'John_Flanagan', '', 0, 1, '0.0000', 1),
(943, 'John Lucarotti ', 181, 'John_Lucarotti', '', 0, 1, '0.0000', 1),
(944, 'Johnny Byrne ', 181, 'Johnny_Byrne', '', 0, 1, '0.0000', 1),
(945, 'Keith Temple ', 181, 'Keith_Temple', '', 0, 1, '0.0000', 1),
(946, 'Kevin Clarke ', 181, 'Kevin_Clarke', '', 0, 1, '0.0000', 1),
(947, 'Kit Pedler ', 181, 'Kit_Pedler', '', 0, 1, '0.0000', 1),
(948, 'Lesley Scott ', 181, 'Lesley_Scott', '', 0, 1, '0.0000', 1),
(949, 'Lewis Greifer ', 181, 'Lewis_Greifer', '', 0, 1, '0.0000', 1),
(950, 'Louis Marks ', 181, 'Louis_Marks', '', 0, 1, '0.0000', 1),
(951, 'Malcolm Hulke ', 181, 'Malcolm_Hulke', '', 0, 1, '0.0000', 1),
(952, 'Malcolm Kohll ', 181, 'Malcolm_Kohll', '', 0, 1, '0.0000', 1),
(953, 'Marc Platt ', 181, 'Marc_Platt', '', 0, 1, '0.0000', 1),
(954, 'Mark Gatiss ', 181, 'Mark_Gatiss', '', 0, 1, '0.0000', 1),
(955, 'Matt Jones ', 181, 'Matt_Jones', '', 0, 1, '0.0000', 1),
(956, 'Matthew Graham ', 181, 'Matthew_Graham', '', 0, 1, '0.0000', 1),
(957, 'Matthew Jacobs ', 181, 'Matthew_Jacobs', '', 0, 1, '0.0000', 1),
(958, 'Mervyn Haisman ', 181, 'Mervyn_Haisman', '', 0, 1, '0.0000', 1),
(959, 'Milton Subotsky ', 181, 'Milton_Subotsky', '', 0, 1, '0.0000', 1),
(960, 'Neil Cross ', 181, 'Neil_Cross', '', 0, 1, '0.0000', 1),
(961, 'Neil Gaiman ', 181, 'Neil_Gaiman', '', 0, 1, '0.0000', 1),
(962, 'Norman Ashby ', 181, 'Norman_Ashby', '', 0, 1, '0.0000', 1),
(963, 'Paul Cornell ', 181, 'Paul_Cornell', '', 0, 1, '0.0000', 1),
(964, 'Paul Erickson ', 181, 'Paul_Erickson', '', 0, 1, '0.0000', 1),
(965, 'Paula Moore ', 181, 'Paula_Moore', '', 0, 1, '0.0000', 1),
(966, 'Peter Grimwade ', 181, 'Peter_Grimwade_Writer', '', 0, 1, '0.0000', 1),
(967, 'Peter Harness ', 181, 'Peter_Harness', '', 0, 1, '0.0000', 1),
(968, 'Peter Ling ', 181, 'Peter_Ling', '', 0, 1, '0.0000', 1),
(969, 'Peter R. Newman ', 181, 'Peter_R_Newman', '', 0, 1, '0.0000', 1),
(970, 'Phil Ford ', 181, 'Phil_Ford', '', 0, 1, '0.0000', 1),
(971, 'Philip &#39;Pip&#39; Baker ', 181, 'Philip_Baker', '', 0, 1, '0.0000', 1),
(972, 'Philip Martin ', 181, 'Philip_Martin', '', 0, 1, '0.0000', 1),
(973, 'Richard Curtis ', 181, 'Richard_Curtis', '', 0, 1, '0.0000', 1),
(974, 'Robert Banks Stewart ', 181, 'Robert_Banks_Stewart', '', 0, 1, '0.0000', 1),
(975, 'Robert Holmes ', 181, 'Robert_Holmes', '', 0, 1, '0.0000', 1),
(976, 'Robert Shearman ', 181, 'Robert_Shearman', '', 0, 1, '0.0000', 1),
(977, 'Robert Sloman ', 181, 'Robert_Sloman', '', 0, 1, '0.0000', 1),
(978, 'Robin Bland ', 181, 'Robin_Bland', '', 0, 1, '0.0000', 1),
(979, 'Rona Munro ', 181, 'Rona_Munro', '', 0, 1, '0.0000', 1),
(980, 'Russell T. Davies ', 181, 'Russell_T_Davies', '', 0, 1, '0.0000', 1),
(981, 'Sarah Dollard ', 181, 'Sarah_Dollard', '', 0, 1, '0.0000', 1),
(982, 'Simon Nye ', 181, 'Simon_Nye', '', 0, 1, '0.0000', 1),
(983, 'Stephen Gallagher ', 181, 'Stephen_Gallagher', '', 0, 1, '0.0000', 1),
(984, 'Stephen Greenhorn ', 181, 'Stephen_Greenhorn', '', 0, 1, '0.0000', 1),
(985, 'Stephen Harris ', 181, 'Stephen_Harris', '', 0, 1, '0.0000', 1),
(986, 'Stephen Thompson ', 181, 'Stephen_Thompson', '', 0, 1, '0.0000', 1),
(987, 'Stephen Wyatt ', 181, 'Stephen_Wyatt', '', 0, 1, '0.0000', 1),
(988, 'Steven Moffat ', 181, 'Steven_Moffat', '', 0, 1, '0.0000', 1),
(989, 'Terence Dudley ', 181, 'Terence_Dudley', '', 0, 1, '0.0000', 1),
(990, 'Terrance Dicks ', 181, 'Terrance_Dicks', '', 0, 1, '0.0000', 1),
(991, 'Terry Nation ', 181, 'Terry_Nation', '', 0, 1, '0.0000', 1),
(992, 'Toby Whithouse ', 181, 'Toby_Whithouse', '', 0, 1, '0.0000', 1),
(993, 'Tom MacRae ', 181, 'Tom_MacRae', '', 0, 1, '0.0000', 1),
(994, 'Trevor Ray ', 181, 'Trevor_Ray', '', 0, 1, '0.0000', 1),
(995, 'Victor Pemberton ', 181, 'Victor_Pemberton', '', 0, 1, '0.0000', 1),
(996, 'William Emms ', 181, 'William_Emms', '', 0, 1, '0.0000', 1),
(997, 'Mike Bartlett ', 181, 'Mike_Bartlett', '', 0, 1, '0.0000', 1),
(998, 'Skaro', 135, 'Skaro', '', 0, 1, '0.0000', 1),
(999, 'Fanart', 163, 'Fanart', '', 0, 1, '0.0000', 1),
(1000, 'Poster', 163, 'Poster', '', 0, 1, '0.0000', 1),
(1001, 'An Unearthly Child/100,000 BC', 80, 'An_Unearthly_Child_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1002, 'Dining With the Doctor', 159, 'Dining_With_The_Doctor', '', 0, 1, '0.0000', 1),
(1003, ' The Unquiet Dead', 119, 'The_Unquiet_Dead_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1004, ' Aliens of London', 119, 'Aliens_of_London_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1005, ' World War Three', 119, 'World_War_Three_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1006, ' Dalek', 119, 'Dalek_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1007, ' The Long Game', 119, 'The_Long_Game_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1008, ' Father&#39; s Day', 119, 'Father_s_Day_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1009, ' The Empty Child', 119, 'The_Empty_Child_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1010, ' The Doctor Dances', 119, 'The_Doctor_Dances_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1011, ' Boom Town', 119, 'Boom_Town_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1012, ' Bad Wolf', 119, 'Bad_Wolf_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1013, ' The Parting of the Ways', 119, 'The_Parting_Of_The_Ways_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1014, ' The Christmas Invasion', 120, 'The_Christmas_Invasion_(TV_Story)', '', 0, 1, '0.0000', 1),
(1015, ' New Earth', 120, 'New_Earth_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1016, ' Tooth and Claw', 120, 'Tooth_and_Claw_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1017, ' Shool Reunion', 120, 'School_Reunion_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1018, ' The Girl in the Fireplace', 120, 'The_Girl_In_The_Fireplace_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1019, ' Rise of the Cybermen', 120, 'Rise_Of_The_Cybermen_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1020, ' The Age of Steel', 120, 'The_Age_Of_Steel_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1021, ' The Idiot&#39; s Lantern', 120, 'The_Idiot_s_Lantern_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1022, ' The Impossible Planet', 120, 'The_Impossible_Planet_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1023, ' The Satan Pit', 120, 'The_Satan_Pit_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1024, ' Love & Monsters', 120, 'Love_And_Monsters_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1025, ' Fear Her', 120, 'Fear_Her_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1026, ' Army of Ghosts', 120, 'Army_Of_Ghosts_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1027, ' Doomsday', 120, 'Doomsday_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1028, 'Puzzle Book', 159, 'Puzzle_Book', 'Ja', 0, 1, '0.0000', 1),
(1029, 'Audio Stories', 160, 'Audio_Stories', '', 1, 1, '0.0000', 1),
(1030, 'Vortex Manipulator', 1370, 'Vortex_Manipulator', '', 0, 1, '0.0000', 1),
(1031, 'Audio Books', 160, 'Audio_Books', 'Nee', 0, 1, '0.0000', 1),
(1032, 'Big Finish', 1029, 'Big_Finish', 'Nee', 1, 1, '0.0000', 1),
(1033, 'Summer 1981', 130, 'DWMSI_Summer_1981', 'Nee', 0, 1, '2.0000', 1),
(1034, 'Winter 1981', 130, 'DWMSI_Winter_1981', 'Nee', 0, 1, '3.0000', 1),
(1035, 'Summer 1982', 130, 'DWMSI_Summer_1982', 'Nee', 0, 1, '4.0000', 1),
(1036, 'Winter 1982', 130, 'DWMSI_Winter_1982', 'Nee', 0, 1, '5.0000', 1),
(1037, 'Summer 1983', 130, 'DWMSI_Summer_1983', 'Nee', 0, 1, '6.0000', 1),
(1038, 'Winter 1983', 130, 'DWMSI_Winter_1983', 'Nee', 0, 1, '7.0000', 1),
(1039, 'Summer 1984', 130, 'DWMSI_Summer_1984', 'Nee', 0, 1, '8.0000', 1),
(1040, 'Winter 1984', 130, 'DWMSI_Winter_1984', 'Nee', 0, 1, '9.0000', 1),
(1041, 'Summer 1985', 130, 'DWMSI_Summer_1985', 'Nee', 0, 1, '10.0000', 1),
(1042, 'Winter 1985', 130, 'DWMSI_Winter_1985', 'Nee', 0, 1, '11.0000', 1),
(1043, 'Summer 1986', 130, 'DWMSI_Summer_1986', 'Nee', 0, 1, '12.0000', 1),
(1044, 'Winter 1986', 130, 'DWMSI_Winter_1986', 'Nee', 0, 1, '13.0000', 1),
(1045, 'Winter 1991', 130, 'DWMSI_Winter_1991', 'Nee', 0, 1, '14.0000', 1),
(1046, 'Summer 1992', 130, 'DWMSI_Summer_1992', 'Nee', 0, 1, '15.0000', 1),
(1047, 'Winter 1992', 130, 'DWMSI_Winter_1992', 'Nee', 0, 1, '16.0000', 1),
(1048, 'Summer 1993', 130, 'DWMSI_Summer_1993', 'Ja', 0, 1, '17.0000', 1),
(1049, '30th Anniversary 1993', 130, '30th_Anniversary_1993', 'Nee', 0, 1, '18.0000', 1),
(1050, 'Summer 1994', 130, 'DWMSI_Summer_1994', 'Nee', 0, 1, '19.0000', 1),
(1051, ' The Runaway Bride ', 121, 'The_Runaway_Bride_(TV_Story)', '', 0, 1, '0.0000', 1),
(1052, ' Smith and Jones ', 121, 'Smith_And_Jones_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1053, ' The Shakespeare Code ', 121, 'The_Shakespeare_Code_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1054, ' Gridlock ', 121, 'Gridlock_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1055, ' Daleks in Manhattan ', 121, 'Daleks_in_Manhattan_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1056, ' Evolution of the Daleks ', 121, 'Evolution_of_the_Daleks_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1057, ' The Lazarus Experiment ', 121, 'The_Lazarus_Experiment_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1058, ' 42 ', 121, '42_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1059, ' Human Nature ', 121, 'Human_Nature_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1060, ' The Family of Blood ', 121, 'The_Family_of_Blood_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1061, ' Blink ', 121, 'Blink_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1062, ' Utopia ', 121, 'Utopia_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1063, ' The Sound of Drums ', 121, 'The_Sound_of_Drums_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1064, ' Last of the Time Lords ', 121, 'Last_of_the_Time_Lords_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1065, 'Winter 1994', 130, 'DWMSI_Winter_1994', 'Ja', 0, 1, '20.0000', 1),
(1066, 'Summer 1995', 130, 'DWMSI_Summer_1995', 'Ja', 0, 1, '21.0000', 1),
(1067, 'Autumn 1987', 130, 'DWMSI_Autumn_1987', 'Ja', 0, 1, '22.0000', 1),
(1068, '25th Aniversary 1988', 130, 'DWMSI_25th_Anniversary_1988', 'Ja', 0, 1, '23.0000', 1),
(1069, 'Spring 1996', 130, 'DWMSI_Spring_1996', 'Ja', 0, 1, '24.0000', 1),
(1070, ' Voyage of the Damned (Special)', 122, 'Voyage_of_the_Damned_(TV_Story)', '', 0, 1, '0.0000', 1),
(1071, ' Partners in Crime ', 122, 'Partners_in_Crime_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1072, ' The Fires of Pompeii ', 122, 'The_Fires_of_Pompeii_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1073, ' Planet of the Ood ', 122, 'Planet_of_the_Ood_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1074, ' The Sontaran Stratagem ', 122, 'The_Sontaran_Stratagem_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1075, ' The Poison Sky ', 122, 'The_Poison_Sky_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1076, ' The Doctor&#39; s Daughter ', 122, 'The_Doctor_s_Daughter_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1077, ' The Unicorn and the Wasp ', 122, 'The_Unicorn_and_the_Wasp_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1078, ' Silence in the Library ', 122, 'Silence_in_the_Library_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1079, ' Forest of the Dead ', 122, 'Forest_of_the_Dead_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1080, ' Midnight ', 122, 'Midnight_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1081, ' Turn Left ', 122, 'Turn_Left_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1082, ' The Stolen Earth ', 122, 'The_Stolen_Earth_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1083, ' Journey&#39 s End ', 122, 'Journey_s_End_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1084, 'The Next Doctor (Special)', 1602, 'The_Next_Doctor_(TV_Story)', '', 0, 1, '14000.0000', 1),
(1085, 'Planet of the Dead (Special)', 1602, 'Planet_of_the_Dead_(TV_Story)', '', 0, 1, '15000.0000', 1),
(1086, 'The Waters of Mars (Special)', 1602, 'The_Waters_of_Mars_(TV_Story)', '', 0, 1, '16000.0000', 1),
(1087, 'The End of Time (Special)', 1602, 'The_End_of_Time_(TV_Story)', '', 0, 1, '17000.0000', 1),
(1089, 'Minisodes', 25, 'Minisodes', '0', 1, 1, '800.0000', 1),
(1090, 'M 00: Time Crash ', 1089, 'Time_Crash_(TV_Story)', '', 0, 1, '0.0000', 1),
(1091, ' The Eleventh Hour ', 123, 'The_Eleventh_Hour_(TV_Story)', '', 0, 1, '0.0000', 1),
(1092, ' The Beast Below ', 123, 'The_Beast_Below_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1093, ' Victory of the Daleks ', 123, 'Victory_of_the_Daleks_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1094, ' The Time of Angels ', 123, 'The_Time_of_Angels_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1095, ' Flesh and Stone ', 123, 'Flesh_and_Stone_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1096, ' The Vampires of Venice ', 123, 'The_Vampires_of_Venice_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1097, ' Amy&#39;s Choice ', 123, 'Amy_s_Choice_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1098, ' The Hungry Earth ', 123, 'The_Hungry_Earth_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1099, ' Cold Blood ', 123, 'Cold_Blood_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1100, ' Vincent and the Doctor ', 123, 'Vincent_and_the_Doctor_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1101, ' The Lodger ', 123, 'The_Lodger_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1102, ' The Pandorica Opens ', 123, 'The_Pandorica_Opens_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1103, ' The Big Bang ', 123, 'The_Big_Bang_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1104, ' A Christmas Carol ', 124, 'A_Christmas_Carol_(TV_Story)', '', 0, 1, '0.0000', 1),
(1105, ' The Impossible Astronaut ', 124, 'The_Impossible_Astronaut_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1106, ' Day of the Moon ', 124, 'Day_of_the_Moon_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1107, ' The Curse of the Black Spot ', 124, 'The_Curse_of_the_Black_Spot_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1108, ' The Doctor&#39;s Wife ', 124, 'The_Doctor_s_Wife_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1109, ' The Rebel Flesh ', 124, 'The_Rebel_Flesh_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1110, ' The Almost People ', 124, 'The_Almost_People_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1111, ' A Good Man Goes to War ', 124, 'A_Good_Man_Goes_to_War_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1112, ' Let&#39;s Kill Hitler ', 124, 'Let_s_Kill_Hitler_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1113, ' Night Terrors ', 124, 'Night_Terrors_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1114, ' The Girl Who Waited ', 124, 'The_Girl_Who_Waited_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1115, ' The God Complex ', 124, 'The_God_Complex_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1116, ' Closing Time ', 124, 'Closing_Time_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1117, ' The Wedding of River Song ', 124, 'The_Wedding_of_River_Song_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1120, ' The Doctor, the Widow and the Wardrobe ', 125, 'The_Doctor_the_Widow_and_the_Wardrobe_(TV_Story)', '', 0, 1, '0.0000', 1),
(1121, ' Asylum of the Daleks ', 125, 'Asylum_of_the_Daleks_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1122, ' Dinosaurs on a Spaceship ', 125, 'Dinosaurs_on_a_Spaceship_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1123, ' A Town Called Mercy ', 125, 'A_Town_Called_Mercy_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1124, ' The Power of Three ', 125, 'The_Power_of_Three_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1125, ' The Angels Take Manhattan ', 125, 'The_Angels_Take_Manhattan_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1126, ' The Snowmen ', 125, 'The_Snowmen_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1127, ' The Bells of Saint John ', 125, 'The_Bells_of_Saint_John_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1128, ' The Rings of Akhaten ', 125, 'The_Rings_of_Akhaten_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1129, ' Cold War ', 125, 'Cold_War_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1130, ' Hide ', 125, 'Hide_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1131, ' Journey to the Centre of the TARDIS ', 125, 'Journey_to_the_Centre_of_the_TARDIS_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1132, ' The Crimson Horror ', 125, 'The_Crimson_Horror_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1133, ' Nightmare in Silver ', 125, 'Nightmare_in_Silver_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1134, ' The Name of the Doctor ', 125, 'The_Name_of_the_Doctor_(TV_Story)', '', 0, 1, '14000.0000', 1),
(1135, 'The Day of the Doctor (Special)', 1603, 'The_Day_of_the_Doctor_(TV_Story)', '', 0, 1, '15000.0000', 1),
(1136, 'The Time of the Doctor (Special)', 1603, 'The_Time_of_the_Doctor_(TV_Story)', '', 0, 1, '16000.0000', 1),
(1137, ' Deep Breath ', 126, 'Deep_Breath_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1138, ' Into the Dalek ', 126, 'Into_the_Dalek_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1139, ' Robot of Sherwood ', 126, 'Robot_of_Sherwood_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1140, ' Listen ', 126, 'Listen_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1141, ' Time Heist ', 126, 'Time_Heist_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1142, ' The Caretaker ', 126, 'The_Caretaker_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1143, ' Kill the Moon ', 126, 'Kill_the_Moon_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1144, ' Mummy on the Orient Express ', 126, 'Mummy_on_the_Orient_Express_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1145, ' Flatline ', 126, 'Flatline_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1146, ' In the Forest of the Night ', 126, 'In_the_Forest_of_the_Night_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1147, ' Dark Water ', 126, 'Dark_Water_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1148, ' Death in Heaven ', 126, 'Death_in_Heaven_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1149, ' Last Christmas ', 127, 'Last_Christmas_(TV_Story)', '', 0, 1, '0.0000', 1),
(1150, ' The Magician&#39;s Apprentice ', 127, 'The_Magician_s_Apprentice_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1151, ' The Witch&#39;s Familiar ', 127, 'The_Witch_s_Familiar_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1152, ' Under the Lake ', 127, 'Under_the_Lake_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1153, ' Before the Flood ', 127, 'Before_the_Flood_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1154, ' The Girl Who Died ', 127, 'The_Girl_Who_Died_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1155, ' The Woman Who Lived ', 127, 'The_Woman_Who_Lived_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1156, ' The Zygon Invasion ', 127, 'The_Zygon_Invasion_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1157, ' The Zygon Inversion ', 127, 'The_Zygon_Inversion_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1158, ' Sleep No More ', 127, 'Sleep_No_More_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1159, ' Face the Raven', 127, 'Face_the_Raven_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1160, ' Heaven Sent', 127, 'Heaven_Sent_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1161, ' Hell Bent', 127, 'Hell_Bent_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1162, ' The Husbands of River Song', 127, 'The_Husbands_of_River_Song_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1163, ' The Return of Doctor Mysterio', 128, 'The_Return_of_Doctor_Mysterio_(TV_Story)', '', 0, 1, '0.0000', 1),
(1164, ' The Pilot', 128, 'The_Pilot_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1165, ' Smile', 128, 'Smile_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1166, ' Thin Ice', 128, 'Thin_Ice_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1167, ' Knock Knock', 128, 'Knock_Knock_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1168, ' Oxygen', 128, 'Oxygen_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1169, ' Extremis', 128, 'Extremis_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1170, ' The Pyramid at the End of the World', 128, 'The_Pyramid_at_the_End_of_the_World_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1171, ' The Lie of the Land', 128, 'The_Lie_of_the_Land_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1172, ' Empress of Mars', 128, 'Empress_of_Mars_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1173, ' The Eaters of Light', 128, 'The_Eaters_of_Light_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1174, ' World Enough and Time', 128, 'World_Enough_and_Time_(TV_Story)', '', 0, 1, '11000.0000', 1),
(1175, ' The Doctor Falls', 128, 'The_Doctor_Falls_(TV_Story)', '', 0, 1, '12000.0000', 1),
(1176, ' Twice Upon A Time', 128, 'Twice_Upon_A_Time_(TV_Story)', '', 0, 1, '13000.0000', 1),
(1177, 'The Dalek Chronicles', 130, 'DWMSI_The_Dalek_Chronicles', 'Ja', 0, 1, '25.0000', 1),
(1178, 'The Daleks', 80, 'The_Daleks_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1179, 'The Edge of Destruction', 80, 'The_Edge_Of_Destruction_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1180, 'Marco Polo', 80, 'Marco_Polo_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1181, 'The Keys of Marinus', 80, 'The_Keys_Of_Marinus_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1182, 'The Aztecs', 80, 'The_Aztecs_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1183, 'The Sensorites', 80, 'The_Sensorites_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1184, 'The Reign of Terror', 80, 'The_Reign_Of_Terror_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1185, ' Planet of Giants', 81, 'Planet_of_Giants_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1186, ' The Dalek Invasion of Earth', 81, 'The_Dalek_Invasion_of_Earth_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1187, ' The Rescue', 81, 'The_Rescue_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1188, ' The Romans', 81, 'The_Romans_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1189, ' The Web Planet', 81, 'The_Web_Planet_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1190, ' The Crusade', 81, 'The_Crusade_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1191, ' The Space Museum', 81, 'The_Space_Museum_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1192, ' The Chase', 81, 'The_Chase_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1193, ' The Time Meddler', 81, 'The_Time_Meddler_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1194, ' Galaxy 4', 82, 'Galaxy_4_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1195, ' Mission to the Unknown', 82, 'Mission_to_the_Unknown_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1196, ' The Myth Makers', 82, 'The_Myth_Makers_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1197, ' The Daleks&#39;s Master Plan', 82, 'The_Daleks_Master_Plan_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1198, ' The Massacre of St. Bartholomew&#39;s Eve', 82, 'The_Massacre_of_St_Bartholomew_s_Eve_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1199, ' The Ark', 82, 'The_Ark_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1200, ' The Celestial Toymaker', 82, 'The_Celestial_Toymaker_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1201, ' The Gunfighters', 82, 'The_Gunfighters_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1202, ' The Savages', 82, 'The_Savages_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1203, ' The War Machines', 82, 'The_War_Machines_(TV_Story)', '', 0, 1, '10000.0000', 1),
(1204, ' The Smugglers', 83, 'The_Smugglers_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1205, ' The Tenth Planet', 83, 'The_Tenth_Planet_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1206, ' The Power of the Daleks', 83, 'The_Power_of_the_Daleks_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1207, ' The Highlanders', 83, 'The_Highlanders_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1208, ' The Underwater Menace', 83, 'The_Underwater_Menace_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1209, ' The Moonbase', 83, 'The_Moonbase_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1210, ' The Macra Terror', 83, 'The_Macra_Terror_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1211, ' The Faceless Ones', 83, 'The_Faceless_Ones_(TV_Story)', '', 0, 1, '8000.0000', 1),
(1212, ' The Evil of the Daleks', 83, 'The_Evil_of_the_Daleks_(TV_Story)', '', 0, 1, '9000.0000', 1),
(1213, ' The Tomb of the Cybermen', 96, 'The_Tomb_of_the_Cybermen_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1214, ' The Abominable Snowmen', 96, 'The_Abominable_Snowmen_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1215, ' The Ice Warriors', 96, 'The_Ice_Warriors_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1216, ' The Enemy of the World', 96, 'The_Enemy_of_the_World_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1217, ' The Web of Fear', 96, 'The_Web_of_Fear_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1218, ' Fury from the Deep', 96, 'Fury_from_the_Deep_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1219, ' The Wheel in Space', 96, 'The_Wheel_in_Space_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1220, ' The Dominators', 97, 'The_Dominators_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1221, ' The Mind Robber', 97, 'The_Mind_Robber_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1222, ' The Invasion', 97, 'The_Invasion_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1223, ' The Krotons', 97, 'The_Krotons_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1224, ' The Seeds of Death', 97, 'The_Seeds_of_Death_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1225, ' The Space Pirates', 97, 'The_Space_Pirates_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1226, ' The War Games', 97, 'The_War_Games_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1227, ' Spearhead from Space', 98, 'Spearhead_from_Space_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1228, ' Doctor Who and the Silurians', 98, 'Doctor_Who_and_the_Silurians_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1229, ' The Ambassadors of Death', 98, 'The_Ambassadors_of_Death_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1230, ' Inferno', 98, 'Inferno_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1231, ' Terror of the Autons', 99, 'Terror_of_the_Autons_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1232, ' The Mind of Evil', 99, 'The_Mind_of_Evil_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1233, ' The Claws of Axos', 99, 'The_Claws_of_Axos_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1234, ' Colony in Space', 99, 'Colony_in_Space_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1235, ' The Daemons', 99, 'The_Daemons_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1236, ' Day of the Daleks', 100, 'Day_of_the_Daleks_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1237, ' The Curse of Peladon', 100, 'The_Curse_of_Peladon_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1238, ' The Sea Devils', 100, 'The_Sea_Devils_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1239, ' The Mutants', 100, 'The_Mutants_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1240, ' The Time Monster', 100, 'The_Time_Monster_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1241, ' The Three Doctors', 101, 'The_Three_Doctors_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1242, ' Carnival of Monsters', 101, 'Carnival_of_Monsters_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1243, ' Frontier in Space', 101, 'Frontier_in_Space_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1244, ' Planet of the Daleks', 101, 'Planet_of_the_Daleks_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1245, ' The Green Death', 101, 'The_Green_Death_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1246, ' The Time Warrior', 102, 'The_Time_Warrior_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1247, ' Invasion of the Dinosaurs', 102, 'Invasion_of_the_Dinosaurs_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1248, ' Death to the Daleks', 102, 'Death_to_the_Daleks_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1249, ' The Monster of Peladon', 102, 'The_Monster_of_Peladon_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1250, ' Planet of the Spiders', 102, 'Planet_of_the_Spiders_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1251, ' Robot', 103, 'Robot_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1252, ' The Ark in Space', 103, 'The_Ark_in_Space_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1253, ' The Sontaran Experiment', 103, 'The_Sontaran_Experiment_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1254, ' Genesis of the Daleks', 103, 'Genesis_of_the_Daleks_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1255, ' Revenge of the Cybermen', 103, 'Revenge_of_the_Cybermen_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1256, ' Terror of the Zygons', 104, 'Terror_of_the_Zygons_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1257, ' Planet of Evil', 104, 'Planet_of_Evil_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1258, ' Pyramids of Mars', 104, 'Pyramids_of_Mars_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1259, ' The Android Invasion', 104, 'The_Android_Invasion_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1260, ' The Brain of Morbius', 104, 'The_Brain_of_Morbius_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1261, ' The Seeds of Doom', 104, 'The_Seeds_of_Doom_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1262, ' The Masque of Mandragora', 105, 'The_Masque_of_Mandragora_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1263, ' The Hand of Fear', 105, 'The_Hand_of_Fear_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1264, ' The Deadly Assassin', 105, 'The_Deadly_Assassin_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1265, ' The Face of Evil', 105, 'The_Face_of_Evil_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1266, ' The Robots of Death', 105, 'The_Robots_of_Death_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1267, ' The Talons of Weng-Chiang', 105, 'The_Talons_of_Weng-Chiang_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1268, ' Horror of Fang Rock', 106, 'Horror_of_Fang_Rock_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1269, ' The Invisible Enemy', 106, 'The_Invisible_Enemy_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1270, ' Image of the Fendahl', 106, 'Image_of_the_Fendahl_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1271, ' The Sun Makers', 106, 'The_Sun_Makers_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1272, ' Underworld', 106, 'Underworld_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1273, ' The Invasion of Time', 106, 'The_Invasion_of_Time_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1274, ' The Ribos Operation', 107, 'The_Ribos_Operation_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1275, ' The Pirate Planet', 107, 'The_Pirate_Planet_(TV_Story)', '', 0, 1, '2000.0000', 1);
INSERT INTO `Topics` (`id`, `topic`, `parent_id`, `link`, `MagEditeren`, `Uitklapbaar`, `Actief`, `Episode_Order`, `T_Owner`) VALUES
(1276, ' The Stones of Blood', 107, 'The_Stones_of_Blood_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1277, ' The Androids of Tara', 107, 'The_Androids_of_Tara_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1278, ' The Power of Kroll', 107, 'The_Power_of_Kroll_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1279, ' The Armageddon Factor', 107, 'The_Armageddon_Factor_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1280, ' Destiny of the Daleks', 108, 'Destiny_of_the_Daleks_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1281, ' City of Death', 108, 'City_of_Death_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1282, ' The Creature from the Pit', 108, 'The_Creature_from_the_Pit_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1283, ' Nightmare of Eden', 108, 'Nightmare_of_Eden_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1284, ' The Horns of Nimon', 108, 'The_Horns_of_Nimon_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1285, ' Shada (Unaired)', 108, 'Shada_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1286, ' The Leisure Hive', 109, 'The_Leisure_Hive_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1287, ' Meglos', 109, 'Meglos_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1288, ' Full Circle', 109, 'Full_Circle_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1289, ' State of Decay', 109, 'State_of_Decay_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1290, ' Warriors&#39; Gate', 109, 'Warriors_Gate_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1291, ' The Keeper of Traken', 109, 'The_Keeper_of_Traken_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1292, ' Logopolis', 109, 'Logopolis_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1293, ' Castrovalva', 110, 'Castrovalva_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1294, ' Four to Doomsday', 110, 'Four_to_Doomsday_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1295, ' Kinda', 110, 'Kinda_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1296, ' The Visitation', 110, 'The_Visitation_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1297, ' Black Orchid', 110, 'Black_Orchid_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1298, ' Earthshock', 110, 'Earthshock_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1299, ' Time-Flight', 110, 'Time_Flight_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1300, ' Arc of Infinity', 111, 'Arc_of_Infinity_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1301, ' Snakedance', 111, 'Snakedance_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1302, ' Mawdryn Undead', 111, 'Mawdryn_Undead_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1303, ' Terminus', 111, 'Terminus_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1304, ' Enlightenment', 111, 'Enlightenment_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1305, ' The King&\"39;s Demons', 111, 'The_King_s_Demons_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1306, ' The Five Doctors', 111, 'The_Five_Doctors_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1307, ' Warriors of the Deep', 112, 'Warriors_of_the_Deep_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1308, ' The Awakening', 112, 'The_Awakening_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1309, ' Frontios', 112, 'Frontios_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1310, ' Resurrection of the Daleks', 112, 'Resurrection_of_the_Daleks_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1311, ' Planet of Fire', 112, 'Planet_of_Fire_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1312, ' The Caves of Androzani', 112, 'The_Caves_of_Androzani_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1313, ' The Twin Dilemma', 112, 'The_Twin_Dilemma_(TV_Story)', '', 0, 1, '7000.0000', 1),
(1314, ' Attack of the Cybermen', 113, 'Attack_of_the_Cybermen_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1315, ' Vengeance on Varos', 113, 'Vengeance_on_Varos_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1316, ' The Mark of the Rani', 113, 'The_Mark_of_the_Rani_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1317, ' The Two Doctors', 113, 'The_Two_Doctors_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1318, ' Timelash', 113, 'Timelash_(TV_Story)', '', 0, 1, '5000.0000', 1),
(1319, ' Revelation of the Daleks', 113, 'Revelation_of_the_Daleks_(TV_Story)', '', 0, 1, '6000.0000', 1),
(1320, ' The Mysterious Planet', 114, 'The_Mysterious_Planet_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1321, ' Mindwarp', 114, 'Mindwarp_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1322, ' Terror of the Vervoids', 114, 'Terror_of_the_Vervoids_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1323, ' The Ultimate Foe', 114, 'The_Ultimate_Foe_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1324, ' Time and the Rani', 115, 'Time_and_the_Rani_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1325, ' Paradise Towers', 115, 'Paradise_Towers_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1326, ' Delta and the Bannermen', 115, 'Delta_and_the_Bannermen_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1327, ' Dragonfire', 115, 'Dragonfire_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1328, ' Remembrance of the Daleks', 116, 'Remembrance_of_the_Daleks_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1329, ' The Happiness Patrol', 116, 'The_Happiness_Patrol_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1330, ' Silver Nemesis', 116, 'Silver_Nemesis_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1331, ' The Greatest Show in the Galaxy', 116, 'The_Greatest_Show_in_the_Galaxy_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1332, ' Battlefield', 117, 'Battlefield_(TV_Story)', '', 0, 1, '1000.0000', 1),
(1333, ' Ghost Light', 117, 'Ghost_Light_(TV_Story)', '', 0, 1, '2000.0000', 1),
(1334, ' The Curse of Fenric', 117, 'The_Curse_of_Fenric_(TV_Story)', '', 0, 1, '3000.0000', 1),
(1335, ' Survival', 117, 'Survival_(TV_Story)', '', 0, 1, '4000.0000', 1),
(1336, 'Temporal Places', 135, 'Temporal_Places', '', 1, 1, '0.0000', 1),
(1337, 'Axis', 1336, 'Axis', 'Nee', 0, 1, '0.0000', 1),
(1338, 'Cauterised time', 1336, 'Cauterised_time', 'Nee', 0, 1, '0.0000', 1),
(1339, 'Conceptual space', 1336, 'Conceptual_space', 'Nee', 0, 1, '0.0000', 1),
(1340, 'Time bubble', 1336, 'Time_Bubble', 'Nee', 0, 1, '0.0000', 1),
(1341, '1979-1989 10th Anniversary', 130, 'DWMSI_1979_1989_10th_Anniversary', 'Ja', 0, 1, '26.0000', 1),
(1342, 'Movie Special', 130, 'DWMSI_Movie_Special', 'Ja', 0, 1, '27.0000', 1),
(1343, 'Doctor Who Magazine: Special Edition', 173, 'Doctor_Who_Magazine_Special_Edition', 'Nee', 1, 1, '0.0000', 1),
(1344, 'Fifth Doctor', 1343, 'DWMSE_01', 'Ja', 0, 1, '1.0000', 1),
(1345, 'Third Doctor', 1343, 'DWMSE_02', 'Ja', 0, 1, '2.0000', 1),
(1346, 'Sixth Doctor', 1343, 'DWMSE_03', 'Ja', 0, 1, '3.0000', 1),
(1347, 'Second Doctor', 1343, 'DWMSE_04', 'Ja', 0, 1, '4.0000', 1),
(1348, 'Eighth Doctor', 1343, 'DWMSE_05', 'Ja', 0, 1, '5.0000', 1),
(1349, '40th Anniversary', 1343, 'DWMSE_06', 'Ja', 0, 1, '6.0000', 1),
(1350, 'First Doctor', 1343, 'DWMSE_07', 'Ja', 0, 1, '7.0000', 1),
(1351, 'Fourth Doctor: Volume 1', 1343, 'DWMSE_08', 'Ja', 0, 1, '8.0000', 1),
(1352, 'Additional Cast', 139, 'Additional_Cast', '0', 1, 1, '0.0000', 1),
(1353, 'Derek Newark', 1352, 'Derek_Newark', 'Nee', 0, 1, '0.0000', 1),
(1354, 'C. E. Webber', 181, 'C_E_Webber', '', 0, 1, '0.0000', 1),
(1355, 'Fourth Doctor: Volume 2', 1343, 'DWMSE_09', 'Ja', 0, 1, '9.0000', 1),
(1356, 'Seventh Doctor', 1343, 'DWMSE_10', 'Ja', 0, 1, '10.0000', 1),
(1357, 'Series One Companion', 1343, 'DWMSE_11', 'Ja', 0, 1, '11.0000', 1),
(1358, 'In Their Own Words: 1963-69', 1343, 'DWMSE_12', 'Ja', 0, 1, '12.0000', 1),
(1359, 'The Ninth Doctor Collected Comics', 1343, 'DWMSE_13', 'Ja', 0, 1, '13.0000', 1),
(1360, 'Series Two Companion', 1343, 'DWMSE_14', 'Ja', 0, 1, '14.0000', 1),
(1361, 'In Their Own Words: 1970-76', 1343, 'DWMSE_15', 'Ja', 0, 1, '15.0000', 1),
(1362, 'In Their Own Words 1977-81', 1343, 'DWMSE_16', 'Ja', 0, 1, '16.0000', 1),
(1363, 'Series Three Companion', 1343, 'DWMSE_17', 'Ja', 0, 1, '17.0000', 1),
(1364, 'Charles Wade', 1352, 'Charles_Wade', 'Nee', 0, 1, '0.0000', 1),
(1365, 'Summer 1991', 130, 'DWMSI_Summer_1991', 'Ja', 0, 1, '28.0000', 1),
(1366, 'Derren Nesbitt', 1352, 'Derren_Nesbitt', '0', 0, 1, '0.0000', 1),
(1367, 'Zienia Merton', 1352, 'Zienia_Merton', '0', 0, 1, '0.0000', 1),
(1368, 'Martin Miller', 1352, 'Martin_Miller', '0', 0, 1, '0.0000', 1),
(1369, 'Jimmy Gardner', 1352, 'Jimmy_Gardner', '0', 0, 1, '0.0000', 1),
(1370, 'Technology', 132, 'Technology', '', 1, 1, '0.0000', 1),
(1371, 'Issue 522', 308, 'Issue_522_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1372, 'Issue 523', 308, 'Issue_523_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1373, 'Issue 524', 308, 'Issue_524_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1374, 'Issue 525', 308, 'Issue_525_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1375, 'Composers', 140, 'Composers', '0', 1, 1, '0.0000', 1),
(1376, 'Norman Kay', 1375, 'Norman_Kay', '0', 0, 1, '0.0000', 1),
(1377, 'Tristram Cary', 1375, 'Tristram_Cary', '0', 0, 1, '0.0000', 1),
(1378, 'Alethea Charlton', 1352, 'Alethea_Charlton', 'Nee', 0, 1, '0.0000', 1),
(1379, 'Eileen Way', 1352, 'Eileen_Way', 'Nee', 0, 1, '0.0000', 1),
(1380, 'Alan Wheatley', 1352, 'Alan_Wheatley', 'Nee', 0, 1, '0.0000', 1),
(1381, 'Jeremy Young', 1352, 'Jeremy_Young', 'Nee', 0, 1, '0.0000', 1),
(1382, 'Howard Lang', 1352, 'Howard_Lang', 'Nee', 0, 1, '0.0000', 1),
(1383, 'John Lee', 1352, 'John_Lee', 'Nee', 0, 1, '0.0000', 1),
(1384, 'Virgina Wheterell', 1352, 'Virgina_Wheterell', 'Nee', 0, 1, '0.0000', 1),
(1385, 'Philip Bond', 1352, 'Philip_Bond', 'Nee', 0, 1, '0.0000', 1),
(1386, 'Marcus Hammond', 1352, 'Marcus_Hammond', 'Nee', 0, 1, '0.0000', 1),
(1387, 'Gerald Curtis', 1352, 'Gerald_Curtis', 'Nee', 0, 1, '0.0000', 1),
(1388, 'Jonathon Crane', 1352, 'Jonathon_Crane', 'Nee', 0, 1, '0.0000', 1),
(1389, 'Peter Hawkings', 1352, 'Peter_Hawkings', 'Nee', 0, 1, '0.0000', 1),
(1390, 'David Graham', 1352, 'David_Graham', 'Nee', 0, 1, '0.0000', 1),
(1391, 'Robert_Jewell', 1352, 'Robert_Jewell', 'Nee', 0, 1, '0.0000', 1),
(1392, 'Kevin Manser', 1352, 'Kevin_Manser', 'Nee', 0, 1, '0.0000', 1),
(1393, 'Michael Summerton', 1352, 'Michael_Summerton', 'Nee', 0, 1, '0.0000', 1),
(1394, 'Gerald Taylor', 1352, 'Gerald_Taylor', 'Nee', 0, 1, '0.0000', 1),
(1395, 'Chris Browning', 1352, 'Chris_Browning', 'Nee', 0, 1, '0.0000', 1),
(1396, 'Katie Cashfield', 1352, 'Katie_Cashfield', 'Nee', 0, 1, '0.0000', 1),
(1397, 'Vez Delahunt', 1352, 'Vez_Delahunt', 'Nee', 0, 1, '0.0000', 1),
(1398, 'Kevin Glenny', 1352, 'Kevin_Glenny', 'Nee', 0, 1, '0.0000', 1),
(1399, 'Ruth Harrison', 1352, 'Ruth_Harrison', 'Nee', 0, 1, '0.0000', 1),
(1400, 'Lesley Hill', 1352, 'Lesley_Hill', 'Nee', 0, 1, '0.0000', 1),
(1401, 'Steve Pokol', 1352, 'Steve_Pokol', 'Nee', 0, 1, '0.0000', 1),
(1402, 'Jeanette Rossini', 1352, 'Jeanette_Rossini', 'Nee', 0, 1, '0.0000', 1),
(1403, 'Eric Smith', 1352, 'Eric_Smith', 'Nee', 0, 1, '0.0000', 1),
(1404, 'Producers', 140, 'Producers', '0', 1, 1, '0.0000', 1),
(1405, 'Verity Lambert', 1404, 'Verity_Lambert', '0', 0, 1, '0.0000', 1),
(1406, 'Mark Eden', 1352, 'Mark_Eden', '', 0, 1, '0.0000', 1),
(1407, 'Villains', 3, 'Villains', 'Nee', 0, 1, '0.0000', 1),
(1409, 'Dalek Sec', 144, 'Dalek_Sec', '0', 0, 1, '0.0000', 1),
(1410, 'Issue 526', 308, 'Issue_526_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1411, 'Issue 527', 308, 'Issue_527_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1412, 'Issue 528', 308, 'Issue_528_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1413, 'TARDIS Console', 169, 'DIY_TARDIS_Console', 'Nee', 0, 1, '0.0000', 1),
(1414, 'Philip Voss', 1352, 'Philip_Voss', '', 0, 1, '0.0000', 1),
(1415, 'Gábor Baraker', 1352, 'Gabor_Baraker', '', 0, 1, '0.0000', 1),
(1416, 'Tutte Lemkow', 1352, 'Tutte_Lemkow', '', 0, 1, '0.0000', 1),
(1417, 'Claire Davenport', 1352, 'Claire_Davenport', '', 0, 1, '0.0000', 1),
(1418, 'Leslie Bates', 1352, 'Leslie_Bates', '', 0, 1, '0.0000', 1),
(1419, 'Michael Guest', 1352, 'Michael_Guest', '', 0, 1, '0.0000', 1),
(1420, 'Peter Lawrence', 1352, 'Peter_Lawrence', '', 0, 1, '0.0000', 1),
(1421, 'Basil Tang', 1352, 'Basil_Tang', '', 0, 1, '0.0000', 1),
(1422, 'George Coulouris', 1352, 'George_Coulouris', '', 0, 1, '0.0000', 1),
(1423, 'Martin Cort', 1352, 'Martin_Cort', '', 0, 1, '0.0000', 1),
(1424, 'Peter Stenson', 1352, 'Peter_Stenson', '', 0, 1, '0.0000', 1),
(1425, 'Gordon Wales', 1352, 'Gordon_Wales', '', 0, 1, '0.0000', 1),
(1426, 'Robin Phillips', 1352, 'Robin_Phillips', '', 0, 1, '0.0000', 1),
(1427, 'Katharine Schofield', 1352, 'Katharine_Schofield', '', 0, 1, '0.0000', 1),
(1428, 'Heron Carvic', 1352, 'Heron_Carvic', '', 0, 1, '0.0000', 1),
(1429, 'Edmund Warwick', 1352, 'Edmund_Warwick', '', 0, 1, '0.0000', 1),
(1430, 'Francis de Wolff', 1352, 'Francis_de_Wolff', '', 0, 1, '0.0000', 1),
(1431, 'Michael Allaby', 1352, 'Michael_Allaby', '', 0, 1, '0.0000', 1),
(1432, 'Alan James', 1352, 'Alan_James', '', 0, 1, '0.0000', 1),
(1433, 'Anthony Verner', 1352, 'Anthony_Verner', '', 0, 1, '0.0000', 1),
(1434, 'Henley Thomas', 1352, 'Henley_Thomas', '', 0, 1, '0.0000', 1),
(1435, 'Raf De La Torre', 1352, 'Raf_De_La_Torre', '', 0, 1, '0.0000', 1),
(1436, 'Fiona Walker', 1352, 'Fiona_Walker', '', 0, 1, '0.0000', 1),
(1437, 'Donald Pickering', 1352, 'Donald_Pickering', '', 0, 1, '0.0000', 1),
(1438, 'Stephen Dartnell', 1352, 'Stephen_Dartnell', '', 0, 1, '0.0000', 1),
(1439, 'Dougie Dean', 1352, 'Dougie_Dean', '', 0, 1, '0.0000', 1),
(1440, 'Keith Pyott', 1352, 'Keith_Pyott', '', 0, 1, '0.0000', 1),
(1441, 'John Ringham', 1352, 'John_Ringham', '', 0, 1, '0.0000', 1),
(1442, 'Ian Cullen', 1352, 'Ian_Cullen', '', 0, 1, '0.0000', 1),
(1443, 'Margot Van der Burgh', 1352, 'Margot_Van_der_Burgh', '', 0, 1, '0.0000', 1),
(1444, 'Tom Booth', 1352, 'Tom_Booth', '', 0, 1, '0.0000', 1),
(1445, 'David Anderson', 1352, 'David_Anderson', '', 0, 1, '0.0000', 1),
(1446, 'Walter Randall', 1352, 'Walter_Randall', '', 0, 1, '0.0000', 1),
(1447, 'Andre Boulay', 1352, 'Andre_Boulay', '', 0, 1, '0.0000', 1),
(1448, 'Richard Rodney Bennett', 1375, 'Richard_Rodney_Bennett', '', 0, 1, '0.0000', 1),
(1449, 'Ilona Rogers', 1352, 'Ilona_Rogers', '', 0, 1, '0.0000', 1),
(1450, 'Lorne Cosette', 1352, 'Lorne_Cosette', '', 0, 1, '0.0000', 1),
(1451, 'John Bailey', 1352, 'John_Bailey', '', 0, 1, '0.0000', 1),
(1452, 'Martyn Huntley', 1352, 'Martyn_Huntley', '', 0, 1, '0.0000', 1),
(1453, 'Giles Phibbs', 1352, 'Giles_Phibbs', '', 0, 1, '0.0000', 1),
(1454, 'Ken Tyllsen', 1352, 'Ken_Tyllsen', '', 0, 1, '0.0000', 1),
(1455, 'Joe Greig', 1352, 'Joe_Greig', '', 0, 1, '0.0000', 1),
(1456, 'Peter Glaze', 1352, 'Peter_Glaze', '', 0, 1, '0.0000', 1),
(1457, 'Arthur Newall', 1352, 'Arthur_Newall', '', 0, 1, '0.0000', 1),
(1458, 'Eric Francis', 1352, 'Eric_Francis', '', 0, 1, '0.0000', 1),
(1459, 'Bartlett Mullins', 1352, 'Bartlett_Mullins', '', 0, 1, '0.0000', 1),
(1460, 'Anthony Rogers', 1352, 'Anthony_Rogers', '', 0, 1, '0.0000', 1),
(1461, 'Gerry Martin', 1352, 'Gerry_Martin', '', 0, 1, '0.0000', 1),
(1462, 'Fourth Doctor Adventures', 1032, 'Fourth_Doctor_Adventures', 'Nee', 1, 1, '0.0000', 1),
(1463, 'Destination: Nerva', 1462, 'Destination_Nerva', 'Nee', 0, 1, '0.0000', 1),
(1464, 'Series 11', 25, 'Series_11_(New_Who)', '0', 1, 1, '11.0000', 1),
(1465, ' The Woman Who Fell to Earth', 1464, 'The_Woman_Who_Fell_to_Earth_(TV_Story)', '0', 0, 1, '1000.0000', 1),
(1466, ' The Ghost Monument', 1464, 'The_Ghost_Monument_(TV_Story)', '0', 0, 1, '2000.0000', 1),
(1467, 'Jackie Tyler', 1578, 'Jackie_Tyler', '0', 0, 1, '0.0000', 1),
(1468, 'Camille Coduri', 141, 'Camille_Coduri', '0', 0, 1, '0.0000', 1),
(1469, ' Rosa', 1464, 'Rosa_(TV_Story)', '0', 0, 1, '3000.0000', 1),
(1470, 'Yasmin Khan', 1578, 'Yasmin_Khan', '0', 0, 1, '0.0000', 1),
(1471, 'Ryan Sinclair', 1578, 'Ryan_Sinclair', '0', 0, 1, '0.0000', 1),
(1472, 'Graham O\' Brien', 1578, 'Graham_O_Brien', '0', 0, 1, '0.0000', 1),
(1473, ' Arachnids in the UK', 1464, 'Arachnids_in_the_UK_(TV_Story)', '0', 0, 1, '4000.0000', 1),
(1474, ' The Tsuranga Conundrum', 1464, 'The_Tsuranga_Conundrum_(TV_Story)', '0', 0, 1, '5000.0000', 1),
(1475, ' Demons of the Punjab', 1464, 'Demons_of_the_Punjab_(TV_Story)', '0', 0, 1, '6000.0000', 1),
(1476, ' Kerblam!', 1464, 'Kerblam_(TV_Story)', '0', 0, 1, '7000.0000', 1),
(1477, ' The Witchfinders', 1464, 'The_Witchfinders_(TV_Story)', '0', 0, 1, '8000.0000', 1),
(1478, 'Keith Anderson', 1352, 'Keith_Anderson', '', 0, 1, '0.0000', 1),
(1479, 'Tony Wall', 1352, 'Tony_Wall', '', 0, 1, '0.0000', 1),
(1480, 'Jack_Cunningham', 1352, 'Jack_Cunningham', '', 0, 1, '0.0000', 1),
(1481, 'Jeffry Wickham', 1352, 'Jeffry_Wickham', '', 0, 1, '0.0000', 1),
(1482, 'Neville Smith', 1352, 'Neville_Smith', '', 0, 1, '0.0000', 1),
(1483, 'Laidlaw Dalling', 1352, 'Laidlaw_Dalling', '', 0, 1, '0.0000', 1),
(1484, 'Peter Walker', 1352, 'Peter_Walker', '', 0, 1, '0.0000', 1),
(1485, 'James Cairncross', 1352, 'James_Cairncross', '', 0, 1, '0.0000', 1),
(1486, 'Roy Herrick', 1352, 'Roy_Herrick', '', 0, 1, '0.0000', 1),
(1487, 'Donald Morley', 1352, 'Donald_Morley', '', 0, 1, '0.0000', 1),
(1488, 'Caroline Hunt', 1352, 'Caroline_Hunt', '', 0, 1, '0.0000', 1),
(1489, 'Edward Brayshaw', 1352, 'Edward_Brayshaw', '', 0, 1, '0.0000', 1),
(1490, 'John Law', 1352, 'John_Law', '', 0, 1, '0.0000', 1),
(1491, 'Dallas Cavell', 1352, 'Dallas_Cavell', '', 0, 1, '0.0000', 1),
(1492, 'Dennis Cleary', 1352, 'Dennis_Cleary', '', 0, 1, '0.0000', 1),
(1493, 'John Barrard', 1352, 'John_Barrard', '', 0, 1, '0.0000', 1),
(1494, 'Ronald Pickup', 1352, 'Ronald_Pickup', '', 0, 1, '0.0000', 1),
(1495, 'Howard Charlton', 1352, 'Howard_Charlton', '', 0, 1, '0.0000', 1),
(1496, 'Robert Hunter', 1352, 'Robert_Hunter', '', 0, 1, '0.0000', 1),
(1497, 'Ken Lawrence', 1352, 'Ken_Lawrence', '', 0, 1, '0.0000', 1),
(1498, 'James Hall', 1352, 'James_Hall', '', 0, 1, '0.0000', 1),
(1499, 'Patrick Marley', 1352, 'Patrick_Marley', '', 0, 1, '0.0000', 1),
(1500, 'Terry Bale', 1352, 'Terry_Bale', '', 0, 1, '0.0000', 1),
(1501, 'Stanley Meyers', 1375, 'Stanley_Meyers', '', 0, 1, '0.0000', 1),
(1502, 'Bradley Walsh', 141, 'Bradley_Walsh', '', 0, 1, '0.0000', 1),
(1503, 'Tosin Cole', 141, 'Tosin_Cole', '', 0, 1, '0.0000', 1),
(1504, 'Mandip Gill', 141, 'Mandip_Gill', '', 0, 1, '0.0000', 1),
(1505, 'Jamie Childs', 788, 'Jamie_Childs', '', 0, 1, '0.0000', 1),
(1506, 'Nina Métivier', 181, 'Nina_Metivier', '', 0, 1, '0.0000', 1),
(1507, ' It Takes You Away', 1464, 'It_Takes_You_Away_(TV_Story)', '0', 0, 1, '9000.0000', 1),
(1508, ' The Battle of Ranskoor Av Kolos', 1464, 'The_Battle_of_Ranskoor_Av_Kolos_(TV_Story)', '0', 0, 1, '10000.0000', 1),
(1509, 'Issue 529', 308, 'Issue_529_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1510, 'Issue 530', 308, 'Issue_530_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1511, 'Issue 531', 308, 'Issue_531_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1512, 'Issue 532', 308, 'Issue_532_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1513, 'Jenny Flint', 1578, 'Jenny_Flint', '0', 0, 1, '0.0000', 1),
(1514, 'Madame Vastra', 256, 'Madame_Vastra', '0', 0, 1, '0.0000', 1),
(1515, 'Princess Astra', 1584, 'Princess_Astra', '0', 0, 1, '0.0000', 1),
(1516, 'Issue 533', 308, 'Issue_533_(Doctor_Who_Magazine)', '', 0, 1, '0.0000', 1),
(1517, 'Fiction', 157, 'Fiction', '', 1, 1, '0.0000', 1),
(1518, 'Frederick Muller Ltd', 1517, 'Frederick_Muller_Ltd', '', 0, 1, '0.0000', 1),
(1519, 'Target', 1517, 'Target', '', 1, 1, '0.0000', 1),
(1520, ' Book 001: Doctor Who and the Abominable Snowmen', 1519, 'Doctor_Who_and_the_Abominable_Snowmen_(Book)', '', 0, 1, '0.0000', 1),
(1521, ' Book 016: Doctor Who and the Daleks', 1519, 'Doctor_Who_and_the_Daleks_(Book)', '', 0, 1, '0.0000', 1),
(1522, ' Book 073: Doctor Who and the Zarbi', 1519, 'Doctor_Who_and_the_Zarbi_(Book)', '', 0, 1, '0.0000', 1),
(1523, 'Earth', 135, 'Earth', 'Nee', 1, 1, '0.0000', 1),
(1524, 'Sheffield', 1569, 'Sheffield', '0', 0, 1, '0.0000', 1),
(1525, 'London', 1569, 'London', '0', 0, 1, '0.0000', 1),
(1526, 'Adipose', 148, 'Adipose', '0', 0, 1, '0.0000', 1),
(1527, 'Main Range (1999-)', 1032, 'Main_Range', '0', 1, 1, '0.0000', 1),
(1528, ' Resolution', 1464, 'Resolution_(TV_Story)', '0', 0, 1, '11000.0000', 1),
(1529, '001: Sirens of Time', 1527, 'Sirens_of_Time', '0', 0, 1, '0.0000', 1),
(1530, '002: Phantasmagoria', 1527, 'Phantasmagoria', '0', 0, 1, '0.0000', 1),
(1531, '003: Whispers of Terror', 1527, 'Whispers_of_Terror', '0', 0, 1, '0.0000', 1),
(1532, '004: The Land of the Dead', 1527, 'The_Land_of_the_Dead', '0', 0, 1, '0.0000', 1),
(1533, '005: The Fearmonger', 1527, 'The_Fearmonger', '0', 0, 1, '0.0000', 1),
(1534, 'Issue 534', 308, 'Issue_534_(Doctor_Who_Magazine)', '0', 0, 1, '0.0000', 1),
(1535, 'The Tenth Doctor Collected Comics', 1343, 'DWMSE_19', '0', 0, 0, '19.0000', 1),
(1536, 'Series Four Companion', 1343, 'DWMSE_20', '0', 0, 1, '20.0000', 1),
(1537, 'Series 1 (2007)', 90, 'Series_1_The_Sarah_Jane_Adventures', '0', 0, 1, '0.0000', 1),
(1538, 'Series 2 (2008)', 90, 'Series_2_The_Sarah_Jane_Adventures', '0', 0, 1, '0.0000', 1),
(1539, 'Series 3 (2009)', 90, 'Series_3_The_Sarah_Jane_Adventures', '0', 0, 1, '0.0000', 1),
(1540, 'Series 4 (2010)', 90, 'Series_4_The_Sarah_Jane_Adventures', '0', 0, 1, '0.0000', 1),
(1541, 'Series 5 (2011)', 90, 'Series_5_The_Sarah_Jane_Adventures', '0', 0, 1, '0.0000', 1),
(1542, 'Series 1 (2006-2007)', 88, 'Series_1_Torchwood', '0', 0, 1, '0.0000', 1),
(1543, 'Series 2 (2008)', 88, 'Series_2_Torchwood', '0', 0, 1, '0.0000', 1),
(1544, 'Series 3 (2009)', 88, 'Series_3_Torchwood', '0', 0, 1, '0.0000', 1),
(1545, 'Series 4 (2011)', 88, 'Series_4_Torchwood', '0', 0, 1, '0.0000', 1),
(1546, 'Pinball', 161, 'Pinball', '0', 0, 1, '0.0000', 1),
(1547, 'Videogames', 161, 'Videogames', '0', 1, 1, '0.0000', 1),
(1548, 'Richard Hurndall', 141, 'Richard_Hurndall', '0', 0, 1, '0.0000', 1),
(1549, 'David Bradley', 141, 'David_Bradley', '0', 0, 1, '0.0000', 1),
(1550, 'Issue 535', 308, 'Issue_535_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1551, 'Issue 536', 308, 'Issue_536_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1552, 'Issue 537', 308, 'Issue_537_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1553, 'Issue 538', 308, 'Issue_538_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1554, 'Issue 539', 308, 'Issue_539_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1555, 'Issue 540', 308, 'Issue_540_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1556, 'Issue 541', 308, 'Issue_541_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1557, 'Issue 542', 308, 'Issue_542_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1558, 'Issue 543', 308, 'Issue_543_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1559, 'Issue 544', 308, 'Issue_544_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1560, 'Series 12', 25, 'Series_12_(New_Who)', '0', 1, 1, '12.0000', 1),
(1561, 'Spyfall', 1560, 'Spyfall_(TV_Story)', 'Nee', 0, 1, '0.0000', 1),
(1562, 'Orphan 55', 1560, 'Orphan_55_(TV_Story)', 'Nee', 0, 1, '2000.0000', 1),
(1563, 'Nikola Tesla’s Night of Terror', 1560, 'Nikola_Tesla_s_Night_of_Terror_(TV_Story)', 'Nee', 0, 1, '3000.0000', 1),
(1564, 'Dudley Simpson', 1375, 'Dudley_Simpson', '', 0, 1, '0.0000', 1),
(1565, 'Fugitive of the Judoon', 1560, 'Fugitive_of_the_Judoon_(TV_Story)', 'Nee', 0, 1, '4000.0000', 1),
(1566, 'Richard E. Grant', 141, 'Richard_E_Grant', '', 0, 1, '0.0000', 1),
(1567, 'Praxeus', 1560, 'Praxeus_(TV_Story)', 'Nee', 0, 1, '5000.0000', 1),
(1569, 'United Kingdom', 1523, 'United_Kingdom', '0', 1, 1, '0.0000', 1),
(1570, 'Can you hear me?', 1560, 'Can_You_Hear_Me_(TV_Story)', 'Nee', 0, 1, '6000.0000', 1),
(1571, 'The Haunting of Villa Diodati', 1560, 'The_Haunting_of_Villa_Diodati_(TV_Story)', 'Nee', 0, 1, '7000.0000', 1),
(1572, 'The Ascension of the Cybermen', 1560, 'The_Ascension_of_the_Cybermen_(TV_Story)', 'Nee', 0, 1, '8000.0000', 1),
(1573, 'The Timeless Children', 1560, 'The_Timeless_Children_(TV_Story)', 'Nee', 0, 1, '9000.0000', 1),
(1574, 'Questions', 2, 'Questions', '0', 1, 1, '0.0000', 1),
(1575, 'How long to watch all of Doctor Who', 1574, 'How_long_to_watch_all_of_Doctor_Who', '0', 0, 1, '0.0000', 1),
(1576, 'How long to watch a specific series of Doctor Who', 1574, 'How_long_to_watch_a_specific_series_of_Doctor_Who', '0', 0, 1, '0.0000', 1),
(1577, 'Months', 136, 'Months', '', 0, 1, '0.0000', 1),
(1578, 'Humans', 148, 'Humans', '0', 1, 1, '0.0000', 1),
(1579, 'Alzarian', 148, 'Alzarian', 'Nee', 1, 1, '0.0000', 1),
(1580, 'Trakenite', 148, 'Trakenite', 'Nee', 1, 1, '0.0000', 1),
(1581, 'Robots', 1370, 'Robots', 'Nee', 1, 1, '0.0000', 1),
(1582, 'Trion (Species)', 148, 'Trion_(Species)', 'Nee', 1, 1, '0.0000', 1),
(1583, 'Kamelion (Species)', 148, 'Kamelion_(Species)', 'Nee', 1, 1, '0.0000', 1),
(1584, 'Atrion', 148, 'Atrion', 'Nee', 1, 1, '0.0000', 1),
(1586, 'Cybercontroller', 145, 'Cybercontroller', 'Nee', 0, 1, '0.0000', 1),
(1587, 'Doctor Who: The Eternity Clock', 1547, 'The_Eternity_Clock_(Videogame)', 'Nee', 0, 1, '0.0000', 1),
(1588, 'TV', 155, 'TV', '', 1, 1, '0.0000', 1),
(1589, 'Docudrama', 1588, 'Docudrama', '', 1, 1, '0.0000', 1),
(1590, 'An Adventure in Space and Time', 1589, 'An_Adventure_in_Space_and_Time_(TV_Special)', '', 0, 1, '0.0000', 1),
(1591, 'Animus', 150, 'Animus', '0', 0, 1, '0.0000', 1),
(1592, 'Dæmons', 148, 'Dæmons', '0', 1, 1, '0.0000', 1),
(1593, 'Issue 545', 308, 'Issue_545_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1594, 'Issue 546', 308, 'Issue_546_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1595, 'Issue 547', 308, 'Issue_547_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1596, 'Issue 548', 308, 'Issue_548_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1597, 'Issue 549', 308, 'Issue_549_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1598, 'Issue 550', 308, 'Issue_550_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1599, 'Issue 551', 308, 'Issue_551_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1600, 'Issue 552', 308, 'Issue_552_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1601, 'Humanoids', 148, 'Humanoids', '0', 1, 1, '0.0000', 1),
(1602, 'Series 4 Specials (2008-2010)', 25, 'Series_4_Specials_(New_Who)', '0', 1, 1, '4.5000', 1),
(1603, 'Series 7 Specials (2013)', 25, 'Series_7_Specials_(New_Who)', '0', 1, 1, '7.5000', 1),
(1604, 'What is the timeline from the Doctor\'s viewpoint?', 1574, 'What_Is_The_Timeline_From_The_Doctor_s_Viewpoint', '0', 0, 1, '0.0000', 1),
(1606, 'Issue 553', 308, 'Issue_553_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1607, 'Issue 554', 308, 'Issue_554_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1608, 'Issue 555', 308, 'Issue_555_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1),
(1609, 'Issue 556', 308, 'Issue_556_(Doctor_Who_Magazine)', 'Nee', 0, 1, '0.0000', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Topics__history`
--

CREATE TABLE `Topics__history` (
  `history__id` int(11) NOT NULL,
  `history__language` varchar(2) DEFAULT NULL,
  `history__comments` text DEFAULT NULL,
  `history__user` varchar(32) DEFAULT NULL,
  `history__state` int(5) DEFAULT 0,
  `history__modified` datetime DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `topic` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `MagEditeren` varchar(20) DEFAULT NULL,
  `Uitklapbaar` int(2) DEFAULT NULL,
  `Actief` int(2) DEFAULT NULL,
  `Episode_Order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Topics__history`
--

INSERT INTO `Topics__history` (`history__id`, `history__language`, `history__comments`, `history__user`, `history__state`, `history__modified`, `id`, `topic`, `parent_id`, `link`, `MagEditeren`, `Uitklapbaar`, `Actief`, `Episode_Order`) VALUES
(1, 'en', '', 'Ruben', 0, '2019-10-04 16:27:06', 1, 'doctorwhofans.be', 1, 'Home', '0', 0, 1, NULL),
(2, 'en', '', 'Ruben', 0, '2019-10-04 16:28:15', 1, 'doctorwhofans.be', 0, 'Home', '0', 0, 1, NULL),
(3, 'en', '', 'Ruben', 0, '2019-10-04 16:49:53', 1550, 'Issue 535', 308, 'Doctor_Who_Magazine_Issue_535', 'Nee', 0, 1, NULL),
(4, 'en', '', 'Ruben', 0, '2019-10-06 17:31:13', 1535, 'Issue 535', 310, 'Doctor_Who_Magazine_Issue_535', '0', 0, 0, NULL),
(5, 'en', '', 'Ruben', 0, '2019-10-06 17:31:54', 310, 'Issue 107 ', 308, 'Doctor_Who_Magazine_Issue_107', '', 0, 1, NULL),
(6, 'en', '', 'Ruben', 0, '2019-10-06 17:46:35', 1535, '19 The Tenth Doctor Collected Comics', 1343, 'DWMSE_19', '0', 0, 0, NULL),
(7, 'en', '', 'Ruben', 0, '2019-10-06 17:48:46', 1536, '20 Series Four Companion', 1343, 'DWMSE_20', '0', 0, 1, NULL),
(8, 'en', '', 'Ruben', 0, '2019-10-06 17:50:42', 146, 'Sontarans', 148, 'Sontarans', '', 0, 1, NULL),
(9, 'en', '', 'Ruben', 0, '2019-10-06 17:54:51', 307, 'Issue 106', 299, 'The_Doctor_Who_Magazine_Issue_106', '', 0, 1, NULL),
(10, 'en', '', 'Ruben', 0, '2019-10-13 08:55:22', 41, 'Alistair Gordon Lethbridge-Stewart', 19, 'Alistair_Gordon_LethBridge_Stewart', '0', 0, 1, NULL),
(11, 'nl', '', 'Ruben', 0, '2019-11-07 19:00:01', 1559, 'Issue 544', 308, 'Doctor_Who_Magazine_Issue_544', 'Nee', 0, 1, NULL),
(12, 'nl', '', 'Ruben', 0, '2020-01-03 02:51:08', 1561, 'E 01: Spyfall', 1560, 'Spyfall', 'Nee', 0, 1, NULL),
(13, 'nl', '', 'Ruben', 0, '2020-01-03 03:01:27', 1561, 'E 01 - 02: Spyfall', 1560, 'Spyfall', 'Nee', 0, 1, NULL),
(14, 'nl', '', 'Ruben', 0, '2020-01-19 11:15:41', 1563, 'E 04: Nikola Tesla’s Night of Terror', 1560, 'Nikola_Tesla_s_Night_of_Terror ', 'Nee', 0, 1, NULL),
(15, 'nl', '', 'Ruben', 0, '2020-01-23 23:28:00', 1565, 'E 05: Fugitive of the Judoon', 1560, 'Fugitive_of_the_Judoon', 'Nee', 0, 0, NULL),
(16, 'nl', '', 'Ruben', 0, '2020-01-23 23:28:08', 1565, 'E 05: Fugitive of the Judoon', 1560, 'Fugitive_of_the_Judoon', 'Nee', 0, 1, NULL),
(17, 'nl', '', 'Ruben', 0, '2020-01-26 00:12:13', 7, 'Third Doctor', 4, 'Third_Doctor', '0', 0, 1, NULL),
(18, 'nl', '', 'Ruben', 0, '2020-01-26 00:15:10', 6, 'Second Doctor', 4, 'Second_Doctor', '0', 0, 1, NULL),
(19, 'nl', '', 'Ruben', 0, '2020-01-26 00:32:39', 5, 'First Doctor', 4, 'First_Doctor', '0', 0, 1, NULL),
(20, 'nl', '', 'Ruben', 0, '2020-01-26 00:33:50', 6, 'Second Doctor', 4, 'Second_Doctor', '0', 0, 1, NULL),
(21, 'nl', '', 'Ruben', 0, '2020-01-26 00:34:11', 8, 'Fourth Doctor', 4, 'Fourth_Doctor', '0', 0, 1, NULL),
(22, 'nl', '', 'Ruben', 0, '2020-01-26 00:35:00', 9, 'Fifth Doctor', 4, 'Fifth_Doctor', '0', 0, 1, NULL),
(23, 'nl', '', 'Ruben', 0, '2020-01-26 00:41:01', 10, 'Sixth Doctor', 4, 'Sixth_Doctor', '0', 0, 1, NULL),
(24, 'nl', '', 'Ruben', 0, '2020-01-26 00:41:19', 11, 'Seventh Doctor', 4, 'Seventh_Doctor', '0', 0, 1, NULL),
(25, 'nl', '', 'Ruben', 0, '2020-01-26 12:57:21', 1563, 'E 04: Nikola Tesla’s Night of Terror', 1560, 'Nikola_Tesla_s_Night_of_Terror', 'Nee', 0, 1, NULL),
(26, 'nl', '', 'Ruben', 0, '2020-01-26 22:07:02', 1566, 'Richard E. Grant', 141, 'Richard_E_Grant', '', 0, 1, NULL),
(27, 'nl', '', 'Ruben', 0, '2020-01-26 22:08:50', 1565, 'E 05: Fugitive of the Judoon', 1560, 'Fugitive_of_the_Judoon', 'Nee', 0, 1, NULL),
(28, 'nl', '', 'Ruben', 0, '2020-01-26 22:09:04', 1565, 'E 05: Fugitive of the Judoon', 1560, 'Fugitive_of_the_Judoon', 'Nee', 0, 1, NULL),
(29, 'nl', '', 'Ruben', 0, '2020-01-30 22:31:32', 12, 'Eighth Doctor', 4, 'Eighth_Doctor', '0', 0, 1, NULL),
(30, 'nl', '', 'Ruben', 0, '2020-01-30 22:32:01', 13, 'War Doctor', 4, 'War_Doctor', '0', 0, 1, NULL),
(31, 'nl', '', 'Ruben', 0, '2020-01-30 22:32:11', 14, 'Ninth Doctor', 4, 'Ninth_Doctor', '0', 0, 1, NULL),
(32, 'nl', '', 'Ruben', 0, '2020-01-30 22:32:22', 15, 'Tenth Doctor', 4, 'Tenth_Doctor', '0', 0, 1, NULL),
(33, 'nl', '', 'Ruben', 0, '2020-01-30 22:32:30', 16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, NULL),
(34, 'nl', '', 'Ruben', 0, '2020-01-30 22:32:39', 17, 'Twelfth Doctor', 4, 'Twelfth_Doctor', '0', 0, 1, NULL),
(35, 'nl', '', 'Ruben', 0, '2020-01-30 22:32:47', 18, 'Thirtheenth Doctor', 4, 'Thirteenth_Doctor', '0', 0, 1, NULL),
(36, 'nl', '', 'Ruben', 0, '2020-01-30 22:33:08', 21, 'Peter Cushing Doctor', 20, 'Peter_Cushing_Doctor', '0', 0, 1, NULL),
(37, 'nl', '', 'Ruben', 0, '2020-01-30 22:33:15', 21, 'Peter Cushing Doctor', 20, 'Peter_Cushing_Doctor', '0', 0, 1, NULL),
(38, 'nl', '', 'Ruben', 0, '2020-01-30 22:33:21', 21, 'Peter Cushing Doctor', 20, 'Peter_Cushing_Doctor', '0', 0, 1, NULL),
(39, 'nl', '', 'Ruben', 0, '2020-01-30 22:33:42', 22, 'Scream of the Shalka Doctor', 20, 'Scream_of_the_Shalka_Doctor', 'Ja', 0, 1, NULL),
(40, 'nl', '', 'Ruben', 0, '2020-01-30 22:34:45', 26, 'Susan Foreman', 19, 'Susan_Foreman', '0', 0, 1, NULL),
(41, 'nl', '', 'Ruben', 0, '2020-02-02 20:38:42', 1567, 'Praxeus', 1560, 'Praxeus', 'Nee', 0, 1, NULL),
(42, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:05', 5, 'First Doctor', 4, 'First_Doctor', '0', 0, 1, 1),
(43, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:13', 6, 'Second Doctor', 4, 'Second_Doctor', '0', 0, 1, 2),
(44, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:19', 7, 'Third Doctor', 4, 'Third_Doctor', '0', 0, 1, 3),
(45, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:22', 7, 'Third Doctor', 4, 'Third_Doctor', '0', 0, 1, 4),
(46, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:37', 8, 'Fourth Doctor', 4, 'Fourth_Doctor', '0', 0, 1, 4),
(47, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:45', 9, 'Fifth Doctor', 4, 'Fifth_Doctor', '0', 0, 1, 5),
(48, 'nl', '', 'Ruben', 0, '2020-02-02 20:56:52', 10, 'Sixth Doctor', 4, 'Sixth_Doctor', '0', 0, 1, 6),
(49, 'nl', '', 'Ruben', 0, '2020-02-02 20:58:47', 11, 'Seventh Doctor', 4, 'Seventh_Doctor', '0', 0, 1, 7000),
(50, 'nl', '', 'Ruben', 0, '2020-02-02 20:58:54', 12, 'Eighth Doctor', 4, 'Eighth_Doctor', '0', 0, 1, 8000),
(51, 'nl', '', 'Ruben', 0, '2020-02-02 20:59:01', 13, 'War Doctor', 4, 'War_Doctor', '0', 0, 1, 9000),
(52, 'nl', '', 'Ruben', 0, '2020-02-02 20:59:11', 14, 'Ninth Doctor', 4, 'Ninth_Doctor', '0', 0, 1, 10000),
(53, 'nl', '', 'Ruben', 0, '2020-02-02 20:59:54', 15, 'Tenth Doctor', 4, 'Tenth_Doctor', '0', 0, 1, 11000),
(54, 'nl', '', 'Ruben', 0, '2020-02-02 21:00:26', 16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, 120000),
(55, 'nl', '', 'Ruben', 0, '2020-02-02 21:00:29', 16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, 120000),
(56, 'nl', '', 'Ruben', 0, '2020-02-02 21:00:33', 16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, 12000),
(57, 'nl', '', 'Ruben', 0, '2020-02-02 21:00:41', 17, 'Twelfth Doctor', 4, 'Twelfth_Doctor', '0', 0, 1, 13000),
(58, 'nl', '', 'Ruben', 0, '2020-02-02 21:01:08', 18, 'Thirtheenth Doctor', 4, 'Thirteenth_Doctor', '0', 0, 1, 14000),
(59, 'nl', '', 'Ruben', 0, '2020-02-02 21:01:21', 20, 'Other Doctors', 4, 'Other_Doctors', 'Nee', 1, 1, 100000000),
(60, 'nl', '', 'Ruben', 0, '2020-02-02 21:02:06', 7, 'Third Doctor', 4, 'Third_Doctor', '0', 0, 1, 3000),
(61, 'nl', '', 'Ruben', 0, '2020-02-03 00:52:20', 25, 'New', 28, 'New', '0', 1, 1, 1000),
(62, 'nl', '', 'Ruben', 0, '2020-02-03 00:52:34', 85, 'Spin off', 28, 'Spin_off', '0', 1, 1, 2000),
(63, 'nl', '', 'Ruben', 0, '2020-02-03 00:52:45', 257, 'Unmade Serials', 28, 'Unmade_Serials', '0', 0, 1, 3000),
(64, 'nl', '', 'Ruben', 0, '2020-02-03 00:56:01', 1561, 'Spyfall', 1560, 'Spyfall', 'Nee', 0, 1, 0),
(65, 'nl', '', 'Ruben', 0, '2020-02-03 00:56:57', 1561, 'Spyfall: part 1', 1560, 'Spyfall_part_1', 'Nee', 0, 1, 0),
(66, 'nl', '', 'Ruben', 0, '2020-02-03 00:57:28', 1568, 'Spyfall: part 2', 1560, 'Spyfall_part_2', 'Nee', 0, 1, 1000),
(67, 'nl', '', 'Ruben', 0, '2020-02-03 00:59:34', 1562, 'Orphan 55', 1560, 'Orphan_55', 'Nee', 0, 1, 2000),
(68, 'nl', '', 'Ruben', 0, '2020-02-03 00:59:49', 1563, 'Nikola Tesla’s Night of Terror', 1560, 'Nikola_Tesla_s_Night_of_Terror', 'Nee', 0, 1, 3000),
(69, 'nl', '', 'Ruben', 0, '2020-02-03 01:00:14', 1565, 'Fugitive of the Judoon', 1560, 'Fugitive_of_the_Judoon', 'Nee', 0, 1, 4000),
(70, 'nl', '', 'Ruben', 0, '2020-02-03 01:00:31', 1567, 'Praxeus', 1560, 'Praxeus', 'Nee', 0, 1, 5000),
(71, 'nl', '', 'Ruben', 0, '2020-02-03 01:01:48', 1563, 'Nikola Tesla’s Night of Terror', 1560, 'Nikola_Tesla_s_Night_of_Terror', 'Nee', 0, 1, 3000),
(72, 'nl', '', 'Ruben', 0, '2020-02-03 01:02:36', 1563, 'Nikola Tesla’s Night of Terror', 1560, 'Nikola_Tesla_s_Night_of_Terror', 'Nee', 0, 1, 3000),
(73, 'nl', '', 'Ruben', 0, '2020-02-14 23:31:09', 1001, 'An Unearthly Child/100,000 BC', 80, 'An_Unearthly_Child', '', 0, 1, 1000),
(74, 'nl', '', 'Ruben', 0, '2020-02-14 23:31:23', 1178, 'The Daleks', 80, 'The_Daleks', '', 0, 1, 2000),
(75, 'nl', '', 'Ruben', 0, '2020-02-14 23:31:49', 1179, 'The Edge of Destruction', 80, 'The_Edge_Of_Destruction', '', 0, 1, 3000),
(76, 'nl', '', 'Ruben', 0, '2020-02-14 23:32:01', 1180, 'Marco Polo', 80, 'Marco_Polo', '', 0, 1, 4000),
(77, 'nl', '', 'Ruben', 0, '2020-02-14 23:32:14', 1181, 'The Keys of Marinus', 80, 'The_Keys_Of_Marinus', '', 0, 1, 5000),
(78, 'nl', '', 'Ruben', 0, '2020-02-14 23:32:29', 1182, 'The Aztecs', 80, 'The_Aztecs', '', 0, 1, 6000),
(79, 'nl', '', 'Ruben', 0, '2020-02-14 23:32:43', 1183, 'The Sensorites', 80, 'The_Sensorites', '', 0, 1, 7000),
(80, 'nl', '', 'Ruben', 0, '2020-02-14 23:33:00', 1184, 'The Reign of Terror', 80, 'The_Reign_Of_Terror', '', 0, 1, 8000),
(81, 'nl', '', 'Ruben', 0, '2020-02-14 23:57:27', 1084, 'The Next Doctor (Special)', 122, 'The_Next_Doctor', '', 0, 1, 140000),
(82, 'nl', '', 'Ruben', 0, '2020-02-14 23:57:52', 1085, 'Planet of the Dead (Special)', 122, 'Planet_of_the_Dead', '', 0, 1, 15000),
(83, 'nl', '', 'Ruben', 0, '2020-02-14 23:57:59', 1084, 'The Next Doctor (Special)', 122, 'The_Next_Doctor', '', 0, 1, 14000),
(84, 'nl', '', 'Ruben', 0, '2020-02-14 23:58:30', 1086, 'The Waters of Mars (Special)', 122, 'The_Waters_of_Mars', '', 0, 1, 16000),
(85, 'nl', '', 'Ruben', 0, '2020-02-14 23:58:48', 1087, 'The End of Time part 1 (Special)', 122, 'The_End_of_Time_part_1', '', 0, 1, 17000),
(86, 'nl', '', 'Ruben', 0, '2020-02-14 23:59:12', 1088, 'The End of Time part 2 (Special)', 122, 'The_End_of_Time_part_2', '', 0, 1, 18000),
(87, 'nl', '', 'Ruben', 0, '2020-02-15 00:00:02', 1070, ' Voyage of the Damned (Special)', 122, 'Voyage_of_the_Damned', '', 0, 1, 0),
(88, 'nl', '', 'Ruben', 0, '2020-02-15 00:02:59', 1126, ' The Snowmen ', 1119, 'The_Snowmen', '', 0, 1, 6000),
(89, 'nl', '', 'Ruben', 0, '2020-02-15 00:03:28', 1135, 'The Day of the Doctor (Special)', 1119, 'The_Day_of_the_Doctor', '', 0, 1, 15000),
(90, 'nl', '', 'Ruben', 0, '2020-02-15 00:03:50', 1136, 'The Time of the Doctor (Special)', 1119, 'The_Time_of_the_Doctor', '', 0, 1, 16000),
(91, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1120, ' The Doctor, the Widow and the Wardrobe ', 125, 'The_Doctor_the_Widow_and_the_Wardrobe', '', 0, 1, 0),
(92, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1121, ' Asylum of the Daleks ', 125, 'Asylum_of_the_Daleks', '', 0, 1, 1000),
(93, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1122, ' Dinosaurs on a Spaceship ', 125, 'Dinosaurs_on_a_Spaceship', '', 0, 1, 2000),
(94, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1123, ' A Town Called Mercy ', 125, 'A_Town_Called_Mercy', '', 0, 1, 3000),
(95, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1124, ' The Power of Three ', 125, 'The_Power_of_Three', '', 0, 1, 4000),
(96, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1125, ' The Angels Take Manhattan ', 125, 'The_Angels_Take_Manhattan', '', 0, 1, 5000),
(97, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1126, ' The Snowmen ', 125, 'The_Snowmen', '', 0, 1, 6000),
(98, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1127, ' The Bells of Saint John ', 125, 'The_Bells_of_Saint_John', '', 0, 1, 7000),
(99, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1128, ' The Rings of Akhaten ', 125, 'The_Rings_of_Akhaten', '', 0, 1, 8000),
(100, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1129, ' Cold War ', 125, 'Cold_War', '', 0, 1, 9000),
(101, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1130, ' Hide ', 125, 'Hide', '', 0, 1, 10000),
(102, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1131, ' Journey to the Centre of the TARDIS ', 125, 'Journey_to_the_Centre_of_the_TARDIS', '', 0, 1, 11000),
(103, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1132, ' The Crimson Horror ', 125, 'The_Crimson_Horror', '', 0, 1, 12000),
(104, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1133, ' Nightmare in Silver ', 125, 'Nightmare_in_Silver', '', 0, 1, 13000),
(105, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1134, ' The Name of the Doctor ', 125, 'The_Name_of_the_Doctor', '', 0, 1, 14000),
(106, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1135, 'The Day of the Doctor (Special)', 125, 'The_Day_of_the_Doctor', '', 0, 1, 15000),
(107, 'nl', '', 'Ruben', 0, '2020-02-15 00:04:57', 1136, 'The Time of the Doctor (Special)', 125, 'The_Time_of_the_Doctor', '', 0, 1, 16000),
(108, 'nl', '', 'Ruben', 0, '2020-02-15 15:16:21', 1523, 'Earth', 135, 'Earth', 'Nee', 1, 1, 0),
(109, 'nl', '', 'Ruben', 0, '2020-02-15 15:18:46', 1569, 'United Kingdom', 1523, 'United_Kingdom', '0', 0, 1, 0),
(110, 'nl', '', 'Ruben', 0, '2020-02-15 15:19:47', 1524, 'Sheffield', 1569, 'Sheffield', '0', 0, 1, 0),
(111, 'nl', '', 'Ruben', 0, '2020-02-15 15:19:47', 1525, 'London', 1569, 'London', '0', 0, 1, 0),
(112, 'nl', '', 'Ruben', 0, '2020-02-15 15:19:58', 1569, 'United Kingdom', 1523, 'United_Kingdom', '0', 1, 1, 0),
(113, 'nl', '', 'Ruben', 0, '2020-02-15 15:30:39', 45, 'John Benton', 19, 'John_Benton', '0', 0, 1, 0),
(114, 'nl', '', 'Ruben', 0, '2020-02-15 15:30:54', 46, 'Mike Yates', 19, 'Mike_Yates', '0', 0, 1, 0),
(115, 'nl', '', 'Ruben', 0, '2020-03-01 20:57:27', 1572, 'The Ascension of the Cybermen', 1560, 'The_Ascension_of_the_Cybermen', 'Nee', 0, 1, 8000),
(116, 'nl', '', 'Ruben', 0, '2020-03-12 17:24:01', 151, 'Rassilon', 143, 'Rassilon', '0', 0, 1, 0),
(117, 'nl', '', 'Ruben', 0, '2020-03-12 17:24:43', 4, 'The Doctor', 3, 'The Doctor', '0', 1, 1, 0),
(118, 'nl', '', 'Ruben', 0, '2020-03-12 17:26:18', 4, 'The Doctor', 3, 'The_Doctor', '0', 1, 1, 0),
(119, 'nl', '', 'Ruben', 0, '2020-03-12 17:26:48', 4, 'The Doctor', 3, 'The_Doctor', '0', 1, 1, 0),
(120, 'nl', '', 'Ruben', 0, '2020-03-12 17:38:44', 27, 'Barbara Wright', 19, 'Barbara_Wright', '0', 0, 1, 0),
(121, 'nl', '', 'Ruben', 0, '2020-03-12 17:39:10', 27, 'Barbara Wright', 19, 'Barbara_Wright', '0', 0, 1, 0),
(122, 'nl', '', 'Ruben', 0, '2020-03-12 17:40:10', 27, 'Barbara Wright', 19, 'Barbara_Wright', '0', 0, 1, 0),
(123, 'nl', '', 'Ruben', 0, '2020-03-12 17:44:19', 5, 'First Doctor', 4, 'First_Doctor', '0', 0, 1, 1000),
(124, 'nl', '', 'Ruben', 0, '2020-03-12 17:49:10', 30, 'Weeping Angels', 148, 'Weeping_Angels', '0', 0, 1, 0),
(125, 'nl', '', 'Ruben', 0, '2020-03-12 17:50:27', 31, 'Vicki', 19, 'Vicki', '0', 0, 1, 0),
(126, 'nl', '', 'Ruben', 0, '2020-03-12 17:52:01', 18, 'Thirtheenth Doctor', 4, 'Thirteenth_Doctor', '0', 0, 1, 14000),
(127, 'nl', '', 'Ruben', 0, '2020-03-12 17:52:19', 17, 'Twelfth Doctor', 4, 'Twelfth_Doctor', '0', 0, 1, 13000),
(128, 'nl', '', 'Ruben', 0, '2020-03-12 17:52:33', 16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, 12000),
(129, 'nl', '', 'Ruben', 0, '2020-03-12 17:53:28', 15, 'Tenth Doctor', 4, 'Tenth_Doctor', '0', 0, 1, 11000),
(130, 'nl', '', 'Ruben', 0, '2020-03-12 17:53:55', 16, 'Eleventh Doctor', 4, 'Eleventh_Doctor', '0', 0, 1, 12000),
(131, 'nl', '', 'Ruben', 0, '2020-03-12 17:55:22', 17, 'Twelfth Doctor', 4, 'Twelfth_Doctor', '0', 0, 1, 13000),
(132, 'nl', '', 'Ruben', 0, '2020-03-12 17:55:40', 18, 'Thirtheenth Doctor', 4, 'Thirteenth_Doctor', '0', 0, 1, 14000),
(133, 'nl', '', 'Ruben', 0, '2020-03-17 22:00:18', 68, 'Christina de Souza', 19, 'Christina_de_Souza', '0', 0, 1, 0),
(134, 'nl', '', 'Ruben', 0, '2020-03-22 21:24:10', 73, 'River Song/ Melody Pond', 19, 'River_Song', '0', 0, 1, 0),
(135, 'nl', '', 'Ruben', 0, '2020-03-31 11:35:50', 1561, 'Spyfall', 1560, 'Spyfall', 'Nee', 0, 1, 0),
(136, 'nl', '', 'Ruben', 0, '2020-03-31 11:57:15', 1087, 'The End of Time part 1 (Special)', 122, 'The_End_of_Time', '', 0, 1, 17000),
(137, 'nl', '', 'Ruben', 0, '2020-03-31 12:19:13', 1087, 'The End of Time (Special)', 122, 'The_End_of_Time', '', 0, 1, 17000),
(138, 'nl', '', 'Ruben', 0, '2020-04-11 10:50:16', 1001, 'An Unearthly Child/100,000 BC', 80, 'An_Unearthly_Child_(TV_Story)', '', 0, 1, 1000),
(139, 'nl', '', 'Ruben', 0, '2020-04-11 10:52:16', 1178, 'The Daleks', 80, 'The_Daleks_(TV_Story)', '', 0, 1, 2000),
(140, 'nl', '', 'Ruben', 0, '2020-04-11 10:57:17', 1001, 'An Unearthly Child/100,000 BC', 80, 'An_Unearthly_Child__TV_Story', '', 0, 1, 1000),
(141, 'nl', '', 'Ruben', 0, '2020-04-11 10:58:20', 1178, 'The Daleks', 80, 'The_Daleks__TV_Story', '', 0, 1, 2000),
(142, 'nl', '', 'Ruben', 0, '2020-04-11 14:54:26', 118, 'The Movie (1996)', 24, 'Doctor_Who_The_Movie', '0', 0, 1, 0),
(143, 'nl', '', 'Ruben', 0, '2020-04-11 15:29:58', 1185, ' Planet of Giants', 81, 'Planet_of_Giants__TV_Story', '', 0, 1, 1000),
(144, 'nl', '', 'Ruben', 0, '2020-04-13 18:09:18', 782, 'Jenna-Louise Coleman ', 141, 'Jenna_Louise_Coleman', '', 0, 1, 0),
(145, 'nl', '', 'Ruben', 0, '2020-04-13 18:16:57', 782, 'Jenna-Louise Coleman ', 141, 'Jenna-Louise_Coleman', '', 0, 1, 0),
(146, 'nl', '', 'Ruben', 0, '2020-04-16 10:42:30', 44, 'Sarah Jane Smith', 19, 'Sarah-Jane_Smith', '0', 0, 1, 0),
(147, 'nl', '', 'Ruben', 0, '2020-04-16 10:46:16', 44, 'Sarah Jane Smith', 19, 'Sarah_Jane_Smith', '0', 0, 1, 0),
(148, 'nl', '', 'Ruben', 0, '2020-04-22 20:22:35', 1058, ' 42 ', 121, '42__TV_Story', '', 0, 1, 7000),
(149, 'nl', '', 'Ruben', 0, '2020-04-27 21:00:27', 1006, ' Dalek', 119, 'Dalek__TV_Story', '', 0, 1, 6000),
(150, 'nl', '', 'Ruben', 0, '2020-04-27 21:01:44', 1006, ' Dalek', 119, 'Dalek__TV_Story', '', 0, 1, 6000),
(151, 'nl', '', 'Ruben', 0, '2020-05-05 12:02:32', 1575, 'How long to watch season x of Doctor Who', 1574, 'How_long_to_watch_season_a_of_Doctor_Who', '0', 1, 1, 0),
(152, 'nl', '', 'Ruben', 0, '2020-05-05 16:01:17', 1575, 'How long to watch all of Doctor Who', 1574, 'How_long_to_watch_all_of_Doctor_Who', '0', 1, 1, 0),
(153, 'nl', '', 'Ruben', 0, '2020-05-06 09:54:48', 1575, 'How long to watch all of Doctor Who', 1574, 'How_long_to_watch_all_of_Doctor_Who', '0', 0, 1, 0),
(154, 'nl', '', 'Ruben', 0, '2020-05-06 09:54:54', 1575, 'How long to watch all of Doctor Who', 1574, 'How_long_to_watch_all_of_Doctor_Who', '0', 0, 1, 0),
(155, 'nl', '', 'Ruben', 0, '2020-05-06 19:10:08', 1576, 'How long to watch a specific series of Doctor Who', 1574, 'How_long_to_watch_a_specific_series_of_Doctor_Who', '0', 0, 1, 0),
(156, 'nl', '', 'Ruben', 0, '2020-05-06 20:28:44', 1576, 'How long to watch a specific series of Doctor Who', 1574, 'How_long_to_watch_a_specific_series_of_Doctor_Who', '0', 0, 1, 0),
(157, 'nl', '', 'Ruben', 0, '2020-05-12 15:24:26', 136, 'Times', 2, 'Times', '', 1, 1, 0),
(158, 'nl', '', 'Ruben', 0, '2020-05-12 15:42:53', 1577, 'Months', 136, 'Months', '', 0, 1, 0),
(159, 'nl', '', 'Ruben', 0, '2020-05-12 15:47:28', 1467, 'Jackie Tyler', 1578, 'Jackie_Tyler', '0', 0, 1, 0),
(160, 'nl', '', 'Ruben', 0, '2020-05-12 15:50:04', 1513, 'Jenny Flint', 1578, 'Jenny_Flint', '0', 0, 1, 0),
(161, 'nl', '', 'Ruben', 0, '2020-05-12 15:51:28', 1467, 'Jackie Tyler', 1578, 'Jackie_Tyler', '0', 0, 1, 0),
(162, 'nl', '', 'Ruben', 0, '2020-05-12 15:52:27', 1467, 'Jackie Tyler', 1578, 'Jackie_Tyler', '0', 0, 1, 0),
(163, 'nl', '', 'Ruben', 0, '2020-05-12 15:53:44', 1513, 'Jenny Flint', 1578, 'Jenny_Flint', '0', 0, 1, 0),
(164, 'nl', '', 'Ruben', 0, '2020-05-12 15:55:34', 1514, 'Madame Vastra', 256, 'Madame_Vastra', '0', 0, 1, 0),
(165, 'nl', '', 'Ruben', 0, '2020-05-12 15:56:24', 1514, 'Madame Vastra', 256, 'Madame_Vastra', '0', 0, 1, 0),
(166, 'nl', '', 'Ruben', 0, '2020-05-12 16:10:44', 1578, 'Humans', 148, 'Category_Humans', '0', 1, 1, 0),
(167, 'nl', '', 'Ruben', 0, '2020-05-12 16:18:42', 1578, 'Humans', 148, 'Humans', '0', 1, 1, 0),
(168, 'nl', '', 'Ruben', 0, '2020-05-12 16:21:24', 27, 'Barbara Wright', 1578, 'Barbara_Wright', '0', 0, 1, 0),
(169, 'nl', '', 'Ruben', 0, '2020-05-12 16:22:11', 1467, 'Jackie Tyler', 1578, 'Jackie_Tyler', '0', 0, 1, 0),
(170, 'nl', '', 'Ruben', 0, '2020-05-12 16:22:32', 1513, 'Jenny Flint', 1578, 'Jenny_Flint', '0', 0, 1, 0),
(171, 'nl', '', 'Ruben', 0, '2020-05-12 16:23:43', 73, 'River Song/ Melody Pond', 1578, 'River_Song', '0', 0, 1, 0),
(172, 'nl', '', 'Ruben', 0, '2020-05-12 16:24:09', 73, 'River Song/ Melody Pond', 1578, 'River_Song', '0', 0, 1, 0),
(173, 'nl', '', 'Ruben', 0, '2020-05-12 16:24:22', 73, 'River Song/ Melody Pond', 1578, 'River_Song', '0', 0, 1, 0),
(174, 'nl', '', 'Ruben', 0, '2020-05-12 16:24:36', 73, 'River Song/ Melody Pond', 1578, 'River_Song', '0', 0, 1, 0),
(175, 'nl', '', 'Ruben', 0, '2020-05-12 16:25:01', 31, 'Vicki', 1578, 'Vicki', '0', 0, 1, 0),
(176, 'nl', '', 'Ruben', 0, '2020-05-12 16:45:12', 62, 'Adam Mitchell', 1578, 'Adam_Mitchell', '0', 0, 1, 0),
(177, 'nl', '', 'Ruben', 0, '2020-05-12 17:02:35', 143, 'Gallifreyan', 148, 'Gallifreyan', '0', 1, 1, 0),
(178, 'nl', '', 'Ruben', 0, '2020-05-12 17:03:22', 26, 'Susan Foreman', 143, 'Susan_Foreman', '0', 0, 1, 0),
(179, 'nl', '', 'Ruben', 0, '2020-05-12 17:03:49', 32, 'Steven Taylor', 1578, 'Steven_Taylor', '0', 0, 1, 0),
(180, 'nl', '', 'Ruben', 0, '2020-05-12 17:06:54', 33, 'Katarina', 1578, 'Katarina', '0', 0, 1, 0),
(181, 'nl', '', 'Ruben', 0, '2020-05-12 17:07:15', 34, 'Sara Kingdom', 1578, 'Sara_Kingdom', '0', 0, 1, 0),
(182, 'nl', '', 'Ruben', 0, '2020-05-12 17:08:02', 35, 'Dorothea &laquo;Dodo&raquo; Chaplet', 1578, 'Dodo_Chaplet', '0', 0, 1, 0),
(183, 'nl', '', 'Ruben', 0, '2020-05-12 17:09:59', 36, 'Polly Wright', 1578, 'Polly_Wright', '0', 0, 1, 0),
(184, 'nl', '', 'Ruben', 0, '2020-05-12 17:10:16', 37, 'Ben Jackson', 1578, 'Ben_Jackson', '0', 0, 1, 0),
(185, 'nl', '', 'Ruben', 0, '2020-05-12 17:16:26', 38, 'James Robert &laquo;Jamie&raquo; McCrimmon', 1578, 'Jamie_McCrimmon', '0', 0, 1, 0),
(186, 'nl', '', 'Ruben', 0, '2020-05-12 17:17:30', 39, 'Victoria Waterfield', 1578, 'Victoria_Waterfield', '0', 0, 1, 0),
(187, 'nl', '', 'Ruben', 0, '2020-05-12 17:17:46', 40, 'Zoe Heriot', 1578, 'Zoe_Heriot', '0', 0, 1, 0),
(188, 'nl', '', 'Ruben', 0, '2020-05-12 17:20:16', 41, 'Alistair Gordon Lethbridge-Stewart', 1578, 'Alistair_Gordon_LethBridge_Stewart', '0', 0, 1, 0),
(189, 'nl', '', 'Ruben', 0, '2020-05-12 17:20:31', 42, 'Elizabeth &laquo;Liz&raquo; Shaw', 1578, 'Liz_Shaw', '0', 0, 1, 0),
(190, 'nl', '', 'Ruben', 0, '2020-05-12 17:20:41', 43, 'Jo Grant', 1578, 'Jo_Grant', '0', 0, 1, 0),
(191, 'nl', '', 'Ruben', 0, '2020-05-12 18:24:30', 44, 'Sarah Jane Smith', 1578, 'Sarah_Jane_Smith', '0', 0, 1, 0),
(192, 'nl', '', 'Ruben', 0, '2020-05-12 18:24:35', 44, 'Sarah Jane Smith', 1578, 'Sarah_Jane_Smith', '0', 0, 1, 0),
(193, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 45, 'John Benton', 1578, 'John_Benton', '0', 0, 1, 0),
(194, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 46, 'Mike Yates', 1578, 'Mike_Yates', '0', 0, 1, 0),
(195, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 47, 'Harry Sullivan', 1578, 'Harry_Sullivan', '0', 0, 1, 0),
(196, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 52, 'Tegan Jovanka', 1578, 'Tegan_Jovanka', '0', 0, 1, 0),
(197, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 58, 'Ace', 1578, 'Ace', '0', 0, 1, 0),
(198, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 59, 'Grace Holloway', 1578, 'Grace_Holloway', '0', 0, 1, 0),
(199, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 60, 'Rose Tyler', 1578, 'Rose_Tyler', '0', 0, 1, 0),
(200, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 61, 'Mickey Smith', 1578, 'Mickey_Smith', '0', 0, 1, 0),
(201, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 63, 'Captain Jack Harkness ', 1578, 'Jack_Harkness', '0', 0, 1, 0),
(202, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 64, 'Donna Noble', 1578, 'Donna_Noble', '0', 0, 1, 0),
(203, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 65, 'Martha Jones', 1578, 'Martha_Jones', '0', 0, 1, 0),
(204, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 67, 'Jackson Lake', 1578, 'Jackson_Lake', '0', 0, 1, 0),
(205, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 68, 'Christina de Souza', 1578, 'Christina_de_Souza', '0', 0, 1, 0),
(206, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 69, 'Adelaide Brooke', 1578, 'Adelaide_Brooke', '0', 0, 1, 0),
(207, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 70, 'Wilfred &laquo;Wilf&raquo; Mott', 1578, 'Wilfred_Mott', '0', 0, 1, 0),
(208, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 71, 'Amelia &laquo;Amy&raquo; Pond', 1578, 'Amelia_Pond', '0', 0, 1, 0),
(209, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 72, 'Rory Williams', 1578, 'Rory_Williams', '0', 0, 1, 0),
(210, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 74, 'Craig Owens', 1578, 'Craig_Owens', '0', 0, 1, 0),
(211, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 75, 'Canton Everett Delaware III', 1578, 'Canton_Everett_Delaware_III', '0', 0, 1, 0),
(212, 'nl', '', 'Ruben', 0, '2020-05-12 18:25:50', 76, 'Clara &laquo;Oswin&raquo; Oswald', 1578, 'Clara_Oswald', '0', 0, 1, 0),
(213, 'nl', '', 'Ruben', 0, '2020-05-12 18:26:16', 77, 'Danny Pink', 1578, 'Danny_Pink', '0', 0, 1, 0),
(214, 'nl', '', 'Ruben', 0, '2020-05-12 18:26:16', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(215, 'nl', '', 'Ruben', 0, '2020-05-12 18:26:16', 177, 'Ian Chesterton', 1578, 'Ian_Chesterton', '0', 0, 1, 0),
(216, 'nl', '', 'Ruben', 0, '2020-05-12 18:26:16', 1470, 'Yasmin Khan', 1578, 'Yasmin_Khan', '0', 0, 1, 0),
(217, 'nl', '', 'Ruben', 0, '2020-05-12 18:26:16', 1471, 'Ryan Sinclair', 1578, 'Ryan_Sinclair', '0', 0, 1, 0),
(218, 'nl', '', 'Ruben', 0, '2020-05-12 18:26:16', 1472, 'Graham O\' Brien', 1578, 'Graham_O_Brien', '0', 0, 1, 0),
(219, 'nl', '', 'Ruben', 0, '2020-05-12 18:27:43', 48, 'Leela', 1578, 'Leela', '0', 0, 1, 0),
(220, 'nl', '', 'Ruben', 0, '2020-05-12 18:28:59', 50, 'Romana(dvoratrelundar)', 143, 'Romana', '0', 0, 1, 0),
(221, 'nl', '', 'Ruben', 0, '2020-05-12 18:30:16', 1579, 'Alzarian', 148, 'Alzarian', 'Nee', 0, 1, 0),
(222, 'nl', '', 'Ruben', 0, '2020-05-12 18:30:31', 51, 'Adric', 1579, 'Adric', '0', 0, 1, 0),
(223, 'nl', '', 'Ruben', 0, '2020-05-12 18:31:42', 1580, 'Trakenite', 148, 'Trakenite', 'Nee', 0, 1, 0),
(224, 'nl', '', 'Ruben', 0, '2020-05-12 18:31:55', 53, 'Nyssa', 1580, 'Nyssa', '0', 0, 1, 0),
(225, 'nl', '', 'Ruben', 0, '2020-05-12 20:16:01', 1581, 'Robots', 1370, 'Robots', 'Nee', 0, 1, 0),
(226, 'nl', '', 'Ruben', 0, '2020-05-12 20:16:10', 49, 'K9', 1581, 'K9', '0', 0, 1, 0),
(227, 'nl', '', 'Ruben', 0, '2020-05-12 20:18:17', 1582, 'Trion (Species)', 148, 'Trion_Species', 'Nee', 0, 1, 0),
(228, 'nl', '', 'Ruben', 0, '2020-05-12 20:18:33', 54, 'Vislor Turlough', 1582, 'Vislor_Turlough', '0', 0, 1, 0),
(229, 'nl', '', 'Ruben', 0, '2020-05-12 20:27:18', 1583, 'Kamelion (Species)', 148, 'Kamelion_(Species)', 'Nee', 0, 1, 0),
(230, 'nl', '', 'Ruben', 0, '2020-05-12 20:27:25', 55, 'Kamelion', 1583, 'Kamelion', '0', 0, 1, 0),
(231, 'nl', '', 'Ruben', 0, '2020-05-12 20:30:07', 1583, 'Kamelion (Species)', 148, 'Kamelion_%28Species%29', 'Nee', 0, 1, 0),
(232, 'nl', '', 'Ruben', 0, '2020-05-12 20:33:49', 1583, 'Kamelion (Species)', 148, 'Kamelion_(Species)', 'Nee', 0, 1, 0),
(233, 'nl', '', 'Ruben', 0, '2020-05-12 21:26:14', 1582, 'Trion (Species)', 148, 'Trion_(Species)', 'Nee', 0, 1, 0),
(234, 'nl', '', 'Ruben', 0, '2020-05-13 09:17:44', 238, 'Strax', 146, 'Strax', '', 0, 1, 0),
(235, 'nl', '', 'Ruben', 0, '2020-05-13 09:17:55', 238, 'Strax', 146, 'Strax', '', 0, 1, 0),
(236, 'nl', '', 'Ruben', 0, '2020-05-13 09:19:45', 1584, 'Atrion', 148, 'Atrion', 'Nee', 0, 1, 0),
(237, 'nl', '', 'Ruben', 0, '2020-05-13 09:19:51', 1515, 'Princess Astra', 1584, 'Princess_Astra', '0', 0, 1, 0),
(238, 'nl', '', 'Ruben', 0, '2020-05-13 09:22:49', 1584, 'Atrion', 148, 'Atrion', 'Nee', 1, 1, 0),
(239, 'nl', '', 'Ruben', 0, '2020-05-13 09:23:02', 1583, 'Kamelion (Species)', 148, 'Kamelion_(Species)', 'Nee', 1, 1, 0),
(240, 'nl', '', 'Ruben', 0, '2020-05-13 09:23:09', 1582, 'Trion (Species)', 148, 'Trion_(Species)', 'Nee', 1, 1, 0),
(241, 'nl', '', 'Ruben', 0, '2020-05-13 09:23:20', 1580, 'Trakenite', 148, 'Trakenite', 'Nee', 1, 1, 0),
(242, 'nl', '', 'Ruben', 0, '2020-05-13 09:23:29', 1579, 'Alzarian', 148, 'Alzarian', 'Nee', 1, 1, 0),
(243, 'nl', '', 'Ruben', 0, '2020-05-13 09:24:10', 256, 'Silurians', 148, 'Silurians', '', 1, 1, 0),
(244, 'nl', '', 'Ruben', 0, '2020-05-13 09:24:22', 146, 'Sontarans', 148, 'Sontarans', '', 1, 1, 0),
(245, 'nl', '', 'Ruben', 0, '2020-05-13 09:25:40', 1581, 'Robots', 1370, 'Robots', 'Nee', 1, 1, 0),
(246, 'nl', '', 'Ruben', 0, '2020-05-13 09:52:54', 1585, 'Cybercontroller', 145, 'Cybercontroller', 'Nee', 0, 1, 0),
(247, 'nl', '', 'Ruben', 0, '2020-05-13 10:14:16', 1585, 'Cybercontroller', 145, 'Cybercontroller', 'Nee', 1, 1, 0),
(248, 'nl', '', 'Ruben', 0, '2020-05-13 10:14:38', 1585, 'Cybercontroller', 145, 'Cybercontroller', 'Nee', 1, 1, 0),
(249, 'nl', '', 'Ruben', 0, '2020-05-13 10:15:20', 1585, 'Cybercontroller', 145, 'Cybercontroller', 'Nee', 0, 1, 0),
(250, 'nl', '', 'Ruben', 0, '2020-05-13 11:12:56', 1586, 'Cybercontroller', 145, 'Cybercontroller', 'Nee', 0, 1, 0),
(251, 'nl', '', 'Ruben', 0, '2020-05-13 11:18:07', 1587, 'Doctor Who: The Eternity Clock', 1547, 'The_Eternity_Clock_(Videogame)', 'Nee', 0, 1, 0),
(252, 'nl', '', 'Ruben', 0, '2020-05-13 18:14:18', 1520, ' Book 001: Doctor Who and the Abominable Snowmen', 1519, 'Doctor_Who_and_the_Abominable_Snowmen_(Book)', '', 0, 1, 0),
(253, 'nl', '', 'Ruben', 0, '2020-05-13 18:15:54', 1520, ' Book 001: Doctor Who and the Abominable Snowmen', 1519, 'Doctor_Who_and_the_Abominable_Snowmen_(Book)', '', 0, 1, 0),
(254, 'nl', '', 'Ruben', 0, '2020-05-13 18:16:33', 1521, ' Book 016: Doctor Who and the Daleks', 1519, 'Doctor_Who_and_the_Daleks_(Book)', '', 0, 1, 0),
(255, 'nl', '', 'Ruben', 0, '2020-05-13 18:16:52', 1522, ' Book 073: Doctor Who and the Zarbi', 1519, 'Doctor_Who_and_the_Zarbi_(Book)', '', 0, 1, 0),
(256, 'nl', '', 'Ruben', 0, '2020-05-20 15:41:22', 1517, 'Fiction', 157, 'Fiction', '', 1, 1, 0),
(257, 'nl', '', 'Ruben', 0, '2020-05-20 15:57:30', 1589, 'Docudrama', 1588, 'Docudrama', '', 1, 1, 0),
(258, 'nl', '', 'Ruben', 0, '2020-05-20 15:58:46', 1590, 'An Adventure in Space and Time', 1589, 'An_Adventure_in_Space_and_Time_(TV_Special)', '', 0, 1, 0),
(259, 'nl', '', 'Ruben', 0, '2020-05-20 15:59:29', 1590, 'An Adventure in Space and Time', 1589, 'An_Adventure_in_Space_and_Time_(TV_Special)', '', 0, 1, 0),
(260, 'nl', '', 'Ruben', 0, '2020-05-24 20:08:36', 147, 'Helen A', 1578, 'Helen_A', '', 0, 1, 0),
(261, 'nl', '', 'Ruben', 0, '2020-05-25 17:33:39', 150, 'The Great Old Ones', 148, 'The_Great_Old_Ones', '0', 0, 1, 0),
(262, 'nl', '', 'Ruben', 0, '2020-05-25 17:34:38', 1591, 'Animus', 150, 'Animus', '0', 0, 1, 0),
(263, 'nl', '', 'Ruben', 0, '2020-05-25 17:36:40', 152, 'Azal', 1592, 'Azal', '', 0, 1, 0),
(264, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1593, 'Issue 545', 308, 'Doctor_Who_Magazine_Issue_545', 'Nee', 0, 1, 0),
(265, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1594, 'Issue 546', 308, 'Doctor_Who_Magazine_Issue_546', 'Nee', 0, 1, 0),
(266, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1595, 'Issue 547', 308, 'Doctor_Who_Magazine_Issue_547', 'Nee', 0, 1, 0),
(267, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1596, 'Issue 548', 308, 'Doctor_Who_Magazine_Issue_548', 'Nee', 0, 1, 0),
(268, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1597, 'Issue 549', 308, 'Doctor_Who_Magazine_Issue_549', 'Nee', 0, 1, 0),
(269, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1598, 'Issue 550', 308, 'Doctor_Who_Magazine_Issue_550', 'Nee', 0, 1, 0),
(270, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1599, 'Issue 551', 308, 'Doctor_Who_Magazine_Issue_551', 'Nee', 0, 1, 0),
(271, 'nl', '', 'Ruben', 0, '2020-05-28 09:46:55', 1600, 'Issue 552', 308, 'Doctor_Who_Magazine_Issue_552', 'Nee', 0, 1, 0),
(272, 'nl', '', 'Ruben', 0, '2020-05-28 16:01:46', 131, 'Summer 1980', 130, 'DWMSI_Summer_1980', '0', 0, 1, 1),
(273, 'nl', '', 'Ruben', 0, '2020-05-28 16:01:51', 1033, 'Summer 1981', 130, 'DWMSI_Summer_1981', 'Nee', 0, 1, 2),
(274, 'nl', '', 'Ruben', 0, '2020-05-28 16:01:59', 1034, 'Winter 1981', 130, 'DWMSI_Winter_1981', 'Nee', 0, 1, 3),
(275, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:07', 1035, 'Summer 1982', 130, 'DWMSI_Summer_1982', 'Nee', 0, 1, 4),
(276, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:13', 1036, 'Winter 1982', 130, 'DWMSI_Winter_1982', 'Nee', 0, 1, 5),
(277, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:19', 1037, 'Summer 1983', 130, 'DWMSI_Summer_1983', 'Nee', 0, 1, 6),
(278, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:23', 1038, 'Winter 1983', 130, 'DWMSI_Winter_1983', 'Nee', 0, 1, 7),
(279, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:30', 1039, 'Summer 1984', 130, 'DWMSI_Summer_1984', 'Nee', 0, 1, 8),
(280, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:35', 1040, 'Winter 1984', 130, 'DWMSI_Winter_1984', 'Nee', 0, 1, 9),
(281, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:36', 1040, 'Winter 1984', 130, 'DWMSI_Winter_1984', 'Nee', 0, 1, 9),
(282, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:43', 1041, 'Summer 1985', 130, 'DWMSI_Summer_1985', 'Nee', 0, 1, 10),
(283, 'nl', '', 'Ruben', 0, '2020-05-28 16:02:49', 1042, 'Winter 1985', 130, 'DWMSI_Winter_1985', 'Nee', 0, 1, 11),
(284, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:13', 1043, 'Summer 1986', 130, 'DWMSI_Summer_1986', 'Nee', 0, 1, 12),
(285, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:19', 1044, 'Winter 1986', 130, 'DWMSI_Winter_1986', 'Nee', 0, 1, 13),
(286, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:27', 1045, 'Winter 1991', 130, 'DWMSI_Winter_1991', 'Nee', 0, 1, 14),
(287, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:39', 1046, 'Summer 1992', 130, 'DWMSI_Summer_1992', 'Nee', 0, 1, 15),
(288, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:48', 1047, 'Winter 1992', 130, 'DWMSI_Winter_1992', 'Nee', 0, 1, 16),
(289, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:53', 1048, 'Summer 1993', 130, 'DWMSI_Summer_1993', 'Ja', 0, 1, 17),
(290, 'nl', '', 'Ruben', 0, '2020-05-28 16:03:58', 1049, '30th Anniversary 1993', 130, '30th_Anniversary_1993', 'Nee', 0, 1, 18),
(291, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:15', 1050, 'Summer 1994', 130, 'DWMSI_Summer_1994', 'Nee', 0, 1, 19),
(292, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:20', 1065, 'Winter 1994', 130, 'DWMSI_Winter_1994', 'Ja', 0, 1, 20),
(293, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:28', 1066, 'Summer 1995', 130, 'DWMSI_Summer_1995', 'Ja', 0, 1, 21),
(294, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:33', 1067, 'Autumn 1987', 130, 'DWMSI_Autumn_1987', 'Ja', 0, 1, 22),
(295, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:39', 1068, '25th Aniversary 1988', 130, 'DWMSI_25th_Anniversary_1988', 'Ja', 0, 1, 23),
(296, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:44', 1069, 'Spring 1996', 130, 'DWMSI_Spring_1996', 'Ja', 0, 1, 24),
(297, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:49', 1177, 'The Dalek Chronicles', 130, 'DWMSI_The_Dalek_Chronicles', 'Ja', 0, 1, 25),
(298, 'nl', '', 'Ruben', 0, '2020-05-28 16:04:55', 1341, '1979-1989 10th Anniversary', 130, 'DWMSI_1979_1989_10th_Anniversary', 'Ja', 0, 1, 26),
(299, 'nl', '', 'Ruben', 0, '2020-05-28 16:05:00', 1342, 'Movie Special', 130, 'DWMSI_Movie_Special', 'Ja', 0, 1, 27),
(300, 'nl', '', 'Ruben', 0, '2020-05-28 16:05:06', 1365, 'Summer 1991', 130, 'DWMSI_Summer_1991', 'Ja', 0, 1, 28),
(301, 'nl', '', 'Ruben', 0, '2020-05-28 16:07:11', 1344, 'Fifth Doctor', 1343, 'DWMSE_01', 'Ja', 0, 1, 1),
(302, 'nl', '', 'Ruben', 0, '2020-05-28 16:07:28', 1536, 'Series Four Companion', 1343, 'DWMSE_20', '0', 0, 1, 20),
(303, 'nl', '', 'Ruben', 0, '2020-05-28 16:08:03', 172, 'In their Own Words 1982-86', 1343, 'DWMSE_18', '', 0, 1, 18),
(304, 'nl', '', 'Ruben', 0, '2020-05-28 16:08:31', 1345, 'Third Doctor', 1343, 'DWMSE_02', 'Ja', 0, 1, 2),
(305, 'nl', '', 'Ruben', 0, '2020-05-28 16:08:45', 1346, 'Sixth Doctor', 1343, 'DWMSE_03', 'Ja', 0, 1, 3),
(306, 'nl', '', 'Ruben', 0, '2020-05-28 16:09:52', 1347, 'Second Doctor', 1343, 'DWMSE_04', 'Ja', 0, 1, 4),
(307, 'nl', '', 'Ruben', 0, '2020-05-28 16:10:04', 1348, 'Eighth Doctor', 1343, 'DWMSE_05', 'Ja', 0, 1, 5),
(308, 'nl', '', 'Ruben', 0, '2020-05-28 16:10:20', 1349, '40th Anniversary', 1343, 'DWMSE_06', 'Ja', 0, 1, 6),
(309, 'nl', '', 'Ruben', 0, '2020-05-28 16:10:58', 1350, 'First Doctor', 1343, 'DWMSE_07', 'Ja', 0, 1, 7),
(310, 'nl', '', 'Ruben', 0, '2020-05-28 16:11:23', 1351, 'Fourth Doctor: Volume 1', 1343, 'DWMSE_08', 'Ja', 0, 1, 8),
(311, 'nl', '', 'Ruben', 0, '2020-05-28 16:11:35', 1355, 'Fourth Doctor: Volume 2', 1343, 'DWMSE_09', 'Ja', 0, 1, 9),
(312, 'nl', '', 'Ruben', 0, '2020-05-28 16:12:19', 1356, 'Seventh Doctor', 1343, 'DWMSE_10', 'Ja', 0, 1, 10),
(313, 'nl', '', 'Ruben', 0, '2020-05-28 16:12:33', 1357, 'Series One Companion', 1343, 'DWMSE_11', 'Ja', 0, 1, 11),
(314, 'nl', '', 'Ruben', 0, '2020-05-28 16:12:46', 1358, 'In Their Own Words: 1963-69', 1343, 'DWMSE_12', 'Ja', 0, 1, 12),
(315, 'nl', '', 'Ruben', 0, '2020-05-28 16:13:02', 1359, 'The Ninth Doctor Collected Comics', 1343, 'DWMSE_13', 'Ja', 0, 1, 13),
(316, 'nl', '', 'Ruben', 0, '2020-05-28 16:13:22', 1360, 'Series Two Companion', 1343, 'DWMSE_14', 'Ja', 0, 1, 14),
(317, 'nl', '', 'Ruben', 0, '2020-05-28 16:13:35', 1361, 'In Their Own Words: 1970-76', 1343, 'DWMSE_15', 'Ja', 0, 1, 15),
(318, 'nl', '', 'Ruben', 0, '2020-05-28 16:13:48', 1362, 'In Their Own Words 1977-81', 1343, 'DWMSE_16', 'Ja', 0, 1, 16),
(319, 'nl', '', 'Ruben', 0, '2020-05-28 16:14:02', 1363, 'Series Three Companion', 1343, 'DWMSE_17', 'Ja', 0, 1, 17),
(320, 'nl', '', 'Ruben', 0, '2020-05-28 16:14:15', 1535, 'The Tenth Doctor Collected Comics', 1343, 'DWMSE_19', '0', 0, 0, 19),
(321, 'nl', '', 'Ruben', 0, '2020-05-28 16:49:34', 66, 'Astrid Peth', 1601, 'Astrid_Peth', '0', 0, 1, 0),
(322, 'nl', '', 'Ruben', 0, '2020-05-28 16:51:22', 57, 'Melanie &laquo;Mel&raquo; Bush', 1578, 'Mel_Bush', '0', 0, 1, 0),
(323, 'nl', '', 'Ruben', 0, '2020-05-28 20:13:20', 79, 'Nardole', 1601, 'Nardole', '0', 0, 1, 0),
(324, 'nl', '', 'Ruben', 0, '2020-05-28 20:14:36', 56, 'Perpugilliam &laquo;Peri&raquo; Brown', 1578, 'Peri_Brown', '0', 0, 1, 0),
(325, 'nl', '', 'Ruben', 0, '2020-05-28 20:23:36', 19, 'Companions', 3, 'Category:Companions', '0', 1, 1, 0),
(326, 'nl', '', 'Ruben', 0, '2020-05-29 18:39:33', 1016, ' Tooth and Claw', 120, 'Tooth_and_Claw_(TV_Story)', '', 0, 1, 2000),
(327, 'nl', '', 'Ruben', 0, '2020-05-29 18:52:47', 84, 'The Master', 143, 'The_Master', '0', 0, 1, 0),
(328, 'nl', '', 'Ruben', 0, '2020-05-30 21:24:59', 237, 'Cult of Skaro', 144, 'Cult_0f_Skaro', '', 0, 1, 0),
(329, 'nl', '', 'Ruben', 0, '2020-05-30 21:25:18', 237, 'Cult of Skaro', 144, 'Cult_of_Skaro', '', 0, 1, 0),
(330, 'nl', '', 'Ruben', 0, '2020-06-01 20:32:24', 282, 'Issue 083', 259, 'Doctor_Who_Monthly_Issue_83', '', 0, 1, 0),
(331, 'nl', '', 'Ruben', 0, '2020-06-10 19:29:08', 19, 'Companions', 3, 'Category:Companions', '0', 0, 1, 0),
(332, 'nl', '', 'Ruben', 0, '2020-06-18 22:53:08', 192, '(001-043) Doctor Who Weekly', 173, 'Doctor_Who_Weekly', '', 1, 1, 1),
(333, 'nl', '', 'Ruben', 0, '2020-06-18 22:53:18', 236, '(044-060) Doctor Who - A Marvel Monthly', 173, 'Doctor_Who_A_Marvel_Monthly', '', 1, 1, 2),
(334, 'nl', '', 'Ruben', 0, '2020-06-18 22:53:26', 259, '(061-084) Doctor Who - Monthly', 173, 'Doctor_Who_Monthly', '', 1, 1, 3),
(335, 'nl', '', 'Ruben', 0, '2020-06-18 22:53:38', 284, '(085-098) The Official Doctor Who Magazine', 173, 'The_Official_Doctor_Who_Magazine', '', 1, 1, 4),
(336, 'nl', '', 'Ruben', 0, '2020-06-18 22:53:47', 299, '(099-106) The Doctor Who Magazine', 173, 'The_Doctor_Who_Magazine', '', 1, 1, 5),
(337, 'nl', '', 'Ruben', 0, '2020-06-18 22:53:57', 308, '(107-...) Doctor Who Magazine', 173, 'Doctor_Who_Magazine', '', 1, 1, 6),
(338, 'nl', '', 'Ruben', 0, '2020-06-26 21:05:50', 193, 'Issue 001', 192, 'Issue_1_(Doctor_Who_Weekly)', '', 0, 1, 0),
(339, 'nl', '', 'Ruben', 0, '2020-06-26 21:06:02', 194, 'Issue 002', 192, 'Issue_2_(Doctor_Who_Weekly)', '', 0, 1, 0),
(340, 'nl', '', 'Ruben', 0, '2020-06-26 21:08:25', 195, 'Issue 003', 192, 'Issue_3_(Doctor_Who_Weekly)', '', 0, 1, 0),
(341, 'nl', '', 'Ruben', 0, '2020-06-26 21:09:22', 195, 'Issue 003', 192, 'Issue_3_(Doctor_Who_Weekly)', '', 0, 1, 0),
(342, 'nl', '', 'Ruben', 0, '2020-06-26 21:09:31', 196, 'Issue 004', 192, 'Issue_4_(Doctor_Who_Weekly)', '', 0, 1, 0),
(343, 'nl', '', 'Ruben', 0, '2020-06-26 21:09:42', 197, 'Issue 005', 192, 'Issue_5_(Doctor_Who_Weekly)', '', 0, 1, 0),
(344, 'nl', '', 'Ruben', 0, '2020-06-26 21:09:53', 198, 'Issue 006', 192, 'Issue_6_(Doctor_Who_Weekly)', '', 0, 1, 0),
(345, 'nl', '', 'Ruben', 0, '2020-06-26 21:10:48', 199, 'Issue 007', 192, 'Issue_7_(Doctor_Who_Weekly)', '', 0, 1, 0),
(346, 'nl', '', 'Ruben', 0, '2020-06-26 21:11:02', 200, 'Issue 008', 192, 'Issue_8_(Doctor_Who_Weekly)', '', 0, 1, 0),
(347, 'nl', '', 'Ruben', 0, '2020-06-26 21:22:41', 201, 'Issue 009', 192, 'Issue_9_(Doctor_Who_Weekly)', '', 0, 1, 0),
(348, 'nl', '', 'Ruben', 0, '2020-06-26 21:22:52', 202, 'Issue 010', 192, 'Issue_10_(Doctor_Who_Weekly)', '', 0, 1, 0),
(349, 'nl', '', 'Ruben', 0, '2020-06-26 21:24:17', 203, 'Issue 011', 192, 'Issue_11_(Doctor_Who_Weekly)', '', 0, 1, 0),
(350, 'nl', '', 'Ruben', 0, '2020-06-26 21:24:30', 204, 'Issue 012', 192, 'Issue_12_(Doctor_Who_Weekly)', '', 0, 1, 0),
(351, 'nl', '', 'Ruben', 0, '2020-06-26 21:24:41', 205, 'Issue 013', 192, 'Issue_13_(Doctor_Who_Weekly)', '', 0, 1, 0),
(352, 'nl', '', 'Ruben', 0, '2020-06-26 21:28:41', 206, 'Issue 014', 192, 'Issue_14_(Doctor_Who_Weekly)', '', 0, 1, 0),
(353, 'nl', '', 'Ruben', 0, '2020-06-26 21:28:54', 207, 'Issue 015', 192, 'Issue_15_(Doctor_Who_Weekly)', '', 0, 1, 0),
(354, 'nl', '', 'Ruben', 0, '2020-06-26 21:29:07', 208, 'Issue 016', 192, 'Issue_16_(Doctor_Who_Weekly)', '', 0, 1, 0),
(355, 'nl', '', 'Ruben', 0, '2020-06-26 21:29:18', 209, 'Issue 017', 192, 'Issue_17_(Doctor_Who_Weekly)', '', 0, 1, 0),
(356, 'nl', '', 'Ruben', 0, '2020-06-26 21:29:51', 210, 'Issue 018', 192, 'Issue_18_(Doctor_Who_Weekly)', '', 0, 1, 0),
(357, 'nl', '', 'Ruben', 0, '2020-06-26 21:30:01', 211, 'Issue 019', 192, 'Issue_19_(Doctor_Who_Weekly)', '', 0, 1, 0),
(358, 'nl', '', 'Ruben', 0, '2020-06-26 21:30:10', 212, 'Issue 020', 192, 'Issue_20_(Doctor_Who_Weekly)', '', 0, 1, 0),
(359, 'nl', '', 'Ruben', 0, '2020-06-27 17:52:30', 213, 'Issue 021', 192, 'Issue_21_(Doctor_Who_Weekly)', '', 0, 1, 0),
(360, 'nl', '', 'Ruben', 0, '2020-06-27 17:52:43', 214, 'Issue 022', 192, 'Issue_22_(Doctor_Who_Weekly)', '', 0, 1, 0),
(361, 'nl', '', 'Ruben', 0, '2020-06-27 17:57:20', 215, 'Issue 023', 192, 'Issue_23_(Doctor_Who_Weekly)', '', 0, 1, 0),
(362, 'nl', '', 'Ruben', 0, '2020-06-27 17:57:28', 216, 'Issue 024', 192, 'Issue_24_(Doctor_Who_Weekly)', '', 0, 1, 0),
(363, 'nl', '', 'Ruben', 0, '2020-06-27 20:51:03', 217, 'Issue 025', 192, 'Issue_25_(Doctor_Who_Weekly)', '', 0, 1, 0),
(364, 'nl', '', 'Ruben', 0, '2020-06-27 20:54:37', 217, 'Issue 025', 192, 'Issue_25_(Doctor_Who_Weekly)', '', 0, 1, 0),
(365, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:05', 218, 'Issue 026', 192, 'Issue_26_(Doctor_Who_Weekly)', '', 0, 1, 0),
(366, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:13', 219, 'Issue 027', 192, 'Issue_27_(Doctor_Who_Weekly)', '', 0, 1, 0),
(367, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:20', 220, 'Issue 028', 192, 'Issue_28_(Doctor_Who_Weekly)', '', 0, 1, 0),
(368, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:29', 221, 'Issue 029', 192, 'Issue_29_(Doctor_Who_Weekly)', '', 0, 1, 0),
(369, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:38', 222, 'Issue 030', 192, 'Issue_30_(Doctor_Who_Weekly)', '', 0, 1, 0),
(370, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:53', 222, 'Issue 030', 192, 'Issue_30_(Doctor_Who_Weekly)', '', 0, 1, 0),
(371, 'nl', '', 'Ruben', 0, '2020-06-27 21:21:59', 223, 'Issue 031', 192, 'Issue_31_(Doctor_Who_Weekly)', '', 0, 1, 0),
(372, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:08', 224, 'Issue 032', 192, 'Issue_32_(Doctor_Who_Weekly)', '', 0, 1, 0),
(373, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:16', 225, 'Issue 033', 192, 'Issue_33_(Doctor_Who_Weekly)', '', 0, 1, 0),
(374, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:23', 226, 'Issue 034', 192, 'Issue_34_(Doctor_Who_Weekly)', '', 0, 1, 0),
(375, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:31', 227, 'Issue 035', 192, 'Issue_35_(Doctor_Who_Weekly)', '', 0, 1, 0),
(376, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:39', 228, 'Issue 036', 192, 'Issue_36_(Doctor_Who_Weekly)', '', 0, 1, 0),
(377, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:44', 229, 'Issue 037', 192, 'Issue_37_(Doctor_Who_Weekly)', '', 0, 1, 0),
(378, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:51', 230, 'Issue 038', 192, 'Issue_38_(Doctor_Who_Weekly)', '', 0, 1, 0),
(379, 'nl', '', 'Ruben', 0, '2020-06-27 21:22:59', 231, 'Issue 039', 192, 'Issue_39_(Doctor_Who_Weekly)', '', 0, 1, 0),
(380, 'nl', '', 'Ruben', 0, '2020-06-27 21:23:06', 232, 'Issue 040', 192, 'Issue_40_(Doctor_Who_Weekly)', '', 0, 1, 0),
(381, 'nl', '', 'Ruben', 0, '2020-06-27 21:23:16', 233, 'Issue 041', 192, 'Issue_41_(Doctor_Who_Weekly)', '', 0, 1, 0),
(382, 'nl', '', 'Ruben', 0, '2020-06-27 21:23:22', 234, 'Issue 042', 192, 'Issue_42_(Doctor_Who_Weekly)', '', 0, 1, 0),
(383, 'nl', '', 'Ruben', 0, '2020-06-27 21:23:28', 235, 'Issue 043', 192, 'Issue_43_(Doctor_Who_Weekly)', '', 0, 1, 0),
(384, 'nl', '', 'Ruben', 0, '2020-07-07 11:02:20', 80, 'Season 01 (1963-1964)', 24, 'Season_1_(Classic_Who)', '0', 1, 1, 0),
(385, 'nl', '', 'Ruben', 0, '2020-07-07 11:02:28', 81, 'Season 02 (1964-1965)', 24, 'Season_2_(Classic_Who)', '0', 1, 1, 0),
(386, 'nl', '', 'Ruben', 0, '2020-07-07 11:02:36', 82, 'Season 03 (1965-1966)', 24, 'Season_3_(Classic_Who)', '0', 1, 1, 0),
(387, 'nl', '', 'Ruben', 0, '2020-07-07 11:02:45', 83, 'Season 04 (1966-1967)', 24, 'Season_4_(Classic_Who)', '0', 1, 1, 0),
(388, 'nl', '', 'Ruben', 0, '2020-07-07 11:02:53', 96, 'Season 05 (1967-1968)', 24, 'Season_5_(Classic_Who)', '0', 1, 1, 0),
(389, 'nl', '', 'Ruben', 0, '2020-07-07 11:03:04', 97, 'Season 06 (1968-1969)', 24, 'Season_6_(Classic_Who)', '0', 1, 1, 0),
(390, 'nl', '', 'Ruben', 0, '2020-07-07 11:09:24', 98, 'Season 07 (1970)', 24, 'Season_7_(Classic_Who)', '0', 1, 1, 0),
(391, 'nl', '', 'Ruben', 0, '2020-07-07 11:09:33', 99, 'Season 08 (1971)', 24, 'Season_8_(Classic_Who)', '0', 1, 1, 0),
(392, 'nl', '', 'Ruben', 0, '2020-07-07 11:10:14', 100, 'Season 09 (1972)', 24, 'Season_9_(Classic_Who)', '0', 1, 1, 0),
(393, 'nl', '', 'Ruben', 0, '2020-07-07 11:10:48', 101, 'Season 10 (1972-1973)', 24, 'Season_10_(Classic_Who)', '0', 1, 1, 0),
(394, 'nl', '', 'Ruben', 0, '2020-07-07 11:10:54', 102, 'Season 11 (1973-1974)', 24, 'Season_11_(Classic_Who)', '0', 1, 1, 0),
(395, 'nl', '', 'Ruben', 0, '2020-07-07 11:11:03', 103, 'Season 12 (1974-1975)', 24, 'Season_12_(Classic_Who)', '0', 1, 1, 0),
(396, 'nl', '', 'Ruben', 0, '2020-07-07 11:11:10', 104, 'Season 13 (1975-1976)', 24, 'Season_13_(Classic_Who)', '0', 1, 1, 0),
(397, 'nl', '', 'Ruben', 0, '2020-07-07 11:11:47', 105, 'Season 14 (1976-1977)', 24, 'Season_14_(Classic_Who)', '0', 1, 1, 0),
(398, 'nl', '', 'Ruben', 0, '2020-07-07 11:11:52', 106, 'Season 15 (1977-1978)', 24, 'Season_15_(Classic_Who)', '0', 1, 1, 0),
(399, 'nl', '', 'Ruben', 0, '2020-07-07 11:12:01', 107, 'Season 16 (1978-1979)', 24, 'Season_16_(Classic_Who)', '0', 1, 1, 0),
(400, 'nl', '', 'Ruben', 0, '2020-07-07 11:12:04', 108, 'Season 17 (1979-1980)', 24, 'Season_17_Classi', '0', 1, 1, 0),
(401, 'nl', '', 'Ruben', 0, '2020-07-07 11:12:08', 109, 'Season 18 (1980-1981)', 24, 'Season_18_(Classic_Who)', '0', 1, 1, 0),
(402, 'nl', '', 'Ruben', 0, '2020-07-07 11:12:34', 108, 'Season 17 (1979-1980)', 24, 'Season_17_(Classic_Who)', '0', 1, 1, 0),
(403, 'nl', '', 'Ruben', 0, '2020-07-07 11:12:45', 110, 'Season 19 (1982)', 24, 'Season_19_(Classic_Who)', '0', 1, 1, 0),
(404, 'nl', '', 'Ruben', 0, '2020-07-07 11:12:50', 111, 'Season 20 (1983)', 24, 'Season_20_(Classic_Who)', '0', 1, 1, 0),
(405, 'nl', '', 'Ruben', 0, '2020-07-07 11:13:08', 113, 'Season 22 (1985)', 24, 'Season_22_(Classic_Who)', '0', 1, 1, 0),
(406, 'nl', '', 'Ruben', 0, '2020-07-07 11:13:16', 112, 'Season 21 (1984)', 24, 'Season_21_(Classic_Who)', '0', 1, 1, 0),
(407, 'nl', '', 'Ruben', 0, '2020-07-07 11:13:32', 114, 'Season 23 (1986)', 24, 'Season_23_(Classic_Who)', '0', 1, 1, 0),
(408, 'nl', '', 'Ruben', 0, '2020-07-07 11:13:38', 115, 'Season 24 (1987)', 24, 'Season_24_(Classic_Who)', '0', 1, 1, 0),
(409, 'nl', '', 'Ruben', 0, '2020-07-07 11:13:48', 116, 'Season 25 (1988-1989)', 24, 'Season_25_(Classic_Who)', '0', 1, 1, 0),
(410, 'nl', '', 'Ruben', 0, '2020-07-07 11:13:53', 117, 'Season 26 (1989)', 24, 'Season_26_(Classic_Who)', '0', 1, 1, 0),
(411, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:20', 119, 'Series 01 (2005)', 25, 'Series_1_(New_Who)', '0', 1, 1, 0),
(412, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:27', 120, 'Series 02 (2006)', 25, 'Series_2_(New_Who)', '0', 1, 1, 0),
(413, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:35', 121, 'Series 03 (2007)', 25, 'Series_3_(New_Who)', '0', 1, 1, 0),
(414, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:40', 122, 'Series 04 + Specials (2008-2010)', 25, 'Series_4_(New_Who)', '0', 1, 1, 0),
(415, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:44', 123, 'Series 05 (2010)', 25, 'Series_5_(New_Who)', '0', 1, 1, 0),
(416, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:48', 124, 'Series 06 (2011)', 25, 'Series_6_(New_Who)', '0', 1, 1, 0),
(417, 'nl', '', 'Ruben', 0, '2020-07-07 11:38:53', 125, 'Series 07 + Specials (2012-2013)', 25, 'Series_7_(New_Who)', '0', 1, 1, 0),
(418, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:03', 126, 'Series 08 (2014)', 25, 'Series_8_(New_Who)', '0', 1, 1, 0),
(419, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:08', 127, 'Series 09 (2015)', 25, 'Series_9_(New_Who)', '0', 1, 1, 0),
(420, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:13', 128, 'Series 10 (2017)', 25, 'Series_10_(New_Who)', '0', 1, 1, 0),
(421, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:16', 128, 'Series 10 (2017)', 25, 'Series_10_(New_Who)', '0', 1, 1, 0),
(422, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:23', 1464, 'Series 11', 25, 'Series_11_(New_Who)', '0', 1, 1, 0),
(423, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:27', 1560, 'Series 12', 25, 'Series_12_(New_Who)', '0', 1, 1, 0),
(424, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:36', 1560, 'Series 12', 25, 'Series_12_(New_Who)', '0', 1, 1, 12),
(425, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:44', 1464, 'Series 11', 25, 'Series_11_(New_Who)', '0', 1, 1, 11),
(426, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:50', 1089, 'Minisodes', 25, 'Minisodes', '0', 1, 1, 800),
(427, 'nl', '', 'Ruben', 0, '2020-07-07 11:39:56', 128, 'Series 10 (2017)', 25, 'Series_10_(New_Who)', '0', 1, 1, 10);
INSERT INTO `Topics__history` (`history__id`, `history__language`, `history__comments`, `history__user`, `history__state`, `history__modified`, `id`, `topic`, `parent_id`, `link`, `MagEditeren`, `Uitklapbaar`, `Actief`, `Episode_Order`) VALUES
(428, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:03', 127, 'Series 09 (2015)', 25, 'Series_9_(New_Who)', '0', 1, 1, 9),
(429, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:08', 126, 'Series 08 (2014)', 25, 'Series_8_(New_Who)', '0', 1, 1, 8),
(430, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:15', 125, 'Series 07 + Specials (2012-2013)', 25, 'Series_7_(New_Who)', '0', 1, 1, 7),
(431, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:20', 124, 'Series 06 (2011)', 25, 'Series_6_(New_Who)', '0', 1, 1, 6),
(432, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:28', 123, 'Series 05 (2010)', 25, 'Series_5_(New_Who)', '0', 1, 1, 5),
(433, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:34', 122, 'Series 04 + Specials (2008-2010)', 25, 'Series_4_(New_Who)', '0', 1, 1, 4),
(434, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:39', 121, 'Series 03 (2007)', 25, 'Series_3_(New_Who)', '0', 1, 1, 3),
(435, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:46', 120, 'Series 02 (2006)', 25, 'Series_2_(New_Who)', '0', 1, 1, 2),
(436, 'nl', '', 'Ruben', 0, '2020-07-07 11:40:50', 119, 'Series 01 (2005)', 25, 'Series_1_(New_Who)', '0', 1, 1, 1),
(437, 'nl', '', 'Ruben', 0, '2020-07-07 11:42:39', 1602, 'Series 04 (2008-2010)', 25, 'Series_4_Specials_(New_Who)', '0', 1, 1, 5),
(438, 'nl', '', 'Ruben', 0, '2020-07-07 11:43:24', 122, 'Series 04 (2008)', 25, 'Series_4_(New_Who)', '0', 1, 1, 4),
(439, 'nl', '', 'Ruben', 0, '2020-07-07 11:44:04', 1602, 'Series 04 Specials (2008-2010)', 25, 'Series_4_Specials_(New_Who)', '0', 1, 1, 5),
(440, 'nl', '', 'Ruben', 0, '2020-07-07 11:45:00', 1084, 'The Next Doctor (Special)', 1602, 'The_Next_Doctor_(TV_Story)', '', 0, 1, 14000),
(441, 'nl', '', 'Ruben', 0, '2020-07-07 11:45:00', 1085, 'Planet of the Dead (Special)', 1602, 'Planet_of_the_Dead_(TV_Story)', '', 0, 1, 15000),
(442, 'nl', '', 'Ruben', 0, '2020-07-07 11:45:00', 1086, 'The Waters of Mars (Special)', 1602, 'The_Waters_of_Mars_(TV_Story)', '', 0, 1, 16000),
(443, 'nl', '', 'Ruben', 0, '2020-07-07 11:45:00', 1087, 'The End of Time (Special)', 1602, 'The_End_of_Time_(TV_Story)', '', 0, 1, 17000),
(444, 'nl', '', 'Ruben', 0, '2020-07-07 11:52:59', 125, 'Series 07 (2012-2013)', 25, 'Series_7_(New_Who)', '0', 1, 1, 7),
(445, 'nl', '', 'Ruben', 0, '2020-07-07 11:53:34', 1603, 'Series 7 Specials (2012-2013)', 25, 'Series_7_Specials_(New_Who)', '0', 1, 1, 8),
(446, 'nl', '', 'Ruben', 0, '2020-07-07 11:54:27', 1135, 'The Day of the Doctor (Special)', 1603, 'The_Day_of_the_Doctor_(TV_Story)', '', 0, 1, 15000),
(447, 'nl', '', 'Ruben', 0, '2020-07-07 11:54:27', 1136, 'The Time of the Doctor (Special)', 1603, 'The_Time_of_the_Doctor_(TV_Story)', '', 0, 1, 16000),
(448, 'nl', '', 'Ruben', 0, '2020-07-07 11:54:59', 1603, 'Series 7 Specials (2013)', 25, 'Series_7_Specials_(New_Who)', '0', 1, 1, 8),
(449, 'nl', '', 'Ruben', 0, '2020-07-07 11:59:43', 1602, 'Series 4 Specials (2008-2010)', 25, 'Series_4_Specials_(New_Who)', '0', 1, 1, 5),
(450, 'nl', '', 'Ruben', 0, '2020-07-07 11:59:53', 127, 'Series 9 (2015)', 25, 'Series_9_(New_Who)', '0', 1, 1, 9),
(451, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:02', 126, 'Series 8 (2014)', 25, 'Series_8_(New_Who)', '0', 1, 1, 8),
(452, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:07', 125, 'Series 7 (2012-2013)', 25, 'Series_7_(New_Who)', '0', 1, 1, 7),
(453, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:12', 124, 'Series 6 (2011)', 25, 'Series_6_(New_Who)', '0', 1, 1, 6),
(454, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:16', 123, 'Series 5 (2010)', 25, 'Series_5_(New_Who)', '0', 1, 1, 5),
(455, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:21', 122, 'Series 4 (2008)', 25, 'Series_4_(New_Who)', '0', 1, 1, 4),
(456, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:25', 121, 'Series 3 (2007)', 25, 'Series_3_(New_Who)', '0', 1, 1, 3),
(457, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:32', 120, 'Series 2 (2006)', 25, 'Series_2_(New_Who)', '0', 1, 1, 2),
(458, 'nl', '', 'Ruben', 0, '2020-07-07 12:00:36', 119, 'Series 1 (2005)', 25, 'Series_1_(New_Who)', '0', 1, 1, 1),
(459, 'nl', '', 'Ruben', 0, '2020-07-07 12:01:42', 80, 'Season 1 (1963-1964)', 24, 'Season_1_(Classic_Who)', '0', 1, 1, 0),
(460, 'nl', '', 'Ruben', 0, '2020-07-07 12:01:47', 81, 'Season 2 (1964-1965)', 24, 'Season_2_(Classic_Who)', '0', 1, 1, 0),
(461, 'nl', '', 'Ruben', 0, '2020-07-07 12:01:52', 82, 'Season 3 (1965-1966)', 24, 'Season_3_(Classic_Who)', '0', 1, 1, 0),
(462, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:01', 83, 'Season 4 (1966-1967)', 24, 'Season_4_(Classic_Who)', '0', 1, 1, 0),
(463, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:06', 96, 'Season 5 (1967-1968)', 24, 'Season_5_(Classic_Who)', '0', 1, 1, 0),
(464, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:10', 97, 'Season 6 (1968-1969)', 24, 'Season_6_(Classic_Who)', '0', 1, 1, 0),
(465, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:18', 98, 'Season 7 (1970)', 24, 'Season_7_(Classic_Who)', '0', 1, 1, 0),
(466, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:22', 99, 'Season 8 (1971)', 24, 'Season_8_(Classic_Who)', '0', 1, 1, 0),
(467, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:27', 100, 'Season 9 (1972)', 24, 'Season_9_(Classic_Who)', '0', 1, 1, 0),
(468, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:48', 80, 'Season 1 (1963-1964)', 24, 'Season_1_(Classic_Who)', '0', 1, 1, 1),
(469, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:53', 81, 'Season 2 (1964-1965)', 24, 'Season_2_(Classic_Who)', '0', 1, 1, 2),
(470, 'nl', '', 'Ruben', 0, '2020-07-07 12:02:59', 82, 'Season 3 (1965-1966)', 24, 'Season_3_(Classic_Who)', '0', 1, 1, 3),
(471, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:04', 83, 'Season 4 (1966-1967)', 24, 'Season_4_(Classic_Who)', '0', 1, 1, 4),
(472, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:09', 96, 'Season 5 (1967-1968)', 24, 'Season_5_(Classic_Who)', '0', 1, 1, 5),
(473, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:13', 97, 'Season 6 (1968-1969)', 24, 'Season_6_(Classic_Who)', '0', 1, 1, 6),
(474, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:17', 98, 'Season 7 (1970)', 24, 'Season_7_(Classic_Who)', '0', 1, 1, 7),
(475, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:21', 99, 'Season 8 (1971)', 24, 'Season_8_(Classic_Who)', '0', 1, 1, 8),
(476, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:25', 100, 'Season 9 (1972)', 24, 'Season_9_(Classic_Who)', '0', 1, 1, 9),
(477, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:30', 101, 'Season 10 (1972-1973)', 24, 'Season_10_(Classic_Who)', '0', 1, 1, 10),
(478, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:35', 102, 'Season 11 (1973-1974)', 24, 'Season_11_(Classic_Who)', '0', 1, 1, 11),
(479, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:40', 103, 'Season 12 (1974-1975)', 24, 'Season_12_(Classic_Who)', '0', 1, 1, 12),
(480, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:45', 104, 'Season 13 (1975-1976)', 24, 'Season_13_(Classic_Who)', '0', 1, 1, 13),
(481, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:50', 105, 'Season 14 (1976-1977)', 24, 'Season_14_(Classic_Who)', '0', 1, 1, 14),
(482, 'nl', '', 'Ruben', 0, '2020-07-07 12:03:55', 106, 'Season 15 (1977-1978)', 24, 'Season_15_(Classic_Who)', '0', 1, 1, 15),
(483, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:00', 107, 'Season 16 (1978-1979)', 24, 'Season_16_(Classic_Who)', '0', 1, 1, 16),
(484, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:06', 108, 'Season 17 (1979-1980)', 24, 'Season_17_(Classic_Who)', '0', 1, 1, 17),
(485, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:11', 109, 'Season 18 (1980-1981)', 24, 'Season_18_(Classic_Who)', '0', 1, 1, 18),
(486, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:17', 110, 'Season 19 (1982)', 24, 'Season_19_(Classic_Who)', '0', 1, 1, 19),
(487, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:21', 111, 'Season 20 (1983)', 24, 'Season_20_(Classic_Who)', '0', 1, 1, 20),
(488, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:26', 112, 'Season 21 (1984)', 24, 'Season_21_(Classic_Who)', '0', 1, 1, 21),
(489, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:31', 113, 'Season 22 (1985)', 24, 'Season_22_(Classic_Who)', '0', 1, 1, 22),
(490, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:36', 114, 'Season 23 (1986)', 24, 'Season_23_(Classic_Who)', '0', 1, 1, 23),
(491, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:42', 115, 'Season 24 (1987)', 24, 'Season_24_(Classic_Who)', '0', 1, 1, 24),
(492, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:47', 116, 'Season 25 (1988-1989)', 24, 'Season_25_(Classic_Who)', '0', 1, 1, 25),
(493, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:52', 117, 'Season 26 (1989)', 24, 'Season_26_(Classic_Who)', '0', 1, 1, 26),
(494, 'nl', '', 'Ruben', 0, '2020-07-07 12:04:57', 118, 'The Movie (1996)', 24, 'Doctor_Who_The_Movie', '0', 0, 1, 27),
(495, 'nl', '', 'Ruben', 0, '2020-07-07 12:05:51', 24, 'Classic Who', 28, 'Classic_Who', '0', 1, 1, 1),
(496, 'nl', '', 'Ruben', 0, '2020-07-07 12:06:08', 25, 'New Who', 28, 'New_Who', '0', 1, 1, 1000),
(497, 'nl', '', 'Ruben', 0, '2020-07-19 21:02:08', 1337, 'Axis', 1336, 'Axis', 'Nee', 0, 1, 0),
(498, 'nl', '', 'Ruben', 0, '2020-07-19 21:02:19', 1338, 'Cauterised time', 1336, 'Cauterised_time', 'Nee', 0, 1, 0),
(499, 'nl', '', 'Ruben', 0, '2020-07-19 21:02:29', 1339, 'Conceptual space', 1336, 'Conceptual_space', 'Nee', 0, 1, 0),
(500, 'nl', '', 'Ruben', 0, '2020-07-19 21:02:37', 1340, 'Time bubble', 1336, 'Time_Bubble', 'Nee', 0, 1, 0),
(501, 'nl', '', 'Ruben', 0, '2020-09-21 11:54:21', 1604, 'What is the timeline from the Doctor\'s viewpoint?', 1574, 'What_Is_The_Timeline_From_The_Doctor_s_Viewpoint', '0', 0, 1, 0),
(502, 'nl', '', 'Ruben', 0, '2020-09-22 21:35:37', 1605, 'Issue 552', 308, '', 'Nee', 0, 1, 0),
(503, 'nl', '', 'Ruben', 0, '2020-09-22 21:35:37', 1606, 'Issue 553', 308, '', 'Nee', 0, 1, 0),
(504, 'nl', '', 'Ruben', 0, '2020-09-22 21:35:37', 1607, 'Issue 554', 308, '', 'Nee', 0, 1, 0),
(505, 'nl', '', 'Ruben', 0, '2020-09-22 21:35:37', 1608, 'Issue 555', 308, '', 'Nee', 0, 1, 0),
(506, 'nl', '', 'Ruben', 0, '2020-09-22 21:35:37', 1609, 'Issue 556', 308, '', 'Nee', 0, 1, 0),
(507, 'nl', '', 'Ruben', 0, '2020-09-22 21:38:34', 1605, 'Issue 552', 308, 'Issue_552_(Doctor_Who_Magazine)', 'Nee', 0, 1, 0),
(508, 'nl', '', 'Ruben', 0, '2020-09-22 21:38:43', 1606, 'Issue 553', 308, 'Issue_553_(Doctor_Who_Magazine)', 'Nee', 0, 1, 0),
(509, 'nl', '', 'Ruben', 0, '2020-09-22 21:38:52', 1607, 'Issue 554', 308, 'Issue_554_(Doctor_Who_Magazine)', 'Nee', 0, 1, 0),
(510, 'nl', '', 'Ruben', 0, '2020-09-22 21:39:01', 1608, 'Issue 555', 308, 'Issue_555_(Doctor_Who_Magazine)', 'Nee', 0, 1, 0),
(511, 'nl', '', 'Ruben', 0, '2020-09-22 21:39:13', 1609, 'Issue 556', 308, 'Issue_556_(Doctor_Who_Magazine)', 'Nee', 0, 1, 0),
(512, 'nl', '', 'Ruben', 0, '2020-10-05 11:12:13', 45, 'John Benton', 1578, 'John_Benton', '0', 0, 1, 0),
(513, 'nl', '', 'Ruben', 0, '2020-10-05 11:15:47', 31, 'Vicki', 1578, 'Vicki', '0', 0, 1, 0),
(514, 'nl', '', 'Ruben', 0, '2020-10-05 11:17:01', 26, 'Susan Foreman', 143, 'Susan_Foreman', '0', 0, 1, 0),
(515, 'nl', '', 'Ruben', 0, '2020-10-05 11:17:43', 40, 'Zoe Heriot', 1578, 'Zoe_Heriot', '0', 0, 1, 0),
(516, 'nl', '', 'Ruben', 0, '2020-10-05 11:21:09', 46, 'Mike Yates', 1578, 'Mike_Yates', '0', 0, 1, 0),
(517, 'nl', '', 'Ruben', 0, '2020-10-05 11:21:23', 47, 'Harry Sullivan', 1578, 'Harry_Sullivan', '0', 0, 1, 0),
(518, 'nl', '', 'Ruben', 0, '2020-10-05 11:21:34', 48, 'Leela', 1578, 'Leela', '0', 0, 1, 0),
(519, 'nl', '', 'Ruben', 0, '2020-10-05 11:21:57', 52, 'Tegan Jovanka', 1578, 'Tegan_Jovanka', '0', 0, 1, 0),
(520, 'nl', '', 'Ruben', 0, '2020-10-05 11:22:18', 55, 'Kamelion', 1583, 'Kamelion', '0', 0, 1, 0),
(521, 'nl', '', 'Ruben', 0, '2020-10-05 11:22:48', 58, 'Ace', 1578, 'Ace', '0', 0, 1, 0),
(522, 'nl', '', 'Ruben', 0, '2020-10-05 11:23:25', 59, 'Grace Holloway', 1578, 'Grace_Holloway', '0', 0, 1, 0),
(523, 'nl', '', 'Ruben', 0, '2020-10-05 11:23:45', 60, 'Rose Tyler', 1578, 'Rose_Tyler', '0', 0, 1, 0),
(524, 'nl', '', 'Ruben', 0, '2020-10-10 16:40:42', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(525, 'nl', '', 'Ruben', 0, '2020-10-10 16:41:39', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(526, 'nl', '', 'Ruben', 0, '2020-10-10 16:41:57', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(527, 'nl', '', 'Ruben', 0, '2020-10-10 16:42:06', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(528, 'nl', '', 'Ruben', 0, '2020-10-10 16:42:07', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(529, 'nl', '', 'Ruben', 0, '2020-10-10 16:43:59', 77, 'Danny Pink', 1578, 'Danny_Pink', '0', 0, 1, 0),
(530, 'nl', '', 'Ruben', 0, '2020-10-10 16:44:26', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(531, 'nl', '', 'Ruben', 0, '2020-10-10 16:48:51', 78, 'Bill Potts', 1578, 'Bill_Potts', '0', 0, 1, 0),
(532, 'nl', '', 'Ruben', 0, '2020-10-10 16:49:17', 76, 'Clara &laquo;Oswin&raquo; Oswald', 1578, 'Clara_Oswald', '0', 0, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `User_Id` int(11) NOT NULL,
  `User_naam` varchar(50) NOT NULL,
  `User_Rol` int(11) NOT NULL,
  `User_Pass` varchar(255) NOT NULL,
  `User_email` varchar(200) NOT NULL,
  `Rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`User_Id`, `User_naam`, `User_Rol`, `User_Pass`, `User_email`, `Rol`) VALUES
(1, 'Ruben', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'ADMIN'),
(3, 'Tester', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'MODERATOR');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users__history`
--

CREATE TABLE `Users__history` (
  `history__id` int(11) NOT NULL,
  `history__language` varchar(2) DEFAULT NULL,
  `history__comments` text DEFAULT NULL,
  `history__user` varchar(32) DEFAULT NULL,
  `history__state` int(5) DEFAULT 0,
  `history__modified` datetime DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `User_naam` varchar(50) DEFAULT NULL,
  `User_Rol` int(11) DEFAULT NULL,
  `User_Pass` varchar(255) DEFAULT NULL,
  `User_email` varchar(200) DEFAULT NULL,
  `Rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Users__history`
--

INSERT INTO `Users__history` (`history__id`, `history__language`, `history__comments`, `history__user`, `history__state`, `history__modified`, `User_Id`, `User_naam`, `User_Rol`, `User_Pass`, `User_email`, `Rol`) VALUES
(1, 'nl', '', 'Ruben', 0, '2019-10-26 14:23:55', 2, 'test', 2, '6a117c1c8daea248caca1507b93ccb11', 'tes@tester.com', 'tester'),
(2, 'nl', '', 'Ruben', 0, '2020-10-02 10:22:19', 3, 'Tester', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'ADMIN'),
(3, 'nl', '', 'Ruben', 0, '2020-10-02 14:15:13', 3, 'Tester', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'USER'),
(4, 'nl', '', 'Ruben', 0, '2020-10-02 14:19:52', 3, 'Tester', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'MODERATOR'),
(5, 'nl', '', 'Ruben', 0, '2020-10-02 14:20:23', 3, 'Tester', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'USER'),
(6, 'nl', '', 'Ruben', 0, '2020-10-02 14:21:02', 3, 'Tester', 1, 'a822af7d22b4d7bfb39eb6bb204b77f1', 'rubendeburo@gmail.com', 'MODERATOR');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Videos`
--

CREATE TABLE `Videos` (
  `id` int(11) NOT NULL,
  `Video_Name` mediumtext NOT NULL,
  `Video_URL` longtext NOT NULL,
  `Video_Image` text NOT NULL,
  `Video_Beschrijving` longtext NOT NULL,
  `Video_Type` varchar(255) NOT NULL DEFAULT 'Youtube',
  `Spoiler` int(11) NOT NULL DEFAULT 0,
  `V_Owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Videos`
--

INSERT INTO `Videos` (`id`, `Video_Name`, `Video_URL`, `Video_Image`, `Video_Beschrijving`, `Video_Type`, `Spoiler`, `V_Owner`) VALUES
(1, 'River Song\'s Death - 2015 Version (HD)', 'https://www.youtube.com/embed/t-wgLFj6bbI', 'images/Videos/Death_Of_River_Song.jpg', 'A fantasic edit, made by \"<a href=\'https://www.youtube.com/channel/UCsh8ZXMh6u5cJ7J7oaOUrdg\' class=\'link\' target=\'blank\'>Lyndon Coleman</a>\", about River Song\'s death, including new footage from the 2015 Christmas Special: \"The Husbands of River Song\".', 'Youtube', 0, 1),
(2, 'Peter Capaldi\'s THANK YOU to our birthday video', 'https://www.youtube.com/embed/-G0NSofnJcg', 'images/Videos/Peter_Capaldi_Thank.jpg', 'Peter Capaldi received lots of greetings for his birthday, and he replied to them, he thanks them in their own language, even using Dutch and Sign Language.  Credits to the original uploader \"<a href=\'https://www.youtube.com/channel/UCu38L2L7_SkmE7GbybXqYuw\' class=\'link\' target=\'blank\'>Naz Enginler</a>\"', 'Youtube', 0, 1),
(3, 'Trailer: Family of Blood (Series 3)', 'https://www.youtube.com/embed/LS7KRFgJzic', 'images/Videos/Family_Of_Blood.jpg', 'Trailer for the series 3 episode \"Family of Blood\".', 'Youtube', 0, 1),
(4, 'Trailer series 10', 'https://www.youtube.com/embed/o3x4YF3EisE', 'images/Videos/Series_10.jpg', 'De trailer voor series 10, die op 15 april start.', 'Youtube', 0, 1),
(5, '!SPOILERS! Bill Enters The TARDIS For The First Time - The Pilot - Doctor Who: Series 10 - BBC - Original Clip', 'https://www.youtube.com/embed/oM4VPJJ4yrs', 'images/Videos/Bill1.jpg', 'Exclusieve sneak peek, van de eerste aflevering van Doctor Who: Series 10, waar Bill Potts kennismaakt met een wereld voorbij haar stoutste dromen.\r\n\r\nDoctor who Series 10 start op 15 april om 20:20 Belgische tijd op BBC One', 'Youtube', 0, 1),
(6, 'The Doctor and Rose say Goodbye - Doomsday -Series 2', 'https://www.youtube.com/embed/5wdj16x6LYc', 'images/Videos/RoseGoodbye.jpg', '', 'Youtube', 0, 1),
(7, 'Doctor Who: Regeneration (All The Doctor\'s Regenerations 1963 - 2010)\r\n', 'https://www.youtube.com/embed/uXCpY_3Sac8', 'images/Videos/ValeDecem.jpg', '', 'Youtube', 0, 1),
(8, 'River\'s Sacrifice - Forest of the Dead - Doctor Who - BBC', 'https://www.youtube.com/embed/z8Yssg1FBYg', 'images/Videos/DeathOFRS.jpg', '', 'Youtube', 0, 1),
(9, 'River Song - Her Story', 'https://www.youtube.com/embed/SOYzrnOegcg', 'images/Videos/herstory.jpg', '', 'Youtube', 0, 1),
(10, 'Rings of Akhaten Speech - The Rings of Akhaten - Doctor Who - BBC', 'https://www.youtube.com/embed/GoVLhUxhdSw', 'images/Videos/roas.jpg', '', 'Youtube', 0, 1),
(11, 'Twice Upon A Time Trailer', 'https://www.youtube.com/embed/oGDbeZ0HJBQ?showinfo=0\"', 'images/Videos/maxresdefault.jpg', '', 'Youtube', 0, 1),
(12, 'The Night of the Doctor: A Mini Episode - The Day of the Doctor Prequel - Doctor Who - BBC', 'https://www.youtube.com/embed/EobSTIc-ywA', 'images/Videos/NOTD.jpg', '', 'Youtube', 0, 1),
(13, 'The First Doctor Enters The Twelfth Doctor\'s TARDIS - Christmas Special Preview - Doctor Who - BBC', 'https://www.youtube.com/embed/IkWxMG-JDk4', 'images/Videos/tuat.jpg', '', 'Youtube', 0, 1),
(14, 'Everybody Lives? ', '//www.youtube.com/embed/O7mv8FSJDnQ', 'images/Videos/everybody_Lives.jpg', '', 'Youtube', 0, 1),
(15, 'Mummy on the Orient Express', '//www.youtube.com/embed/BndH-iC-3eo', 'images/Videos/motoe.jpg', '', 'Youtube', 0, 1),
(16, 'The Eleventh Doctor Regenerates - Matt Smith to Peter Capaldi - Doctor Who - BBC', '//www.youtube.com/embed/4F84WapAH7M', 'images/Videos/11t12.jpg', '', 'Youtube', 0, 1),
(17, 'The Two Doctors - Journey\'s End - Doctor Who - BBC', '//www.youtube.com/embed/-3mXfHS-6k8', 'images/Videos/ttdje.jpg', '', 'Youtube', 0, 1),
(18, 'The Two Doctors Become Three! - Journey\'s End - Doctor Who - BBC', '//www.youtube.com/embed/adtp8ekgNlk', 'images/Videos/ttdbtje.jpg', '', 'Youtube', 0, 1),
(19, 'The God Maker - School Reunion - Doctor Who - BBC', 'https://www.youtube.com/embed/uMY09ocCykQ', 'images/Videos/tgmsr.jpg', '', 'Youtube', 0, 1),
(20, 'The Doctor: A new kind of Hero.', 'Video/A_Different_Kind_Of_Hero.mp4', 'images/Videos/adkofjpg.jpg', '', 'Own', 0, 1),
(21, 'Happy Doctor Who Day From Tom Baker! - Doctor Who', 'https://www.youtube.com/embed/sALsW-aWIdE', 'images/Videos/happy-doctor-who-day-from-tom-ba.jpg', '', 'Youtube', 0, 1),
(22, 'The Doctors Reunite - Doctor Who - The Five Doctors - BBC', 'https://www.youtube.com/embed/80-_FD4OGyI', 'images/Videos/tdr.jpg', '', 'Youtube', 0, 1),
(23, 'Twice Upon A Time Introduction - Doctor Who', 'https://www.youtube.com/embed/ZaiY_4gjlJ8', 'images/Videos/ITTUAT.jpg', '', 'Youtube', 0, 1),
(24, 'Naked Christmas - Doctor Who - The Time of the Doctor - BBC', 'https://www.youtube.com/embed/Ei2quMm4qHk', 'images/Videos/NC.jpg', '', 'Youtube', 0, 1),
(25, 'Doctor Who Funniest Lines [Series Five Edition]', 'https://www.youtube.com/embed/K8wLSlgPjg8', 'images/Videos/DWFLS5E.jpg', '', 'Youtube', 0, 1),
(26, 'MATT SMITH & DAVID TENNANT Answer Whovian Fans\' Questions - THE GRAHAM NORTON SHOW on BBC America\r\n', 'https://www.youtube.com/embed/zi7K22QRaUM', 'images/Videos/MSDTAWQGNS.jpg', '', 'Youtube', 0, 1),
(27, 'Doctor Who Series 5 FULL Outtakes HD', 'https://www.youtube.com/embed/gaWGyOwNIC0', 'images/Videos/DWS5FO.jpg', '', 'Youtube', 0, 1),
(28, 'The TARDIS Shrinks - Flatline - Doctor Who - BBC', 'https://www.youtube.com/embed/KClVIBAoyFk', 'images/Videos/TTS.jpg', '', 'Youtube', 0, 1),
(29, 'Doctor Who - The Doctor Shoots The General To Save Clara', 'https://www.youtube.com/embed/DoGCHnIX6AU', 'images/Videos/TDSTGTSC.jpg', '', 'Youtube', 0, 1),
(30, 'David Tennant Returns as The Tenth Doctor with Georgia Moffett - Doctor Who (@georgiaEtennant)', 'https://www.youtube.com/embed/E5bOvjE_3dQ', 'images/Videos/DTRATDWHWGM.jpg', '', 'Youtube', 0, 1);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `V_aantalItemsPerPagina`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `V_aantalItemsPerPagina` (
`pagina` mediumtext
,`Aantal_elem` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `V_Actieve_Content`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `V_Actieve_Content` (
`A_ID` int(11)
,`A_Pagina` text
,`A_Pagina_Type` varchar(500)
,`A_Type` varchar(500)
,`A_Waarde` longtext
,`A_level` decimal(19,4)
,`A_Actief` tinyint(3)
,`A_TIMESTAMP` timestamp
,`A_Klasse` varchar(55)
,`A_Taal` varchar(20)
,`A_Hoort_Bij` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `V_children`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `V_children` (
`id` int(11)
,`topic` text
,`link` text
,`parent_id` int(11)
,`direct_children` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `V_missing_pages`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `V_missing_pages` (
`A_Pagina` int(11)
,`A_WAARDE` longtext
,`link` text
,`topic` text
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `V_missin_titles`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `V_missin_titles` (
`A_ID` int(11)
,`A_Pagina` text
,`A_WAARDE` longtext
,`ID` int(11)
,`link` text
,`topic` text
);

-- --------------------------------------------------------

--
-- Structuur voor de view `Content`
--
DROP TABLE IF EXISTS `Content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `Content`  AS  select distinct `alles`.`id` AS `A_ID`,`Topics`.`link` AS `A_Pagina`,`Topics`.`topic` AS `A_Pagina_Title`,`L_Pagina_Types`.`LPT_Naam` AS `A_Pagina_Type`,`L_Types`.`LT_Naam` AS `A_Type`,`alles`.`A_Waarde` AS `A_Waarde`,if(`alles`.`A_Level` = 0,`L_Types`.`LT_Default_Level`,`alles`.`A_Level`) AS `A_level`,`alles`.`A_Actief` AS `A_Actief`,`alles`.`A_TIMESTAMP` AS `A_TIMESTAMP`,`alles`.`A_Klasse` AS `A_Klasse`,`talen`.`taal_naam` AS `A_Taal`,`alles`.`A_Hoort_Bij` AS `A_Hoort_Bij` from (((((`alles` join `Topics` on(`alles`.`A_Pagina` = `Topics`.`id`)) join `L_Pagina_Types` on(`L_Pagina_Types`.`LPT_Id` = `alles`.`A_Pagina_Type`)) join `L_Types` on(`L_Types`.`LT_Id` = `alles`.`A_Type`)) join `items_talen` on(`items_talen`.`item_id` = `alles`.`id`)) join `talen` on(`items_talen`.`taal_id` = `talen`.`taal_id`)) order by `alles`.`id` ;

-- --------------------------------------------------------

--
-- Structuur voor de view `dataface__view_29687dbf9507a661b4cbe57bef87dce0`
--
DROP TABLE IF EXISTS `dataface__view_29687dbf9507a661b4cbe57bef87dce0`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `dataface__view_29687dbf9507a661b4cbe57bef87dce0`  AS  select `alles`.`id` AS `id`,`alles`.`A_Pagina` AS `A_Pagina`,`alles`.`A_Pagina_Type` AS `A_Pagina_Type`,`alles`.`A_Type` AS `A_Type`,`alles`.`A_Waarde` AS `A_Waarde`,`alles`.`A_Level` AS `A_Level`,`alles`.`A_Actief` AS `A_Actief`,`alles`.`A_TIMESTAMP` AS `A_TIMESTAMP`,`alles`.`A_Klasse` AS `A_Klasse`,`alles`.`A_Hoort_Bij` AS `A_Hoort_Bij`,`alles`.`A_Owner` AS `A_Owner`,convert_tz(`alles`.`A_TIMESTAMP`,'UTC','Europe/Brussels') AS `local_time`,if(`alles`.`A_Level` = 0,`L_Types`.`LT_Default_Level`,`alles`.`A_Level`) AS `Real_level` from (`alles` join `L_Types` on(`alles`.`A_Type` = `L_Types`.`LT_Id`)) ;

-- --------------------------------------------------------

--
-- Structuur voor de view `V_aantalItemsPerPagina`
--
DROP TABLE IF EXISTS `V_aantalItemsPerPagina`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `V_aantalItemsPerPagina`  AS  select concat(`Content`.`A_Pagina`,'(',`Content`.`A_Taal`,')') AS `pagina`,count(`Content`.`A_Pagina`) AS `Aantal_elem` from `Content` where `Content`.`A_Actief` = 1 group by `Content`.`A_Pagina`,`Content`.`A_Taal` ;

-- --------------------------------------------------------

--
-- Structuur voor de view `V_Actieve_Content`
--
DROP TABLE IF EXISTS `V_Actieve_Content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `V_Actieve_Content`  AS  select distinct `alles`.`id` AS `A_ID`,`Topics`.`link` AS `A_Pagina`,`L_Pagina_Types`.`LPT_Naam` AS `A_Pagina_Type`,`L_Types`.`LT_Naam` AS `A_Type`,`alles`.`A_Waarde` AS `A_Waarde`,if(`alles`.`A_Level` = 0,`L_Types`.`LT_Default_Level`,`alles`.`A_Level`) AS `A_level`,`alles`.`A_Actief` AS `A_Actief`,`alles`.`A_TIMESTAMP` AS `A_TIMESTAMP`,`alles`.`A_Klasse` AS `A_Klasse`,`talen`.`taal_naam` AS `A_Taal`,`alles`.`A_Hoort_Bij` AS `A_Hoort_Bij` from (((((`alles` join `Topics` on(`alles`.`A_Pagina` = `Topics`.`id`)) join `L_Pagina_Types` on(`L_Pagina_Types`.`LPT_Id` = `alles`.`A_Pagina_Type`)) join `L_Types` on(`L_Types`.`LT_Id` = `alles`.`A_Type`)) join `items_talen` on(`items_talen`.`item_id` = `alles`.`id`)) join `talen` on(`items_talen`.`taal_id` = `talen`.`taal_id`)) where `alles`.`A_Actief` = 1 order by `alles`.`id` ;

-- --------------------------------------------------------

--
-- Structuur voor de view `V_children`
--
DROP TABLE IF EXISTS `V_children`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `V_children`  AS  select `parent`.`id` AS `id`,`parent`.`topic` AS `topic`,`parent`.`link` AS `link`,`parent`.`parent_id` AS `parent_id`,count(`child`.`id`) AS `direct_children` from (`Topics` `parent` left join `Topics` `child` on(`child`.`parent_id` = `parent`.`id`)) group by `parent`.`id`,`parent`.`topic`,`parent`.`link`,`parent`.`parent_id` ;

-- --------------------------------------------------------

--
-- Structuur voor de view `V_missing_pages`
--
DROP TABLE IF EXISTS `V_missing_pages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `V_missing_pages`  AS  select `A`.`A_Pagina` AS `A_Pagina`,`A`.`A_Waarde` AS `A_WAARDE`,`T`.`link` AS `link`,`T`.`topic` AS `topic` from (`alles` `A` left join `Topics` `T` on(`A`.`A_Pagina` = `T`.`link`)) where `A`.`A_Type` is null ;

-- --------------------------------------------------------

--
-- Structuur voor de view `V_missin_titles`
--
DROP TABLE IF EXISTS `V_missin_titles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`doctorwhofans_be`@`%` SQL SECURITY DEFINER VIEW `V_missin_titles`  AS  select `A`.`A_ID` AS `A_ID`,`A`.`A_Pagina` AS `A_Pagina`,`A`.`A_Waarde` AS `A_WAARDE`,`T`.`id` AS `ID`,`T`.`link` AS `link`,`T`.`topic` AS `topic` from (`Topics` `T` left join `Content` `A` on(`A`.`A_Pagina` = `T`.`link`)) where (`A`.`A_Type` = 'Titel' or `A`.`A_Type` is null) and `T`.`link`  not like '%_Forum%' and (`A`.`A_Waarde` is null or `T`.`topic` is null) ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `afbeelding_Owner` (`A_Owner`);

--
-- Indexen voor tabel `afbeeldingen__history`
--
ALTER TABLE `afbeeldingen__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `alles`
--
ALTER TABLE `alles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `A_Pagina` (`A_Pagina`),
  ADD KEY `A_Pagina_Type` (`A_Pagina_Type`),
  ADD KEY `A_Type` (`A_Type`),
  ADD KEY `Owner` (`A_Owner`);
ALTER TABLE `alles` ADD FULLTEXT KEY `waardes_zoeken` (`A_Waarde`);

--
-- Indexen voor tabel `alles__history`
--
ALTER TABLE `alles__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`A_ID`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `birthdays`
--
ALTER TABLE `birthdays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `B_Owner` (`B_Owner`);

--
-- Indexen voor tabel `birthdays__history`
--
ALTER TABLE `birthdays__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `C_Owner` (`C_Owner`);

--
-- Indexen voor tabel `categories__history`
--
ALTER TABLE `categories__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`cat_ID`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `cat_pages`
--
ALTER TABLE `cat_pages`
  ADD PRIMARY KEY (`cat_id`,`page_id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `CP_Owner` (`CP_Owner`);

--
-- Indexen voor tabel `dataface__failed_logins`
--
ALTER TABLE `dataface__failed_logins`
  ADD PRIMARY KEY (`attempt_id`);

--
-- Indexen voor tabel `dataface__modules`
--
ALTER TABLE `dataface__modules`
  ADD PRIMARY KEY (`module_name`);

--
-- Indexen voor tabel `dataface__mtimes`
--
ALTER TABLE `dataface__mtimes`
  ADD PRIMARY KEY (`name`);

--
-- Indexen voor tabel `dataface__preferences`
--
ALTER TABLE `dataface__preferences`
  ADD PRIMARY KEY (`pref_id`),
  ADD KEY `username` (`username`),
  ADD KEY `table` (`table`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexen voor tabel `dataface__record_mtimes`
--
ALTER TABLE `dataface__record_mtimes`
  ADD PRIMARY KEY (`recordhash`);

--
-- Indexen voor tabel `dataface__reset_password`
--
ALTER TABLE `dataface__reset_password`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `request_uuid` (`request_uuid`);

--
-- Indexen voor tabel `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_ID`),
  ADD KEY `pagina` (`download_pagina`),
  ADD KEY `D_Owner` (`D_Owner`);

--
-- Indexen voor tabel `downloads__history`
--
ALTER TABLE `downloads__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`download_ID`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `E_Owner` (`E_Owner`);

--
-- Indexen voor tabel `events__history`
--
ALTER TABLE `events__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `items_talen`
--
ALTER TABLE `items_talen`
  ADD PRIMARY KEY (`item_id`,`taal_id`),
  ADD KEY `taal_id` (`taal_id`),
  ADD KEY `IT_Owner` (`IT_Owner`);

--
-- Indexen voor tabel `items_talen__history`
--
ALTER TABLE `items_talen__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`item_id`,`taal_id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `L_Pagina_Types`
--
ALTER TABLE `L_Pagina_Types`
  ADD PRIMARY KEY (`LPT_Id`),
  ADD KEY `LPT_Owner` (`LPT_Owner`);

--
-- Indexen voor tabel `L_Pagina_Types__history`
--
ALTER TABLE `L_Pagina_Types__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`LPT_Id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `L_Types`
--
ALTER TABLE `L_Types`
  ADD PRIMARY KEY (`LT_Id`),
  ADD KEY `LT_Owner` (`LT_Owner`);

--
-- Indexen voor tabel `L_Types__history`
--
ALTER TABLE `L_Types__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`LT_Id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `N_Owner` (`N_Owner`);

--
-- Indexen voor tabel `Pagina_Logs`
--
ALTER TABLE `Pagina_Logs`
  ADD PRIMARY KEY (`PL_id`),
  ADD KEY `PL_Pagina` (`PL_Pagina`);

--
-- Indexen voor tabel `php_users_login`
--
ALTER TABLE `php_users_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `QuotesTabel`
--
ALTER TABLE `QuotesTabel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `Episode` (`Episode`),
  ADD KEY `Q_Owner` (`Q_Owner`);
ALTER TABLE `QuotesTabel` ADD FULLTEXT KEY `Quote` (`Quote`,`Personage`,`Aflevering`);

--
-- Indexen voor tabel `QuotesTabel__history`
--
ALTER TABLE `QuotesTabel__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`Rol_Id`);

--
-- Indexen voor tabel `talen`
--
ALTER TABLE `talen`
  ADD PRIMARY KEY (`taal_id`),
  ADD KEY `T_Owner` (`T_Owner`);

--
-- Indexen voor tabel `talen__history`
--
ALTER TABLE `talen__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`taal_id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `Topics`
--
ALTER TABLE `Topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `T_Owner` (`T_Owner`);
ALTER TABLE `Topics` ADD FULLTEXT KEY `topic` (`topic`,`link`);

--
-- Indexen voor tabel `Topics__history`
--
ALTER TABLE `Topics__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `User_Rol` (`User_Rol`);

--
-- Indexen voor tabel `Users__history`
--
ALTER TABLE `Users__history`
  ADD PRIMARY KEY (`history__id`),
  ADD KEY `prikeys` (`User_Id`) USING HASH,
  ADD KEY `datekeys` (`history__modified`) USING BTREE;

--
-- Indexen voor tabel `Videos`
--
ALTER TABLE `Videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `V_Owner` (`V_Owner`);
ALTER TABLE `Videos` ADD FULLTEXT KEY `Video_Name` (`Video_Name`,`Video_Beschrijving`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `afbeeldingen__history`
--
ALTER TABLE `afbeeldingen__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `alles`
--
ALTER TABLE `alles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5319;

--
-- AUTO_INCREMENT voor een tabel `alles__history`
--
ALTER TABLE `alles__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8069;

--
-- AUTO_INCREMENT voor een tabel `birthdays`
--
ALTER TABLE `birthdays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `birthdays__history`
--
ALTER TABLE `birthdays__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT voor een tabel `categories__history`
--
ALTER TABLE `categories__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT voor een tabel `dataface__failed_logins`
--
ALTER TABLE `dataface__failed_logins`
  MODIFY `attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `dataface__preferences`
--
ALTER TABLE `dataface__preferences`
  MODIFY `pref_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT voor een tabel `dataface__reset_password`
--
ALTER TABLE `dataface__reset_password`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `downloads`
--
ALTER TABLE `downloads`
  MODIFY `download_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `downloads__history`
--
ALTER TABLE `downloads__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT voor een tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `events__history`
--
ALTER TABLE `events__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `items_talen__history`
--
ALTER TABLE `items_talen__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10473;

--
-- AUTO_INCREMENT voor een tabel `L_Pagina_Types`
--
ALTER TABLE `L_Pagina_Types`
  MODIFY `LPT_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `L_Pagina_Types__history`
--
ALTER TABLE `L_Pagina_Types__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `L_Types`
--
ALTER TABLE `L_Types`
  MODIFY `LT_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT voor een tabel `L_Types__history`
--
ALTER TABLE `L_Types__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT voor een tabel `News`
--
ALTER TABLE `News`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT voor een tabel `Pagina_Logs`
--
ALTER TABLE `Pagina_Logs`
  MODIFY `PL_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13052;

--
-- AUTO_INCREMENT voor een tabel `php_users_login`
--
ALTER TABLE `php_users_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `QuotesTabel`
--
ALTER TABLE `QuotesTabel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT voor een tabel `QuotesTabel__history`
--
ALTER TABLE `QuotesTabel__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT voor een tabel `Roles`
--
ALTER TABLE `Roles`
  MODIFY `Rol_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `talen`
--
ALTER TABLE `talen`
  MODIFY `taal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `talen__history`
--
ALTER TABLE `talen__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `Topics`
--
ALTER TABLE `Topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1610;

--
-- AUTO_INCREMENT voor een tabel `Topics__history`
--
ALTER TABLE `Topics__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `Users__history`
--
ALTER TABLE `Users__history`
  MODIFY `history__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `Videos`
--
ALTER TABLE `Videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `afbeeldingen`
--
ALTER TABLE `afbeeldingen`
  ADD CONSTRAINT `afbeelding_Owner` FOREIGN KEY (`A_Owner`) REFERENCES `Users` (`User_Id`),
  ADD CONSTRAINT `afbeeldingen_ibfk_1` FOREIGN KEY (`id`) REFERENCES `afbeeldingen__history` (`id`);

--
-- Beperkingen voor tabel `afbeeldingen__history`
--
ALTER TABLE `afbeeldingen__history`
  ADD CONSTRAINT `afbeeldingen__history_ibfk_1` FOREIGN KEY (`id`) REFERENCES `afbeeldingen` (`id`);

--
-- Beperkingen voor tabel `alles`
--
ALTER TABLE `alles`
  ADD CONSTRAINT `Lookup_Pagina_Types` FOREIGN KEY (`A_Pagina_Type`) REFERENCES `L_Pagina_Types` (`LPT_Id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `Owner` FOREIGN KEY (`A_Owner`) REFERENCES `Users` (`User_Id`),
  ADD CONSTRAINT `Pagina_Link` FOREIGN KEY (`A_Pagina`) REFERENCES `Topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `alles_ibfk_1` FOREIGN KEY (`A_Type`) REFERENCES `L_Types` (`LT_Id`);

--
-- Beperkingen voor tabel `birthdays`
--
ALTER TABLE `birthdays`
  ADD CONSTRAINT `birthdays_ibfk_1` FOREIGN KEY (`B_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`C_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `cat_pages`
--
ALTER TABLE `cat_pages`
  ADD CONSTRAINT `cat_pages_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_ID`),
  ADD CONSTRAINT `cat_pages_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `Topics` (`id`),
  ADD CONSTRAINT `cat_pages_ibfk_3` FOREIGN KEY (`CP_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`D_Owner`) REFERENCES `Users` (`User_Id`),
  ADD CONSTRAINT `pagina` FOREIGN KEY (`download_pagina`) REFERENCES `Topics` (`id`);

--
-- Beperkingen voor tabel `downloads__history`
--
ALTER TABLE `downloads__history`
  ADD CONSTRAINT `downloads__history_ibfk_1` FOREIGN KEY (`download_ID`) REFERENCES `downloads` (`download_ID`);

--
-- Beperkingen voor tabel `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`E_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `items_talen`
--
ALTER TABLE `items_talen`
  ADD CONSTRAINT `items_talen_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `alles` (`id`),
  ADD CONSTRAINT `items_talen_ibfk_2` FOREIGN KEY (`taal_id`) REFERENCES `talen` (`taal_id`),
  ADD CONSTRAINT `items_talen_ibfk_3` FOREIGN KEY (`IT_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `L_Pagina_Types`
--
ALTER TABLE `L_Pagina_Types`
  ADD CONSTRAINT `L_Pagina_Types_ibfk_1` FOREIGN KEY (`LPT_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `L_Types`
--
ALTER TABLE `L_Types`
  ADD CONSTRAINT `L_Types_ibfk_1` FOREIGN KEY (`LT_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `News`
--
ALTER TABLE `News`
  ADD CONSTRAINT `News_ibfk_1` FOREIGN KEY (`N_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `Pagina_Logs`
--
ALTER TABLE `Pagina_Logs`
  ADD CONSTRAINT `Pagina_Logs_ibfk_1` FOREIGN KEY (`PL_Pagina`) REFERENCES `Topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `QuotesTabel`
--
ALTER TABLE `QuotesTabel`
  ADD CONSTRAINT `QuotesTabel_ibfk_1` FOREIGN KEY (`Episode`) REFERENCES `Topics` (`id`),
  ADD CONSTRAINT `QuotesTabel_ibfk_2` FOREIGN KEY (`Q_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `talen`
--
ALTER TABLE `talen`
  ADD CONSTRAINT `talen_ibfk_1` FOREIGN KEY (`T_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `Topics`
--
ALTER TABLE `Topics`
  ADD CONSTRAINT `Topics_ibfk_1` FOREIGN KEY (`T_Owner`) REFERENCES `Users` (`User_Id`);

--
-- Beperkingen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`User_Rol`) REFERENCES `Roles` (`Rol_Id`);

--
-- Beperkingen voor tabel `Videos`
--
ALTER TABLE `Videos`
  ADD CONSTRAINT `Videos_ibfk_1` FOREIGN KEY (`V_Owner`) REFERENCES `Users` (`User_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
