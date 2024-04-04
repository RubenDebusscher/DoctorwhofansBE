var AvailableLangCodes = [];
var varlist;

(function (window) {
  'use strict';

  var extendObj = function (src, target) {
    for (var prop in target) {
      if (target.hasOwnProperty(prop) && target[prop]) {
        src[prop] = target[prop];
      }
    }

    return src;
  };

  var getHeaders = function (selector, scope) {
    var ret = [];
    var target = document.querySelectorAll(scope);

    Array.prototype.forEach.call(target, function (elem) {
      var elems = elem.querySelectorAll(selector);
      ret = ret.concat(Array.prototype.slice.call(elems));
    });

    return ret;
  };

  var getLevel = function (header) {
    if (typeof header !== 'string') {
      return 0;
    }

    var decs = header.match(/\d/g);
    return decs ? Math.min.apply(null, decs) : 1;
  };

  var createList = function (wrapper, count) {
    while (count--) {
      if (wrapper !==null){
        wrapper = wrapper.appendChild(
          document.createElement('ol')
        );
      }
      

      if (count) {
        wrapper = wrapper.appendChild(
          document.createElement('li')
        );
      }
    }

    return wrapper;
  };

  var jumpBack = function (currentWrapper, offset) {
    while (offset--) {
      currentWrapper = currentWrapper.parentElement;
    }

    return currentWrapper;
  };

  var setAttrs = function (overwrite, prefix) {
    return function (src, target, index) {
      var content = src.textContent;
      var pre = prefix + '-' + index;
      target.textContent = content;

      var id = overwrite ? pre : (src.id || pre);

      id = encodeURIComponent(id);

      src.id = id;
      target.href = '#' + id;
    };
  };

  var buildTOC = function (options) {
    var selector = options.selector;
    var scope = options.scope;

    var ret = document.createElement('ol');
    var wrapper = ret;
    var lastLi = null;

    var _setAttrs = setAttrs(options.overwrite, options.prefix);

    getHeaders(selector, scope).reduce(function (prev, cur, index) {
      var currentLevel = getLevel(cur.tagName);
      var offset = currentLevel - prev;

      if (offset > 0) {
        wrapper = createList(lastLi, offset);
      }

      if (offset < 0) {
        wrapper = jumpBack(wrapper, -offset * 2);
      }

      wrapper = wrapper || ret;

      var li = document.createElement('li');
      var a = document.createElement('a');

      _setAttrs(cur, a, index);

      wrapper.appendChild(li).appendChild(a);

      lastLi = li;

      return currentLevel;
    }, getLevel(selector));

    return ret;
  };

  var initTOC = function (options) {
    var defaultOpts = {
      selector: 'h1, h2, h3, h4, h5, h6',
      scope: 'body',
      overwrite: false,
      prefix: 'toc'
    };

    options = extendObj(defaultOpts, options);

    var selector = options.selector;

    if (typeof selector !== 'string') {
      throw new TypeError('selector must be a string');
    }

    if (!selector.match(/^(?:h[1-6],?\s*)+$/g)) {
      throw new TypeError('selector must contains only h1-6');
    }

    var currentHash = location.hash;

    if (currentHash) {
      setTimeout(function () {
        var anchor = document.getElementById(currentHash.slice(1));
        if (anchor) anchor.scrollIntoView();
      }, 0);
    }

    return buildTOC(options);
  };

  // @ts-ignore
  if (typeof define === 'function' && define.amd) {
    // @ts-ignore
    define(function () {
      return initTOC;
    });
  } else {
    // @ts-ignore
    window.initTOC = initTOC;
  }
}(window));



function footerAlign() {
  $('footer').css('display', 'block');
  $('footer').css('height', 'auto');
  var footerHeight = $('footer').outerHeight();
  $('body').css('padding-bottom', footerHeight);
  $('footer').css('height', footerHeight);
}




$(window).resize(function () {
  footerAlign();
});
jQuery(document).ready(function () {

  HideNotificationButton();
  getAvailableLangcodes();
  footerAlign();
  buildLogo('#logo', '#ffff00');
  // @ts-ignore
  GetContent(menu, id);


  // bind a click event to the 'skip' link
  $(".skip").click(function (event) {

    // strip the leading hash and declare
    // the content we're skipping to
    var skipTo = "#" + this.href.split('#')[1];

    // Setting 'tabindex' to -1 takes an element out of normal 
    // tab flow but allows it to be focused via javascript
    $(skipTo).attr('tabindex', -1).on('blur focusout', function () {

      // when focus leaves this element, 
      // remove the tabindex attribute
      $(this).removeAttr('tabindex');

    }).focus(); // focus on the content container
  });
  $('.st-btn').show();
});

function replaceRelativeLinks() {
  $("a[href]")
    .each(function () {
      //this.href = this.href.replace('..',window.location.origin);
      $(this).attr('href', $(this).attr('href').replace('..', window.location.origin));
      //console.log($(this).attr('href'));

    });
  $("img[src]")
    .each(function () {
      //this.href = this.href.replace('..',window.location.origin);
      $(this).attr('src', $(this).attr('src').replace('..', window.location.origin));
      //console.log($(this).attr('href'));

    });

}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;domain:doctorwhofans.be";
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;domain:belgianwhovians.be";
  //document.cookie = "lang=nl;expires=Fri, 08 Mar 2024 19:42:10 GMT;path=/;domain.belgianwhovians.be";
  if (cname == "lang") {
    $('meta[name=language]').attr('content', cvalue.replace('_', '-'));
    $('html').attr('lang', cvalue.replace('_', '-'));
  }


}

function getAvailableLangcodes() {
  $.ajax({
    type: "GET",
    url: "/php/getAvaliableLanguages.php",
    dataType: 'json',
    crossDomain: true,
    xhrFields: {
      withCredentials: true
    },
    cache: false
  }).done(
    function (resultaat) {
      AvailableLangCodes = resultaat;
      
      var tempLang= checkLangCookie();
      populateLangChoice(resultaat);
    }).fail(function (response, statusText, xhr) {}).always(function () {});
}


function populateLangChoice(Choices){
  for (var i = 0; i < Choices.data.length; i++) {
    var option= document.createElement("option");
    option.value=Choices.data[i].language_Name;
    option.innerText=Choices.data[i].language_LongName;
    $("#lang-select").append(option);
  }
  var currentLang=getCookie("lang");
  $("#lang-select option[value='"+currentLang+"']").attr("disabled","disabled");
  $("#lang-select option[value='"+currentLang+"']").attr("selected","selected");
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkLangCookie() {

  var lang = getCookie("lang");
  if (lang == "") {
    if ((AvailableLangCodes.length<0)&&(AvailableLangCodes.data.language_Name.includes(navigator.language) === true)) {
      setCookie("lang", navigator.language, 30);
      lang=navigator.language
    } else {
      setCookie("lang", "nl", 30);
      lang="nl";

    }
  }
  return lang;
}


function Search() {
  event.preventDefault();
  var searchString = $('#searchString').val();
  var form = new FormData();
  var localLang=checkLangCookie();
  
  form.append('lang', localLang);
  form.append('search', searchString.toString());
  form.append("content-type", "application/json");
  var settings = {
    "url": "https://www.doctorwhofans.be/php/search.php",
    "method": "POST",
    "timeout": 0,
    "dataType": 'json',
    "processData": false,
    "crossDomain":true,
    "xhrFields": {
      "withCredentials": true
    },
    "mimeType": "multipart/form-data",
    "contentType": false,
    "data": form
  };
  // @ts-ignore
  $.ajax(settings).done(function (response) {
    $('.modal-content h1').html('Search');
    var SearchEl = "";
    if (response.results.length > 0) {
      const regEscape = v => v.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');

      for (var i = 0; i < response.results.length; i++) {
        var TitleText = response.results[i].title.split(new RegExp(regEscape(searchString), "ig")).join("<b>"+searchString+"</b>");
        var BodyText = response.results[i].body.split(new RegExp(regEscape(searchString), "ig")).join("<b>"+searchString+"</b>");

        SearchEl += "<section><a href='" + window.location.origin + "/" + response.results[i].link + ".html'>" + TitleText + "</a>";
        SearchEl += "<p>" + BodyText + "...</p>";
        SearchEl += "</section>";
      }
      // @ts-ignore
      $('.modal-content article').html(SearchEl);

    } else {
      $('.modal-content article').html("Niets gevonden, probeer opnieuw, of zoek eens in onze <i class='fa fa-sitemap' aria-hidden='true'></i> <a href='" + window.location.origin + "/Sitemap.html'>Sitemap</a>");
    }
    // @ts-ignore
    OpenModal();
  });

}

function GetContent(menu, id) {

 
  
  if (menu != "") {

    var form = new FormData();
    form.append("menu", menu);
    var localLang=checkLangCookie();
    form.append('lang', localLang);
    form.append('Itemid', id);
    form.append("content-type", "application/json");

    var settings = {
      "url": "/php/checkPage.php",
      "method": "POST",
      "async": false,
      "timeout": 0,
      "dataType": 'json',
      "crossDomain":true,
      "xhrFields": {
        "withCredentials": true
      },
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    // @ts-ignore
    $.ajax(settings).done(function (response) {
      //if ((typeof response.Page == 'undefined')&& (menu.startsWith('Category:')==false)){
      if (((typeof response.Page == 'undefined') && (menu.startsWith('Category:')==false))||(typeof response.Page !== 'undefined')&&(response.Page[0].pageType==9 )){
        console.log("redirect");
        var myHeaders = new Headers(); // Currently empty
        //myHeaders.set('Status Code', '404');
        // @ts-ignore
        window.location.href = "http://www.doctorwhofans.be/notfound.html";
      }
      if(menu.startsWith('Category:')){
        console.log("This is a Category, WIP");
        populateEpisodesOfTheDay(response.EpisodesOf_The_day);
        populateActorsOfTheDay(response.ActorsOf_The_day);
        footerAlign();
        var Title="Category: "+ response.PagesForTag[0].category_Name;
        $('#SiteContent article').append("<h1>"+Title+"</h1>")
        $('#SiteContent article').append("<div class='Overzicht'></div>")
         //TODO: #55 set default title for Category, replace with content of content Function, but after content, add an item to put categories in (that is excluded for replacement when content is not null),
         ChildPages(response.PagesForTag);
        //Content(response.Content);
      }else{
        populatePath(response.Path);
        populateEpisodesOfTheDay(response.EpisodesOf_The_day);
        populateActorsOfTheDay(response.ActorsOf_The_day);

        footerAlign();
        if(response.Page){
          document.title = response.Page[0].page_Name;
        }
        Content(response.Content);
        ChildPages(response.ChildPages);
        GetSecondsForEpisodes($('#Tiles').attr('data-srcFile'));
        switch (response.Page[0].pagetype_Name) {
          case "Default":
            break;
          case "Episode":
            Serial(response);
            break;
          case "Magazine":
            Magazine(response);
            break;
          case "Doctor":
            Doctor(response);
            break;
          case "Character":
            Character(response);
            break;
          case "Contact":
            break;
          case "Quotes":
          //// #56 Add Quotes in Front End (Already added in Request)
          AddMainQuoteToDom(response.MainQuote,".MainQuote","replace");
          AddQuoteSelectionToDom(response.Quotes);
            break;
          case "Sitemap":
            $('main article').append('<ul id="Sitemap"></ul>');
            createSiteMap("Sitemap", response.Sitemap);
            break;
          case "Video":
            AddMainVideoToDom(response.MainVideo,".MainVideo","replace");
            AddVideoSelectionToDom(response.Videos);
            break;
          default:
            // code block
        }
        Tags(response.Tags);
        //$('#Galleries').html("TEST"));
        if(response.Galleries!==null){
          GalleriesForPage(response.Galleries);
        }
       

        replaceRelativeLinks();
        // @ts-ignore
        varlist = initTOC({
          selector: 'h2, h3, h4, h5, h6',
          scope: 'article',
          overwrite: false,
          prefix: 'toc'
        });
        $("#Inhoud").append(varlist);
      }
    });
  }
}


function AddMainQuoteToDom(mainQuote,Parentelem,replace){
  var MainQuoteElem = "";
  var MainQuoteImage="";
  

  if(replace=="replace"){
    MainQuoteImage="<img src='https://www.doctorwhofans.be/images/content__quotes/"+mainQuote[0].quote_Image+"'/>";
    MainQuoteElem +="<h2>"+mainQuote[0].Episode_Link+"</h2>";
    MainQuoteElem += MainQuoteImage;
    MainQuoteElem +="<p>"+mainQuote[0].quote_Item+"</p>";
    MainQuoteElem += mainQuote[0].Character_Links;
    $(Parentelem).html(MainQuoteElem);
  }else{
    MainQuoteImage="<img src='https://www.doctorwhofans.be/images/content__quotes/"+mainQuote.quote_Image+"'/>";
    MainQuoteElem +="<div class='MainQuote bordered DarkBlueBackground'><b>"+mainQuote.Episode_Link+"</b>";
    MainQuoteElem += MainQuoteImage;
    MainQuoteElem +="<p>"+mainQuote.quote_Item+"</p>";
    MainQuoteElem += mainQuote.Character_Links+"</div>";
    $(Parentelem).append(MainQuoteElem);
  }
}
function AddQuoteSelectionToDom(quotes){
  let Quoteselection = "";
  if(quotes.length >0){
    for (var i = 0; i < quotes.length; i++) {
      Quoteselection += " <a href='" + window.location.origin + "/Quotes/" + quotes[i].quote_Id + ".html'>" + quotes[i].short_Quote + "</a>";
    }
    $('.QuoteChoice').html(Quoteselection);

  }

}

function AddMainVideoToDom(mainVideo,Parentelem,replace){
  var MainVideoElem = "";
  var MainVideoImage="";
  $(Parentelem).addClass(mainVideo[0].Spoiler)

  if(replace=="replace"){
    MainVideoImage="<div class='VidWrapper'><div class='Vidcontainer'><iframe src='"+mainVideo[0].video_URL+"' allowfullscreen class='responsive-iframe'></iframe></div></div>";
    MainVideoElem +="<h2>"+mainVideo[0].video_Name+"</h2>";
    MainVideoElem += MainVideoImage;
    $(Parentelem).html(MainVideoElem);
    
  }else{
    MainVideoImage="<div class='VidWrapper'><div class='Vidcontainer'><iframe src='"+mainVideo[0].video_URL+"' allowfullscreen class='responsive-iframe'></iframe></div></div>";
    MainVideoElem +="<h2>"+mainVideo[0].video_Name+"</h2>";
    MainVideoElem += MainVideoImage;
    $(Parentelem).append(MainVideoElem);
  }
}
function AddVideoSelectionToDom(videos){
  let Videoselection = "";
  var elements =[];
  if(videos.length >0){
    for (var i = 0; i < videos.length; i++) {
      var image 
      if(videos[i].video_Image!==null){
        element="";
        var image ="<img class='thumbnail' src='"+  window.location.origin +"/images/content__videos/"+videos[i].video_Image+"'/>";


      }else{
        var element="#VidNoPic_"+videos[i].video_Id;
        elements.push(element);
        image="<div style='width:100%; height:13em' id='"+element+"'></div>"
        
      }
      
      Videoselection += "<div class='bordered DarkBlueBackground TimeDiv padded max_20 "+videos[i].Spoiler+"'><a href='" + window.location.origin + "/Video/" + videos[i].video_Id + ".html'>";
       
      Videoselection+=image;
      
      Videoselection+= "<br>"+videos[i].video_Name + "</a></div>";
      
    }
    $('.VideoChoice').html(Videoselection);
    
    for(var i=0;i<elements.length;i++){
      buildLogo(elements[i],'#ffff00');

    }
    

  }

}







function ChildPages(Pages) {
  var OverzichtEl = "";
  if (Pages.length > 0) {
    for (var i = 0; i < Pages.length; i++) {
      OverzichtEl += " <a href='" + window.location.origin + "/" + Pages[i].page_Link + ".html'>" + Pages[i].page_Name + "</a>";
    }
    $('.Overzicht').html(OverzichtEl);
  }
}

function ToggleItems() {
  $(event.target.nextElementSibling.nextElementSibling).slideToggle();
  if ($(event.target).text() == "+") {
    $(event.target).text("-");
  } else if ($(event.target).text() == "-") {
    $(event.target).text("+");
  }
}

function createSiteMap(elem, Sitemap) {
  createList(document.getElementById(elem), getNestedChildren(Sitemap, null));
  $('li a[href="..' + window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/') + 1) + '"]').addClass('current_page');
}

function Tags(TagData){
  var TagString = "Tags: ";
  for (var item = 0; item < TagData.length; item++) {
    TagString += "<a href='../"+TagData[item].category_Link+"'>"+TagData[item].category_Name+"</a>";
    if(item !=TagData.length-1){
      TagString +=', ';
    }
  }
  if (TagString.length > 6) {
    $('#Tags').html(TagString);
    $('#Tags').show();
  }

}

function getNestedChildren(arr, parent) {
  var out = [];
  for (var i in arr) {
    if (arr[i].page_parent_id == parent) {
      var children = getNestedChildren(arr, arr[i].page_Id);
      if (children.length) {
        arr[i].children = children;
      }
      out.push(arr[i]);
    }
  }
  return out;
}

function createList(parent, array) {
  array.forEach(function (o) {
    var li = document.createElement("li"),
      ul;
    o.link = window.location.origin + '/' + o.link;
    if (o.children) {
      li.innerHTML = "<button class='SitemapButton' onclick=ToggleItems()>+</button><a href='" + o.page_Link + ".html'>" + o.page_Name + "</a>";
      parent.appendChild(li);
      ul = document.createElement("ul");
      ul.setAttribute('style', 'display:none');
      li.appendChild(ul);
      createList(ul, o.children);
    } else {
      li.innerHTML = "<a href='" + o.page_Link + ".html'>" + o.page_Name + "</a>";
      parent.appendChild(li);
    }
  });
}

function Content(Content) {
  //$('main article').append(Content);
  var ContentString = "";
  var ClassString=" ";
  for (var item = 0; item < Content.length; item++) {
    ContentString += Content[item].item_Value;
    if (Content[item].item_Class!==""){
      $('main article').addClass(Content[item].item_Class);
    }
  }
  if (ContentString.length <= 0) {
    ContentString="<div id='phasingIMG'></div><h1>Engines are phasing, or we are still building on this page.</h1>"
  }
  $('main article').append(ContentString);
  buildLogo('#phasingIMG', '#306090');
}

function Doctor(DoctorData) {
  //$('main article h1').html(DoctorData.Doctor[0].doctor_Incarnation);
  CreateWikiDetails();
  var DoctorKeys = ['Species','Actor'];
  var DoctorStrings = ['Species','Actor'];
  PopulateWikiDetailsStatic(DoctorKeys, DoctorStrings,"");
  WikiImage(DoctorData.Doctor[0].character_Image, 'api__characters');
  $('#WikiSpecies p').html(DoctorData.Doctor[0].character_Species);
  $('#WikiActor p').html(ActorsforCharacter(DoctorData.Doctor[0].ActorList));
  //Info(DoctorData);

}
function Character(CharacterData){
  //$('main article h1').html(DoctorData.Doctor[0].doctor_Incarnation);
  CreateWikiDetails();
  var CharacterKeys = ['Species','Actor'];
  var CharacterStrings = ['Species','Actor'];
  PopulateWikiDetailsStatic(CharacterKeys, CharacterStrings,"");
  WikiImage(CharacterData.Character[0].character_Image, 'api__characters');
  $('#WikiSpecies p').html(CharacterData.Character[0].character_Species);
  $('#WikiActor p').html(ActorsforCharacter(CharacterData.Character[0].ActorList));
  
  //Info(DoctorData);
}



function Magazine(MagazineData){
  //$('main article h1').html(DoctorData.Doctor[0].doctor_Incarnation);
  CreateWikiDetails();
  var MagazineKeys = ['Issue','CoverDate','ReleaseDate','Format','Publisher','Editor','Order'];
  var MagazineStrings = ['Issue','Cover Date','Release Date','Format','Publisher','Editor','Order'];
  PopulateWikiDetailsStatic(MagazineKeys, MagazineStrings,"Issue");
  WikiImage(MagazineData.Magazine[0].magazine_Image, 'api__magazines');
  $('#WikiIssue p').html(MagazineData.Magazine[0].magazine_Issue);
  $('#WikiCoverDate p').html(LocalDate(MagazineData.Magazine[0].magazine_CoverDate));
  $('#WikiReleaseDate p').html(LocalDate(MagazineData.Magazine[0].magazine_ReleaseDate));
  $('#WikiFormat p').html(MagazineData.Magazine[0].magazine_Format);
  $('#WikiPublisher p').html(MagazineData.Magazine[0].magazine_Publisher);
  $('#WikiEditor p').html(MagazineData.Magazine[0].magazine_Editor);

  $('#Previous p').html(PreviousNextLink(MagazineData.Magazine[0].Prev_Name, MagazineData.Magazine[0].Prev_Link));
  $('#Next p').html(PreviousNextLink(MagazineData.Magazine[0].Next_Name, MagazineData.Magazine[0].Next_Link));
  //Info(DoctorData);
}



function Serial(EpisodeData) {
  //$('main article h1').html(EpisodeData.Serial[0].serial_Title);
  CreateWikiDetails();
  var episodeKeys = ['Overall_Story_Number','Doctors', 'Companions', 'First_Aired_On', 'Last_Aired_On', 'Total_Runtime','Average_UK','Average_AI','Production_code', 'Order', ];
  var episodestrings = ['Overall Story Number','Doctors', 'Companions', 'First episode aired on', 'Last episode aired on', 'Total Runtime','Average UK viewers','Average AI', 'Production Code', 'Order'];

  PopulateWikiDetailsStatic(episodeKeys, episodestrings,"Episode");
  WikiImage(EpisodeData.Serial[0].serial_Image, 'api__serials');
  $('#WikiOverall_Story_Number p').html(EpisodeData.Serial[0].serial_Story);
  $('#WikiDoctors p').html(DoctorsForEpisode(EpisodeData.Serial.Characters));
  $('#WikiCompanions p').html(CompanionsForEpisode(EpisodeData.Serial.Characters));
  $('#WikiCompanions').append("<hr>");
  $('#WikiFirst_Aired_On p').html(LocalDate(EpisodeData.Serial.Episodes[0].episode_Original_airdate));
  if (EpisodeData.Serial.Episodes.length > 1) {
    $('#WikiLast_Aired_On p').html(LocalDate(EpisodeData.Serial.Episodes[EpisodeData.Serial.Episodes.length - 1].episode_Original_airdate));
    $('#WikiLast_Aired_On').append("<hr>");

  } else {
    $('#WikiLast_Aired_On').remove();
    $('#WikiFirst_Aired_On span').html('Aired on');
    $('#WikiFirst_Aired_On').append("<hr>");

  }
  $('#WikiProduction_code p').html(EpisodeData.Serial[0].serial_Production_code);
  $('#WikiTotal_Runtime p').html(EpisodeData.Serial[0]["Total Runtime"].substring(0, EpisodeData.Serial[0]["Total Runtime"].indexOf('.')));
  if(EpisodeData.Serial[0]["average UK viewership"]!=null) {
    $('#WikiAverage_UK p').html(new Intl.NumberFormat(getCookie('lang')).format(EpisodeData.Serial[0]["average UK viewership"]));
  }
  if(EpisodeData.Serial[0]["average AI"]!=null) {
    $('#WikiAverage_AI p').html(EpisodeData.Serial[0]["average AI"].substring(0, EpisodeData.Serial[0]["average AI"].indexOf('.')));

  }
  $('#Previous p').html(PreviousNextLink(EpisodeData.Serial[0].Previous_Episode, EpisodeData.Serial[0].Previous_Link));
  $('#Next p').html(PreviousNextLink(EpisodeData.Serial[0].Next_Episode, EpisodeData.Serial[0].Next_Link));

  Episodes(EpisodeData.Serial.Episodes);
  $('#Cast').html(CastForEpisode(EpisodeData.Serial.Characters));
  $('#Downloads').html(DownloadsForEpisode(EpisodeData.Downloads));
  for(var i=0;i<EpisodeData.Serial.EpisodeQuotes.length;i++){
    AddMainQuoteToDom(EpisodeData.Serial.EpisodeQuotes[i],"#Quotes","add");

  }
  //DumpInfo("#Quotes",EpisodeData.Serial.EpisodeQuotes[i]);

  //DumpInfo(EpisodeData);

}

function populatePath(Path) {
  var PathEl = "";
  if (Path.length > 0) {
    for (var i = 0; i < Path.length; i++) {
      PathEl += " <a href='" + window.location.origin + "/" + Path[i].page_Link + ".html'>" + Path[i].page_Name + "</a> <i class='fa fa-arrow-right'></i>";
    }
    $('.main__path').html(PathEl);
    $('.main__path').show();
  }
}

function populateEpisodesOfTheDay(Episodes) {
  $(".p__EpisodesOfTheDay").text('Episodes of the day:');
  var Episodelist = "";
  if (Episodes.length > 0) {
    for (var i = 0; i < Episodes.length; i++) {

      var Titles = Episodes[i].Title.split(': ');
      if (Titles[0] == Titles[Titles.length - 1]) {
        Episodelist += "<li><a href='../"+Episodes[i].page_Link +".html'>" + Titles[0] + " (" + getYear(Episodes[i].episode_Original_airdate) + ")</a></li>";
      } else {
        Episodelist += "<li><a href='../"+Episodes[i].page_Link +".html'>" + Episodes[i].Title + " (" + getYear(Episodes[i].episode_Original_airdate) + ")</a></li>";
      }
    }
    $(".footer__EpisodesOfTheDay ol").html(Episodelist);
  } else {
    $(".footer__EpisodesOfTheDay").html("<p>Geen episodes vandaag</p>");
  }
}


function populateActorsOfTheDay(Actors) {
  $(".p__ActorsOfTheDay").text('Birthdays and in memoriam:');
  var Actorlist = "";
  if (Actors.length > 0) {
    for (var i = 0; i < Actors.length; i++) {

      if (Actors[0].Type == "Birthday") {
        Actorlist += "<li><a href='../"+Actors[i].page_Link +".html'>" + Actors[i].actor_First_name +" "+Actors[i].actor_Last_name + " (&deg;" + getYear(Actors[i].actor_Birthdate) + ")</a></li>";
      } else {
        Actorlist += "<li><a href='../"+Actors[i].page_Link +".html'>" + Actors[i].actor_First_name +" "+Actors[i].actor_Last_name + " (&#10013;" + getYear(Actors[i].actor_Deathdate) + ")</a></li>";
      }
    }
    $(".footer__ActorsOfTheDay ol").html(Actorlist);
  } else {
    $(".footer__ActorsOfTheDay").html("<p>Geen Birthdays/In memoriams vandaag</p>");
  }
}

/**
 * * Small functions that support the bigger functions for reusability
 */
/**
 * * Get year of a date
 * @param original takes the string of a date
 */
function getYear(original) {
  var rawDate = new Date(original);
  var year = rawDate.getUTCFullYear();
  return year;
}

function DoctorsForEpisode(Doctors) {
  var drList = "";
  for (var dr = 0; dr < Doctors.length; dr++) {
    if (Doctors[dr].CT_Name.startsWith("Doctor")) {
      if (Doctors[dr].SC_Type == "Regular") {
        drList += "<a href='" + window.location.origin + "/" + Doctors[dr].Character_Link + ".html'>" + Doctors[dr].character_First_name + " " + Doctors[dr].character_Last_name + "</a>, ";

      } else {
        drList += "<a href='" + window.location.origin + "/" + Doctors[dr].Character_Link + ".html'>" + Doctors[dr].character_First_name + " " + Doctors[dr].character_Last_name + "</a> (" + Doctors[dr].SC_Type + "), ";

      }

    }
  }
  return drList.slice(0, -2);
}

function ActorsforCharacter(Actors){
  var actorList = "";
  if(Actors !=="No rows"){
    for (var act = 0; act < Actors.length; act++) {
      var name = Actors[act].actor_First_name;
      name += (Actors[act].actor_Last_name == null) ? '' : " " + Actors[act].actor_Last_name;
      actorList += "<a href='" + window.location.origin + "/" + Actors[act].page_Link + ".html'>" + name + "</a>, ";
    }
    actorlist =actorList.slice(0, -2);
  }
  return actorList;
}

function CompanionsForEpisode(Companions) {
  var compList = "";
  for (var comp = 0; comp < Companions.length; comp++) {
    if (Companions[comp].CT_Name.startsWith("Companion")) {
      var name = Companions[comp].character_First_name;
      name += (Companions[comp].character_Last_name == null) ? '' : " " + Companions[comp].character_Last_name;
      compList += "<a href='" + window.location.origin + "/" + Companions[comp].Character_Link + ".html'>" + name + "</a>, ";

    }
  }
  return compList.slice(0, -2);
}


function CastForEpisode(Characters){
  var castList = "<ul>";
  for (var cast = 0; cast < Characters.length; cast++) {
    var firstName = (Characters[cast].character_First_name === null) ? '' :Characters[cast].character_First_name;
    var lastName = (Characters[cast].character_Last_name === null) ? '' :Characters[cast].character_Last_name;
    var link = (Characters[cast].Character_Link === null) ? '#' :window.location.origin +'/'+Characters[cast].Character_Link+".html";
    var actorFirstName = (Characters[cast].actor_First_name === null) ? '' :Characters[cast].actor_First_name;
    var actorLastName = (Characters[cast].actor_Last_name === null) ? '' :Characters[cast].actor_Last_name;
    var actorlink = (Characters[cast].ActorLink === null) ? '#' :window.location.origin +'/'+Characters[cast].ActorLink+".html";
    castList += "<li><a href='"+link+"'>"+firstName+" "+lastName+"</a> (<a href='"+actorlink+"'>"+actorFirstName+" "+actorLastName+"</a>)</li>";

    
  }
  castList += "</ul>";
  return castList;

}

function DownloadsForEpisode(Downloads) {
  var downList = "<ul>";
  for (var down = 0; down < Downloads.length; down++) {
    if (Downloads[down].download_Type == "Subtitle") {
      downList += "<li> Subtitle: <a download href='" + window.location.origin + "/downloads/" + Downloads[down].download_File + "'>" + Downloads[down].download_Name + "</a> (" + Downloads[down].language_Name.toUpperCase() + ")</li>";

    }
  }
  downList += "</ul>";
  return downList;
}

function CreateWikiDetails() {
  $('main article').prepend("<aside id='WikiDetails' class='bordered DarkBlueBackground '><div id='ImageHolder'></div></aside>");
  buildLogo("#ImageHolder",'#ffff00')
  $("#ImageHolder").addClass("noImage")

}

function PopulateWikiDetailsStatic(keys, params,type) {
  for (var i = 0; i < params.length; i++) {
    if (keys[i] == "Order") {
      $('#WikiDetails').append('<section id="Wiki' + keys[i] + '"><hr><div id="Previous"><span>Previous '+type+'</span><p></p></div><div id="Next"><span>Next '+type+'</span><p></p></div></section>');

    } else {
      $('#WikiDetails').append('<section id="Wiki' + keys[i] + '"><span>' + params[i] + '</span><p></p></section>');
    }
  }
}

function WikiImage(image, table) {
  if (image != null) {
    $('#WikiDetails').prepend("<img src='https://www.doctorwhofans.be/images/" + table + "/" + image+"'/>");
    $("#ImageHolder").remove()
  }
}

function LocalDate(original) {
  var rawDate = new Date(original);

  var langFormat;
  if (getCookie("lang").indexOf('_') > -1) {
    langFormat = getCookie("lang").replace('_', '-');
  } else {
    langFormat = 'default';
  }
  var newDate = rawDate.toLocaleString(langFormat, {
    month: 'long',
    year: 'numeric',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    timeZoneName: 'short'
  });
  if((rawDate.getHours()==1||rawDate.getHours()==0)&&rawDate.getMinutes()==0 && rawDate.getSeconds()==0){

    newDate=rawDate.toLocaleString(langFormat, {
    dateStyle:"long"
    });
  }
  return newDate;
}

function DumpInfo(elem,data) {
  $(elem).append("<p>" + JSON.stringify(data) + "</p>");
}

function PreviousNextLink(EpisodeText, EpisodeLink) {
  if (EpisodeLink != null) {
    return '<a href="' + window.location.origin + '/' + EpisodeLink + '.html">' + EpisodeText + '</a>';

  } else {
    return '<span> <hr> </span>';
  }
}

function Episodes(episodes) {
  var tableRow;
  var tableData ="";
  for (var i = 0; i < episodes.length; i++) {
    if (episodes[i].state.search('Missing') > -1) {
      tableRow = '<tr class="missing">';

    } else {
      tableRow = '<tr>';
    }
    tableRow += '<td>' + Number(i+1) + '</td>';
    tableRow += '<td>' + episodes[i].episode_Title + '</td>';
    tableRow += '<td>' + episodes[i].Runtime + '</td>';
    tableRow += '<td>' + LocalDate(episodes[i].episode_Original_airdate) + '</td>';
    tableRow += '<td>' + episodes[i].episode_Original_Network + '</td>';
    tableRow += '<td>' + new Intl.NumberFormat(getCookie('lang')).format(episodes[i].episode_UK_viewers) + '</td>';
    tableRow += '<td>' + episodes[i].episode_Appreciation_index + '</td>';
    var statesObject = JSON.parse(episodes[i].state);
    statesObject = statesObject.toString().split(",");
    var stateString = '<ul>';
    for (var j = 0; j < statesObject.length; j++) {
      stateString += '<li>' + statesObject[j] + '</li>';
    }
    stateString += '</ul>';
    tableRow += '<td>' + stateString + '</td>';

    tableRow += '</tr>';
    tableData += tableRow;
  }
  $('#EpisodeTable tbody').html(tableData);

}

function buildLogo(element, color) {
  var svg = '<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="837.333" height="837.333" viewBox="0 0 628 628"><g fill="' + color + '"><path d="M298 1.1c-35.2 1.5-66.3 8.3-100.9 22C103.2 60.5 32.2 142.9 9 241.5c-5.9 25.1-8 44.1-8 72.2 0 51 10.4 94.8 33.1 140.3 36.4 72.8 99.9 128.4 177.5 155.3 64.6 22.4 139.2 22.4 203.8 0C530.1 569.5 611 468.2 624.5 347.6c1.9-16.9 1.9-51.3 0-68.1-14.5-129.7-107.1-236.6-233-269-31.2-8-59-10.8-93.5-9.4zm50 7.4c21.6 2.5 40.7 6.7 60.5 13.2l10.9 3.6-5.9 5.4c-4.2 3.8-6.6 5.3-8 5-1.1-.2-6-1.6-11-3.1C346.7 18.4 291.6 17.4 242 30 137.3 56.4 56 138.2 29.6 243.5c-3.1 12.4-6.2 30.4-7.1 41-1.3 17.6-1.2 17.2-5.3 17.9-2 .3-5.2.8-6.9 1.2l-3.3.6v-5.3c0-3 .7-11.5 1.5-18.9 9.6-89.5 59.1-171.1 134.6-221.8C182.2 31.9 229.8 14.4 278 8.5c14.9-1.8 54.6-1.8 70 0zm-10 18.6c20.4 1.8 50.4 7.8 61.1 12.2l3.3 1.3L379 61.2l-23.3 20.5-7.2.6c-25.1 2.2-53.8 19.9-69.3 42.8-7.2 10.7-14.7 29.4-13.9 34.7.2 1.3 1.9 4.2 3.8 6.5 5.4 6.4 11.2 15.4 15.1 23.2 4 7.9 10.1 24.5 9 24.5-.3 0-4.7-1.6-9.7-3.6l-9.1-3.6-2.3-5.8c-9.3-23.4-33.6-46.7-59.4-56.9-10-4-26.8-7.5-27.9-5.8-1.4 2.2-.8 3.4 2.2 4.7 4.4 1.8 10.1 7.8 13 13.5 2 4 2.5 6.5 2.5 12.7 0 4.2-.3 8-.7 8.3-.4.4-3.1-.2-6-1.4l-5.3-2.1-.1-5.5c-.2-18.3-25.1-23.8-33.4-7.4-3.5 6.7-2.4 14.7 2.8 20.3 7.3 7.7 20 7.4 26.7-.6 2.3-2.7 2.8-2.9 5.3-1.9 1.5.6 4 1.5 5.5 2.1 2.4.9 2.6 1.2 1.7 3.1-2.6 4.7-8.3 9.8-14.1 12.4-5.5 2.4-7.1 2.7-13.8 2.3-5.2-.3-9-1.2-11.9-2.7-14.3-7.3-20.2-25.1-13.4-39.6 2.8-5.9 8.1-11.6 12.8-13.7 1.5-.7 2.4-2 2.4-3.4 0-2.1-.3-2.2-3.7-1.7-9.8 1.5-23.5 5.7-31.8 9.7-16.3 8-33.4 22.7-42.8 36.9-6 9.1-12.6 23.8-15.2 33.9-2.1 8.7-2.5 9.3-5.1 9.9-4.3.8-6.8 2.4-10.2 6.4-3.8 4.3-4.6 7-4 13.6.7 6.7 4.7 11.7 11.8 14.5l5.3 2.2 2.2 8.3c1.2 4.6 3.1 10.7 4.3 13.6l2.1 5.2-5.2 1C55 295.6 30.1 300 28.2 300c-2.3 0-2.3.6-.1-20 7.8-71.1 45-140 100.9-186.7 58.2-48.7 134.9-73 209-66.2zm97.9 5c22.3 9.5 47.2 24.3 66.9 39.6 17.1 13.4 40.2 36.8 53.8 54.5l7.4 9.7-5.7 1.6c-3.2.9-6.5 1.8-7.5 2.1-1.1.3-3.9-2.4-9.5-9.3-32.9-41.1-75.7-71.9-126.7-91.3l-3-1.1 6-5.4c3.2-3 6-5.4 6.2-5.5.2 0 5.7 2.3 12.1 5.1zm-16 14.5c33.7 13.3 66.5 34.5 93.5 60.4 10.3 9.9 31.3 34.3 29.9 34.7-8.5 2.5-84.7 23.2-84.8 23-.1-.1-1.1-4-2.3-8.6-8.5-32.3-30.6-57-61.3-68.2-9.4-3.5-20.9-5.9-27.6-5.9-2.4 0-4.3-.4-4.1-.9.5-1.3 43.2-39 44.2-39 .5-.1 6.1 2 12.5 4.5zm-35.8 41.9c8.9 2.3 21 7.8 28.6 12.8 7.9 5.3 16.9 13 18.3 15.8 1 1.8.8 1.8-3.2-.3-6.4-3.3-19.4-3.7-27.1-.8-8.8 3.3-15.5 9.3-19.7 17.5-3.3 6.4-3.5 7.4-3.5 16.4 0 8.4.3 10.3 2.7 15.1 1.5 3.1 5.1 7.9 8 10.8 4.5 4.5 5 5.4 3.8 6.6-1.3 1.2-91.8 26.6-94.7 26.6-.5 0-1.7-2.5-2.7-5.6-2.7-8.7-12-26.2-18.1-34.3-3.1-4-5.5-7.4-5.3-7.5.2-.2 19.5-17.2 42.9-37.8 23.5-20.7 43.5-37.8 44.5-38 3.2-.6 19.4 1.1 25.5 2.7zM350 86.4c0 .3-49.5 44.2-77.2 68.5l-3.7 3.3 1.5-5.4c2.3-8.1 9.6-22.6 14.8-29.5 12.1-15.9 31.2-29.1 49.6-34.1 9.4-2.6 15-3.6 15-2.8zm78 34.8c5.7 3.4 11.2 9.1 14.2 14.8 1.9 3.8 2.3 6 2.3 14 0 8.8-.2 9.9-3.1 15l-3.1 5.5-16.9 4.7c-9.3 2.6-17.8 4.8-19 4.8-2.9 0-10.8-5.5-14.5-10.1-9.6-12.2-9-30.3 1.4-41.6 7.3-8 13.4-10.3 25.2-10 7.7.2 9.8.7 13.5 2.9zm143.8 26.5c23.2 36.2 38.7 77.6 45.4 120.8 2.5 16.7 3.6 55.1 1.9 73.2-10 109.2-78.2 205.2-178.1 250.9-29.7 13.5-60.5 22.1-93 25.9-16.4 2-52.6 2-69 0-101.7-11.9-190.4-72.7-237.5-162.9C19.6 413.6 7 364.9 7 321.4v-13.2l6.3-1.1c3.5-.6 6.7-1.1 7-1.1.4 0 .7 4.3.7 9.4 0 63.9 23.4 129.7 64.6 181.6 9 11.3 32.6 34.7 44.6 44.3 20.8 16.6 47.6 32.4 71.3 42.3 99 40.9 211 24.9 295.3-42.3 20.5-16.3 44.4-42.3 59.1-64.2 50-74.4 63.3-168.1 36-253.1-7.2-22.2-19.5-48.3-32.5-68.6-4.1-6.4-7.3-11.8-7.2-11.9.7-.6 10.5-3.3 12.5-3.4 1.6-.1 3.3 1.8 7.1 7.6zm-424.6-1c-6.4 8.2-7.7 12-7.7 22.3 0 8.6.3 10.1 3 15.3 3.7 7.4 10.9 14 18.3 16.7 11.6 4.4 26.5 1.3 35.6-7.4l3.9-3.7 18.4 12.2c10.1 6.7 18.3 12.3 18.3 12.5 0 .2-2.2 1.5-4.8 2.8-15.1 7.6-21.1 28-13.1 43.9 1.5 2.8 1.7 3.8.7 4.2-3.4 1.2-141 25.5-141.7 25.1-1-.7-5.5-13.3-7.5-20.9l-1.4-5.7 3.1-1.4c4.8-2 10.4-8.7 11.2-13.4 1.3-8.2-3-16.5-10.4-19.8l-3.9-1.7 1.5-6.1c2.9-12.9 10.5-28.8 18.6-39.3 9.5-12.3 23.3-23.9 36-30.4 5.1-2.6 21.9-8.8 24-8.9.5 0-.5 1.7-2.1 3.7zm59.3-.5c25 8.1 48.3 28.4 60.2 52.6 1.4 2.9 2.4 5.4 2.2 5.6-.2.1-14.7-5.4-32.2-12.2-29.6-11.7-31.7-12.6-31-14.6.5-1.2.8-5.3.7-9.1-.1-8.2-3.4-16.9-8.7-22.3l-3.2-3.3 3 .7c1.7.3 5.7 1.5 9 2.6zm347.6 10c57 88 62.2 197.5 14 290.5-50.9 97.8-155.4 158.4-265.6 153.9C188.4 595.8 89.1 525.8 46.7 420c-12.7-31.5-19.2-62.7-20.4-97.7l-.6-17.2 2.4-.6c9.8-2.3 47.4-8.4 47.9-7.8.4.4 3.2 4.7 6.3 9.4 15.7 23.9 41.2 41.2 68.5 46.5 9.4 1.8 9.9 1.8 10.5-.5.3-1.5-.3-2.3-2.5-3.2-4.9-2-11.5-9.4-13.7-15.4-2.3-6-2.7-13.9-1.1-19.7 1.5-5.3 6.9-12.8 11.5-16 5.5-3.7 15.2-6.2 21-5.5 18.9 2.6 31.1 22.6 24.5 40.1-2.5 6.6-9.3 14.7-14 16.6-3.2 1.3-3.4 1.8-2.1 3.9.7 1.1 2 1.1 7.6.2 33.3-5.8 63.1-28.6 78-59.5 5.1-10.8 6.8-15.5 9-26 .9-4.4 1.8-8.2 2-8.6.3-.4 4-1.3 8.4-2l7.9-1.2 9.2 5.8c35.5 22.7 36 23.2 35 25.9-1.4 3.7-1.2 10 .4 13.9l1.4 3.3-11.2.7c-23 1.3-45.1 8.8-65.1 22.2-33.1 22-53.5 54.7-59.6 95.1-1.6 10.4-1.2 10.8 10.1 11.5 10.6.7 17.4 3.3 26.3 9.8 8.1 6 13.8 14.3 16.9 24.3 2.7 8.9 2.2 22.4-1.1 30.9-3 7.7-10 17-16 21.3-7.5 5.4-7.4 6.3 2.8 16.4 14.8 14.6 34.6 26.7 54.1 32.9 10 3.1 27.6 6.6 29.1 5.6 2-1.2.7-3.3-3.5-5.8-17.6-10.3-20.7-34.4-6.2-48.9l4.9-4.9 2.4 3.1c7.4 9.4 22.2 9.4 29.5.1l2.3-3 3.7 3c2.1 1.8 5.1 5.9 7 9.8 2.9 5.8 3.3 7.7 3.3 14.2 0 5.5-.6 8.7-2.2 12.1-2.7 5.9-8.6 12.5-13.5 15-3.6 1.8-4.9 4.1-2.9 5.3 1.6 1 19.5-2.5 29.8-5.9 27.3-9.1 53.9-28.5 69-50.5 11.2-16.4 19.5-37.2 22.8-56.9 2.6-15.3 1.7-37.7-2-52.6-3.1-12.3-7.3-23.7-8.5-23-.5.3-1 .1-1.2-.5-.1-.5-3-1.5-6.3-2-16.4-3-27-8.5-39.1-20.5-7.4-7.3-9.8-10.6-13.2-17.5-4.2-8.6-8.2-21.4-7-22.5.3-.4 4.7 2.1 9.6 5.4 7.2 4.8 9.6 7.1 12.1 11.3 4.8 8.2 9.2 12.9 11.6 12.2 1.1-.3 3.8-3.3 6-6.7 4.5-6.8 10.7-11.5 19.3-14.7 15.3-5.8 36 1.9 44.2 16.4 3.7 6.5 5.8 6.8 10.4 1.5 15.4-18.1 16.7-46.5 3-66.5-6.9-10.1-16.6-17.5-27.7-21.3-5.5-1.9-5.7-1.9-6.7-.2-.7 1.5-.3 2.3 2.8 4.2 5.7 3.7 9.5 10.8 10 18.5.5 8-1.4 13.5-6.4 18.7l-3.6 3.7-3.9-3.4c-6.5-6-14.3-6-20.8 0l-3.8 3.3-3.1-3.2c-10.4-10.8-9.2-28.1 2.8-37.1 2.5-1.9 3.6-3.4 3.3-4.6-.4-1.6-.9-1.6-4.8-.5-4.7 1.5-11.7 4.8-15.5 7.5-2.5 1.8-2.8 1.7-11.5-1.6-5-2-9.4-3.9-9.8-4.3-.5-.5 1.4-2.5 4.1-4.5 6.5-4.7 17.5-16.4 21.9-23.3 10.7-16.8 15.3-31.4 16-51.5l.6-13.8 3.6-1.1c11.2-3.2 81.8-22.7 82.8-22.8.6-.1 4.4 5 8.4 11.1zm-100.8 6.7c.2 3.1-.1 3.4-4.3 4.7-2.5.8-4.6 1.4-4.6 1.4-.1 0 .9-2.6 2.2-5.8 1.3-3.1 2.4-8 2.5-10.7l.1-5 1.9 6c1.1 3.3 2.1 7.5 2.2 9.4zM177.2 156c6.8 1.9 11.2 10.3 8.9 17.2-3.7 11.2-19.2 13.3-25.1 3.5-4.2-6.8-1.4-16.2 6-19.9 4.1-2.1 5.2-2.2 10.2-.8zM454 194.5c-3.7 22.5-15.2 42.8-32.3 57.2-10.6 8.8-10.4 8.8-18.2 5.7-5.8-2.3-6.6-2.9-6-4.8 2.6-8.8 1.5-19.5-3.1-28.6-2.2-4.5-9.8-13-11.5-13-1.8 0-.8-2.4 5.3-13.1 7.3-12.8 7.8-13.1 21.1-12.3 11.1.7 18-1.3 26.3-7.6 3.4-2.5 7.7-4.6 12.1-5.8l6.8-1.9.3 8.6c.2 4.7-.2 11.7-.8 15.6zm-27.2-15.4c-2.1 1-5.9 2.2-8.5 2.4-5.6.6-4.8.1 3.9-2.4 8.2-2.4 9.1-2.4 4.6 0zm-193.6 16c15.6 6.1 30.6 11.9 33.4 13l5.2 2 2.1 7.8c3 11.2 2.8 11.7-3 5.6-5.9-6.3-13-9.5-22.3-10.1-5.7-.3-6.7-.9-25.5-13.3-17.2-11.4-22.8-16.1-19.2-16.1.5 0 13.7 5 29.3 11.1zm154.8-5.6c0 .3-2.2 4.5-5 9.4l-5 8.8-5.2-1.8c-16.3-5.6-37.3 2.4-44.9 17.3l-1.9 3.7-6.2-2.3c-16-6.1-21.3-8.5-21.6-9.8-.2-1 10.7-4.4 43.5-13.5 43.4-12 46.3-12.8 46.3-11.8zm-12.8 21.7c7.1 3.3 13.3 9.4 16.7 16.7 2.2 4.7 2.6 7 2.6 14.3 0 4.8-.5 9.2-1 9.7-.8.8-10.6-2.6-32.3-11.1-17.2-6.7-31.2-12.5-31.2-12.9 0-.4 1.5-2.9 3.3-5.5 3.6-5.5 10.7-10.7 17.6-12.9 6.8-2.2 17.4-1.4 24.3 1.7zm-80.5 8.1c.7.8 2.2 10.9 2.9 20 .6 8.7.5 9.7-.9 9.1-1.6-.6-10.9-11.5-14.1-16.5-1.3-2.1-5.6-16.5-5.6-19 0-.6 16.7 5.4 17.7 6.4zm-34.3.9c4.1 2.1 9.1 6.6 11 9.9 1.3 2.1 1.4 2.9.5 2.4-3.8-2.3-21.9-14.6-21.9-14.9 0-.6 8.1 1.4 10.4 2.6zm-1.2 8.9l16.8 11.2v5.3c0 9.2-.6 9.9-10.7 11.7-23 4.2-23.1 4.2-25.1 2.4-3-2.8-7-2.2-9 1.3-2.4 4.2-5.3 3.9-7.9-.8-1.1-2-2.4-4.7-2.7-5.9-.6-2-.4-2.1 2.6-1.7 7.1 1.2 11.6-6.8 6.7-11.7-1.6-1.6-3-2-6-1.7-3.8.3-4 .2-3.4-2 .8-3.3 4.7-9.2 8.1-12.3 3.3-3.1 10.2-6.9 12.4-6.9.8 0 9 5 18.2 11.1zm64.5 1.4c.1 0 0 2.5-.4 5.3l-.6 5.2h-20.6l-.5-3.3c-.3-1.7-.8-6.2-1.1-9.9l-.6-6.7 11.8 4.6c6.5 2.5 11.9 4.7 12 4.8zM64.3 245.7c-.1 7.6-.3 13.9-.3 14 0 .1-1.3-.3-3-.8-1.6-.6-4.3-2.6-6-4.5-5.3-6-3.6-16.2 3.3-20.4 6.1-3.8 6.2-3.5 6 11.7zm10.9-9.9c6 5.5 6.1 13.9.2 19.8-6 5.9-6.9 4.8-7.2-9.1-.1-6.5 0-12.5.2-13.2.7-1.7 3.4-.7 6.8 2.5zm284.6 8.8c16.3 6.3 30.1 11.9 30.6 12.4 2 2-7.2 12.1-13.7 15.1-1.7.8-2.3 1.7-1.9 3.1.4 1.7 1 1.8 4.6 1.2 6.8-1.1 16.6-4.4 24.3-8.1l7.2-3.6 10.1 3.8c5.5 2.1 10 4 10 4.2 0 .2-2 3-4.4 6.1-7.9 10.3-11 18.5-12.1 31.7-.4 3.8-.2 9.2.4 12 .5 2.7.8 5.1.6 5.3-.2.2-8.5-5.1-18.5-11.8-14.5-9.7-18-12.5-17.5-13.8 1.5-3.5 1.7-10.1.5-13.7-2.5-7.7-11.3-14.4-18.8-14.5-4.1 0-9.9 2.4-13.2 5.5l-2.5 2.3-5-3.5c-2.7-1.9-4.1-3.2-3-2.9 1.1.3 3.7.8 5.8 1.2 3.2.5 3.7.4 3.7-1.3 0-1.2-1.8-3.1-4.9-5.1-9.1-5.9-15-16.9-15.1-27.9 0-6.5.6-9.3 2.2-9.3.5 0 14.3 5.2 30.6 11.6zm-71.7 3.8c2.8 1.9 4.7 3.6 4.2 3.9-.4.2-3.1.8-5.8 1.1l-5 .7.3-4.5c.2-2.5.6-4.6.8-4.6.3 0 2.7 1.5 5.5 3.4zm34.9-2.5c0 .5-4.2 1.6-9.2 2.5-5.1.9-9.9 1.9-10.5 2.1-.9.3-1.3-.6-1.3-2.5v-3h10.5c5.8 0 10.5.4 10.5.9zm2.9 10.5c1.2 3 4 7.5 6.2 9.9l3.9 4.5-4.4-1.3c-2.4-.7-6.3-2.3-8.7-3.5-6.1-3.2-18.3-11.4-17.3-11.7 1.5-.5 14.8-3.1 16.5-3.2 1-.1 2.3 1.9 3.8 5.3zm76.1 4.5l4.4 1.8-2.9 1.5c-1.7.9-6.3 2.8-10.4 4.2l-7.4 2.7 3.6-4c1.9-2.1 4-4.9 4.7-6 1.3-2.5 2.2-2.5 8-.2zm-133.6 4.2c-5.4 5.7-10.7 8.1-18.5 8.7-7.3.5-15.7-1.6-18.1-4.5-1.1-1.5-1.1-1.6.7-.8 3.1 1.3 6.8.9 8.2-1 .9-1.3 5.4-2.5 16-4.5 8.1-1.5 15-2.5 15.2-2.3.3.2-1.3 2.2-3.5 4.4zm7.2 2.1c-1.1 6.8-5.5 18.7-10.1 27.5-10 19.1-26.5 35.2-45.5 44.8-7.5 3.8-20.4 8.5-23.2 8.5-.5 0 .4-1.8 2.1-3.9 5.6-7.1 7.6-12.7 7.6-21.6-.1-6.6-.6-9.1-2.8-14-5.2-11.2-15.5-18.6-27.8-20.1-10.3-1.2-23 4.3-29.8 12.9-9.9 12.6-9.3 31.4 1.3 43.5l3 3.5-3.4-.8c-6.8-1.5-19.5-6.6-26.4-10.7-14.8-8.7-26.5-19.7-35.6-33.5-4.9-7.6-5-7.8-2.8-8.5 1.3-.3 33.9-6.4 72.6-13.4l70.3-12.7 2.2 2.1c4.5 4.2 12.7 7.2 19.9 7.2 9.6 0 16.6-2.9 23.1-9.5 2.9-2.9 5.4-5.3 5.6-5.4.2 0 .1 1.8-.3 4.1zm169.4 3.7c-1.2 2.3-1.8 2.5-3.9 1.2-1.1-.7-.7-1.2 1.5-2.4 3.5-1.8 3.9-1.6 2.4 1.2zm53.3 0c21.9 15 29 43.9 16.6 67.2-1.7 3.1-4.1 6.7-5.4 7.9l-2.3 2.2-1.6-3c-3-5.8-10.5-12.3-18.7-16.1-7-3.3-7.8-3.9-6.4-5.1 2.6-2.1 4.5-6.6 4.5-10.5 0-2.8.8-4.2 4-7.1 2.2-2 5.1-6.1 6.6-9.2 2.3-4.9 2.6-6.5 2.2-13.1-.3-5.1-1.2-9-2.7-11.9-1.2-2.3-1.9-4.2-1.6-4.2.4 0 2.5 1.3 4.8 2.9zm-58.4 5c1 .7 1.5 3.2 1.5 9.3.1 7.3.5 9 3.1 13.7 1.6 3 4.6 6.7 6.6 8.3 2.6 2.1 3.5 3.5 3.2 4.9-.6 2.3 2.2 10.2 4.3 12 1.2 1 .1 1.8-6.3 5-4.6 2.2-9.6 5.6-12.2 8.3l-4.4 4.5-7.2-4.9c-5.9-4-7.3-5.5-8.3-8.8-4.8-16.1-.4-35.7 10.9-48.6 4-4.6 6.1-5.4 8.8-3.7zm-69.9 5.5c4.6 3 7.6 9.7 6.7 15.2-.3 2-.9 3.9-1.2 4.2-.9.9-26.6-16.8-25.9-17.9.3-.6 2.5-2 4.8-3 5.2-2.5 10.4-2 15.6 1.5zm-10.3 14.7c6.8 4.5 12.3 8.6 12.3 9.1 0 1.8-3.3 2-13.1.7-11.1-1.4-12.4-2.3-13.6-9.2-.6-3.7.2-8.7 1.4-8.7.4 0 6.3 3.7 13 8.1zm116.1 7.9c1.7 1.1 3.2 2.6 3.2 3.4 0 2.5-11.4 3.5-16.7 1.5l-2.8-1 3.3-3c3.9-3.5 8.2-3.8 13-.9zm-96.1 5.7c-.7.6-4.6-1-4.1-1.8.3-.5 1.4-.3 2.4.3 1.1.7 1.8 1.3 1.7 1.5zm-29.4 1.5c3.7 2.7 12.1 3.5 18.1 1.8 4.1-1.1 5.1-.9 14.7 2.4 5.6 1.9 10.6 4.1 11.1 4.8.4.7.8 2.4.8 3.8 0 10.2 9 29.3 18.5 39.8 12.1 13.2 24.7 20.4 41.5 23.8 4.7.9 8.8 2.2 9.3 2.8 1.6 2.4 6.7 20.6 8.3 29.6 1.3 7.3 1.5 13.2 1.1 25.5-.3 8.8-1 17.3-1.5 19l-.9 3-.7-4c-1.6-8.6-9.2-17.7-18.5-22.3-4.8-2.3-6.9-2.7-14.1-2.7-7.1 0-9.4.4-14 2.6-7.1 3.3-13.6 9.9-16.8 16.9-3.7 8-3.7 19.2 0 27.3 3.6 7.6 11.2 15 18.3 17.6 10.1 3.8 23.4 2.4 30.9-3.2 5.2-3.9 5.7-4.1 4.7-1.5-3 7.9-13.9 23.6-23 33.1-10.7 11.2-22.5 19.7-37.6 27.2-11.2 5.6-28.3 11.5-33.3 11.5-.8 0 .1-1.8 2.1-4.2 9.4-11.6 11.1-25.2 4.8-38.4-2.6-5.5-10.2-14.4-12.2-14.4-.5 0-.9-2.1-.9-4.8-.1-10-6.9-17.9-16.4-18.9-11.3-1.3-20.6 6.9-20.6 18.4-.1 4.3-.4 5.1-3.5 7.3-7.3 5.3-13.5 17.7-13.5 26.9 0 7.3 3.5 17.2 8 23 2.2 2.8 3.5 5.1 2.8 5.1-3.1 0-20-5.1-27.4-8.3-14.7-6.3-31-17.5-42.3-29l-5.4-5.5 6.2-5.8c7.3-6.7 11.4-12.4 14.5-20 2.2-5.4 2.3-5.4 4.1-3.4 3.9 4.3 11.5 1.2 11.7-4.8.2-5.4-4.6-9.1-9.4-7.3l-2.5.9-.6-8.6c-.5-9.9-3.1-17.6-8.3-25.3-1.9-2.8-3.4-5.3-3.4-5.5 0-.2.9-.4 1.9-.4 4.4 0 6.8-8.5 3.4-12.2-2.1-2.4-8.4-2.4-10.6-.1-.8 1-1.7 2.8-1.9 4-.3 2-.5 2-6.5-1.7-7.1-4.3-16.7-7-24.8-7h-5.7l.7-4.3c3.9-25.9 12.2-46.5 26-64.9 6-7.9 21.7-23.8 23.6-23.8.5 0-.1 1.7-1.3 3.7-2.7 4.4-2.9 12.3-.5 16.8 4.7 9 16 13 24.6 8.5 10.8-5.5 14.1-18.2 7.2-27.7-3.9-5.4-8.8-7.6-16.2-7.1-5.8.3-5.9.3-3.6-1.4 3.6-2.9 20.7-11.4 27.2-13.6 14.7-5 25.3-6.9 39.8-7.1 7.7-.1 9.3.2 12 2.1zm114.5 2.5c3.1.5 3.2.7 3.2 5.4 0 4.1-.3 4.9-1.8 4.9-2.7 0-7.1-5-7.8-9-.6-3-.5-3.3 1.2-2.6 1 .4 3.4 1 5.2 1.3zm16.2.3c0 3.4-2.8 7.9-6 9.5l-3 1.6v-10.9l3.8-1c5.3-1.4 5.2-1.4 5.2.8zm-195.1 24.9c5.3 5.3 6.2 10.5 2.9 16.8-3 5.9-7.6 8.6-13.9 8-7.8-.7-13.2-6.5-13.2-14.1 0-8.9 5.9-14.6 15.1-14.6 4.7 0 5.6.4 9.1 3.9zm144.5 4.4c1.7 1.4 2.6 2.8 2.2 3.6-.9 1.4-2 .8-4.6-2.9-2.6-3.6-1.6-3.8 2.4-.7zm18 100.7c20.3 7.6 25.5 35 9.5 49.4-6 5.4-12.1 7.6-20.8 7.6-11.2-.1-20.3-5.9-25.9-16.5-3.5-6.7-3.7-17.6-.5-24.7 6.4-14.1 23.2-21.2 37.7-15.8zM349 494.8c1.9.9 4.5 3.2 5.7 5.1 2.5 3.7 3.2 10.7 1 9.8-5.3-2-13-2.7-18.7-1.7-3.4.6-6.8 1.4-7.6 1.7-2.3.9-1.7-5.9.9-9.8 2.6-3.9 7.9-6.9 12.2-6.9 1.7 0 4.6.8 6.5 1.8zM337 514c-1.1 1.1-2 3-2 4.2v2.1l-2.5-2.3c-1.4-1.3-2.5-2.7-2.5-3.2 0-1.1 3.8-2.7 6.8-2.7l2.2-.1-2 2zm17.4 0c.7.7.2 1.8-1.7 3.7-2.5 2.6-2.7 2.6-2.7.7 0-1.1-1-3.1-2.2-4.4l-2.2-2.3 3.9.6c2.1.3 4.3 1.1 4.9 1.7z"/><path d="M166 305.5c-6.8 3.1-11 9.4-11 16.5 0 14.8 17 23.3 28.7 14.4 9.9-7.5 9.2-22.3-1.4-29.3-4.5-2.9-11.7-3.6-16.3-1.6zm11.2 3.5c6.8 1.9 11.2 10.3 8.9 17.2-3.7 11.2-19.2 13.3-25.1 3.5-4.2-6.8-1.4-16.2 6-19.9 4.1-2.1 5.2-2.2 10.2-.8zM319.6 526.3c-2.7 2-1.8 7.7 1.6 9.6 2.5 1.4 2.9 1.4 5.5-.5 3.4-2.6 4-4.8 1.9-7.9-1.8-2.8-6.1-3.3-9-1.2zM356.6 526.9c-2.4 2.6-1.7 6 1.7 8.5 2.6 1.9 3 1.9 5.5.5 3.3-1.8 4.2-6.8 1.7-9.3-2.2-2.2-6.8-2-8.9.3zM231.4 224.5c-1.9 2.9-1.1 6 2 8.1 5.7 3.7 11.8-4.4 6.8-8.9-2.8-2.5-6.9-2.1-8.8.8zM268.2 456.2c-3 3.3-3.6 7-1.8 10.7 3 5.7 9.5 6.9 14 2.5 3.5-3.6 3.6-9.5.1-12.9-3.2-3.3-9.3-3.4-12.3-.3zM428 446c-2.4 2.4-2.5 4.8-.4 7.8 1.8 2.6 6.5 3 8.8.6 2.4-2.3 2-7-.6-8.8-3-2.1-5.4-2-7.8.4zM416.6 481.6c-3.5 3.5-.8 10.4 4.2 10.4 2.5 0 6.2-3.6 6.2-6.2 0-4.6-7.1-7.5-10.4-4.2z"/></g></svg>';
  var encoded = window.btoa(svg);
  $(element).css("background-image", "url(data:image/svg+xml;base64," + encoded + ")");
}



let deferredPrompt;

/* Listening for the beforeinstallprompt event. When the event is fired, it prevents the default
behavior (which is to show the mini-info bar) and stores the event in a variable so it can be
triggered later. */
window.addEventListener('beforeinstallprompt', (e) => {
  // Prevent the mini-info bar from appearing on mobile
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
  // Update UI notify the user they can install the PWA
  //console.log("Ik kan geïnstalleerd worden!!");
  $('.installButton').css('display', 'block');

  //showInstallPromotion();
});


function A2HS() {
  // Hide the app provided install promotion
  $('.installButton').css('display', 'none');
  // Show the install prompt
  deferredPrompt.prompt();
  // Wait for the user to respond to the prompt
  deferredPrompt.userChoice.then((choiceResult) => {
    if (choiceResult.outcome === 'accepted') {
      //console.log('User accepted the install prompt');
    } else {
      //console.log('User dismissed the install prompt');
    }
  });
}

/* The code below is listening for the appinstalled event. When the event is fired, the install button
is hidden. */
window.addEventListener('appinstalled', (evt) => {
  $('.installButton').css('display', 'none');
  //console.log('INSTALL: Success');
});

window.addEventListener('DOMContentLoaded', () => {
  let displayMode = 'browser tab';
  if (navigator.standalone) {
    displayMode = 'standalone-ios';
  }
  if (window.matchMedia('(display-mode: standalone)').matches) {
    displayMode = 'standalone';
  }
  // Log launch display mode to analytics
  //console.log('DISPLAY_MODE_LAUNCH:', displayMode);
});

window.addEventListener('DOMContentLoaded', () => {
  window.matchMedia('(display-mode: standalone)').addListener((evt) => {
    let displayMode = 'browser tab';
    if (evt.matches) {
      displayMode = 'standalone';
    }
    // Log display mode change to analytics
    //console.log('DISPLAY_MODE_CHANGED', displayMode);
  });
});


/**
 * It takes a number of seconds and returns a string with the number of days, hours, minutes and
 * seconds.
 * @param seconds - The number of seconds to be converted to days, hours, minutes and seconds.
 * @returns the number of days, hours, minutes, and seconds.
 */
function secondsToDhms(seconds) {

  seconds = Number(seconds);

  var d = Math.floor(seconds / (3600 * 24));

  var h = Math.floor((seconds % (3600 * 24)) / 3600);

  var m = Math.floor((seconds % 3600) / 60);

  var s = Math.floor(seconds % 60);



  var dDisplay = d > 0 ? d + (d == 1 ? " day, " : " days, ") : "";

  var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";

  var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";

  var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";

  return dDisplay + hDisplay + mDisplay + sDisplay;

}

/**
 * It gets the data from the PHP file, and then it puts it in a div.
 * @param dataURL - the url to the json file
 */
function GetSecondsForEpisodes(dataURL) {
  $.ajax({
    type: "POST",
    url: '/php/Totals.php',
    data: {'TOTAL':dataURL},
    dataType: 'json',
    xhrFields: {
      withCredentials: true
    },crossDomain:true,
    cache: false
  }).done(function (resultaat) {
    var Tiles = "";

    for (var i = 0; i < resultaat.data.length; i++) {
      Tiles += "<div class='TimeDiv padded max_20 DarkBlueBackground bordered'><b>" + resultaat.data[i].titel + ": </b><span> " + secondsToDhms(resultaat.data[i].total).replace(/,\s*$/, "") + "</span></div>";

    }
    $('#Tiles').html(Tiles);

  }).fail(function (response, statusText, xhr) {

  }).always(function () {

  });
}

function HideNotificationButton() {
  if (Notification.permission === "granted") {
    $('.custom-button').hide();

  }
}

window.addEventListener("afterprint", ClosePrint);

/**
 * It shows the nav, path, access, footer, back-to-top, changes the width of the WikiDetails and Inhoud
 * and removes the class print.
 */
function ClosePrint(){
  $('nav').show();
  $('.path').show();
  $('.access').show();
  $('footer').show();
  $('.back-to-top').show();
  $('#WikiDetails').css("width","26%");
  $('#WikiDetails').css("margin-top","-5em");
  $('#Inhoud').css("width","max-content");
  $('body').removeClass('print');


}

window.onbeforeprint = function() {printContent();};
function printContent(){
  $('nav').hide();
  $('.path').hide();
  $('.access').hide();
  $('footer').hide();
  $('.back-to-top').hide();
  $('#WikiDetails').css("width","100%");
  $('#WikiDetails').css("margin-top","1em");
  $('#Inhoud').css("width","100%");
  $('body').addClass('print');


}

function ToggleNightMode() {
  
  if (getCookie("Theme")=="Dark"){
    setCookie("Theme","Light",30);
    setDarkModeFromCookie();
  }else {
    setCookie("Theme","Dark",30);
    setDarkModeFromCookie();
  }
}


function setDarkModeFromCookie() {
  var element = document.body;
  
  if (getCookie("Theme")=="Dark"){
    element.classList.add("dark-mode");
    $("*").addClass("dark-mode");
    $('::-webkit-scrollbar-thumb').addClass("dark-mode");
    $('#NightMode i').removeClass("fa-moon-o");
    $('#NightMode i').addClass("fa-sun-o");
    
  }else{
    element.classList.remove("dark-mode");
  $("*").removeClass("dark-mode");
  $('::-webkit-scrollbar-thumb').removeClass("dark-mode");
 
  
  $('#NightMode i').removeClass("fa-sun-o");
    $('#NightMode i').addClass("fa-moon-o");
  }
}


$(document).ready(
  function()
  {

    $('#lang-select').on('change', function (e) {
      var optionSelected = $("#lang-select option:selected", this);
      var valueSelected = this.value;
      setCookie("lang",this.value,30);
      location.reload();
      //$(".main__path,#Tags,#SiteContent article").html('');
      //GetContent(menu, id);


      //$("#lang-select option").attr("disabled",false);
      //$("#lang-select option").attr("selected",false);
      //$("#lang-select option[value='"+this.value+"']").attr("disabled","disabled");
      //$("#lang-select option[value='"+this.value+"']").attr("selected","selected");
  });

      $('#font-select').on( 'change',
          function()
          {
            var selectedOption = $('#font-select').val();
              $('body').css( 'font-family', selectedOption );
              setCookie("Font",selectedOption,30);
              $("#font-select option").attr("disabled",false);
              $("#font-select option").attr("selected",false);
              $("#font-select option[value='"+selectedOption+"']").attr("disabled","disabled");
              $("#font-select option[value='"+selectedOption+"']").attr("selected","selected");
          });
  });

  function setFontFromCookie(){
    var selectedOption = getCookie("Font");
    $('body').css( 'font-family', selectedOption );
    setCookie("Font",selectedOption,30);
    $("#font-select option[value='"+selectedOption+"']").attr("disabled","disabled");
    $("#font-select option[value='"+selectedOption+"']").attr("selected","selected");

  }

  function getSizesFromCookie(){
    $('#size').text(getCookie("size"));
    $("main,.under,footer").children().each(function() {
      var size = parseInt($(this).css("font-size"));
      size = size + parseInt(getCookie("size")) + "px";
      $(this).css({
        'font-size': size
      });
    });
  }

  $(function() {
    $("#increase").click(function() {
      siz = parseInt($('#size').text());
      siz+=1;
      $('#size').text(siz);
      setCookie("size",siz,30);
      $("main,.under,footer").children().each(function() {
        var size = parseInt($(this).css("font-size"));
        size = size + 1 + "px";
        $(this).css({
          'font-size': size
        });
      });
    });

  });
  $(function() {
    $("#decrease").click(function() {
      siz = parseInt($('#size').text());
      siz-=1;
      $('#size').text(siz);
      setCookie("size",siz,30);
      $("main,.under,footer").children().each(function() {
        var size = parseInt($(this).css("font-size"));
        size = size - 1 + "px";
        $(this).css({
          'font-size': size
        });
      });
    });
  });

function GalleriesForPage(Galleries){
  
  //add title of Gallery
  //when applicable, add event data
  //get images for Gallery


  for (let [key, value] of Object.entries(Galleries)) {
    var Gallery = "";
    Gallery += "<div>";
    Gallery +="<div class='Gallery_Items' id='gal_"+value.id+"'>";
    
    for (let [Imgkey, Imgvalue] of Object.entries(value.images)) {
      let folder="";
      if(Imgvalue.folder!==""){

        folder=Imgvalue.folder+"/"

      }
      let caption="";
      if(Imgvalue.caption!==null){

        caption=Imgvalue.caption;
      }
      let src = "https://www.doctorwhofans.be/images/content__gallery__images/"+folder+Imgvalue.filename;
      Gallery +='<a class="Thumbnail_Link" data-caption="'+caption+'" href="'+src+'"><img src="'+src+'" class="Gallery_Thumbnail"></a>';

    }
    Gallery+= "</div></div>";
    $("#Gallery_"+value.id).html(Gallery);
    baguetteBox.run('#gal_'+value.id,{async:true,titleTag:true});
  }
}

