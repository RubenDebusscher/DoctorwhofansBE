if(typeof(window.console)=='undefined'){window.console={log:function(str){}};}if(typeof(window.__xatajax_included__)!='object'){window.__xatajax_included__={};};(function(){var headtg=document.getElementsByTagName("head")[0];if(!headtg)return;var linktg=document.createElement("link");linktg.type="text/css";linktg.rel="stylesheet";linktg.href="/index.php?-action=css&--id=switch_use-08d163df24eaf633256c2c5af2839953";linktg.title="Styles";headtg.appendChild(linktg);})();if(typeof(window.__xatajax_included__['xataface/modules/g2/global.js'])=='undefined'){window.__xatajax_included__['xataface/modules/g2/global.js']=true;if(typeof(window.__xatajax_included__['xatajax.actions.js'])=='undefined'){window.__xatajax_included__['xatajax.actions.js']=true;if(typeof(window.__xatajax_included__['xatajax.form.core.js'])=='undefined'){window.__xatajax_included__['xatajax.form.core.js']=true;(function(){var $=jQuery;XataJax.form={findField:findField,createForm:createForm,submitForm:submitForm};function findField(startNode,fieldName){var field=null;$(startNode).parents('.xf-form-group').each(function(){if(field){return;}
field=$('[data-xf-field="'+fieldName+'"]',this).get(0);});if(!field){var parentGroup=$(startNode).parents('form').get(0);field=$('[data-xf-field="'+fieldName+'"]',parentGroup).get(0);}
return field;}
function createForm(method,params,target,action){if(typeof(action)=='undefined')action=DATAFACE_SITE_HREF;var form=$('<form></form>').attr('action',action).attr('method',method);if(target)form.attr('target',target);$.each(params,function(key,value){form.append($('<input/>').attr('type','hidden').attr('name',key).attr('value',value));});return form;}
function submitForm(method,params,target,action){var form=createForm(method,params,target,action);$('body').append(form);form.submit();}})();}
(function(){var $=jQuery;if(typeof(XataJax.actions)=='undefined'){XataJax.actions={};}
XataJax.actions.doSelectedAction=doSelectedAction;XataJax.actions.handleSelectedAction=handleSelectedAction;XataJax.actions.hasRecordSelectors=hasRecordSelectors;XataJax.actions.getSelectedIds=getSelectedIds;function getSelectedIds(container,asString){if(typeof(asString)=='undefined')asString=false;var ids=[];var checkboxes=$('input.rowSelectorCheckbox',container);checkboxes.each(function(){if($(this).is(':checked')&&$(this).attr('xf-record-id')){ids.push($(this).attr('xf-record-id'));}});if(asString)return ids.join("\n");return ids;}
function doSelectedAction(params,container,confirmCallback,emptyCallback){var ids=[];var checkboxes=$('input.rowSelectorCheckbox',container);checkboxes.each(function(){if($(this).is(':checked')&&$(this).attr('xf-record-id')){ids.push($(this).attr('xf-record-id'));}});if(ids.length==0){if(typeof(emptyCallback)=='function'){emptyCallback(params,container);}else{alert('No records are currently selected.  Please first select the records that you wish to act upon.');}
return;}
if(typeof(confirmCallback)=='function'){if(!confirmCallback(ids)){return;}}
params['--selected-ids']=ids.join("\n");XataJax.form.submitForm('post',params);}
function hasRecordSelectors(container){return($('input.rowSelectorCheckbox',container).size()>0);}
function handleSelectedAction(aTag,selector){var href=$(aTag).attr('href');var confirmMsg=$(aTag).attr('data-xf-confirm-message');var confirmCallback=null;if(confirmMsg){confirmCallback=function(){return confirm(confirmMsg);};}
var useFullSetIfEmpty=$(aTag).attr('data-xf-use-full-set-if-empty');var emptyCallback=null;if(useFullSetIfEmpty){emptyCallback=function(){if(confirm(useFullSetIfEmpty)){window.location.href=href;}};}
var params=XataJax.util.getRequestParams(href);XataJax.actions.doSelectedAction(params,$(selector),confirmCallback,emptyCallback);return false;}})();}
if(typeof(window.__xatajax_included__['xataface/modules/g2/advanced-find.js'])=='undefined'){window.__xatajax_included__['xataface/modules/g2/advanced-find.js']=true;(function(){var $=jQuery;$(document).ajaxError(function(e,xhr,settings,exception){if(!console)return;console.log(e);console.log(xhr);console.log(settings);console.log(exception);});var g2=XataJax.load('xataface.modules.g2');g2.AdvancedFind=AdvancedFind;function AdvancedFind(o){this.table=$('meta#xf-meta-tablename').attr('content');this.el=$('<div>').addClass('xf-advanced-find').css('display','none').get(0);$.extend(this,o);this.loaded=false;this.loading=false;this.installed=false;if(window.location.hash==='#search'){this.show();}}
$.extend(AdvancedFind.prototype,{load:load,ready:ready,show:show,hide:hide,install:install});function load(callback){callback=callback||function(){};var self=this;$(this.el).load(DATAFACE_SITE_HREF+'?-table='+encodeURIComponent(this.table)+'&-action=g2_advanced_find_form',function(){decorateConfigureButton(this);var params=XataJax.util.getRequestParams();var widgets=[];var formEl=this;$('[name]',this).each(function(){if(params[$(this).attr('name')]){$(this).val(params[$(this).attr('name')]);}
var widget=null;if($(this).attr('data-xf-find-widget-type')){widget=$(this).attr('data-xf-find-widget-type');}else if($(this).get(0).tagName.toLowerCase()=='select'){widget='select';}
if(widget){widgets.push('xataface/findwidgets/'+widget+'.js');}});if(widgets.length>0){XataJax.util.loadScript(widgets.join(','),function(){self.loaded=true;callback.call(self);$('[name]',formEl).each(function(){if(params[$(this).attr('name')]){$(this).val(params[$(this).attr('name')]);}
var widget=null;if($(this).attr('data-xf-find-widget-type')){widget=$(this).attr('data-xf-find-widget-type');}else if($(this).get(0).tagName.toLowerCase()=='select'){widget='select';}
if(widget){var w=new xataface.findwidgets[widget]();w.install(this);}});$('button.xf-advanced-find-clear',formEl).click(function(){$('input[name],select[name]',formEl).val('');return false;});$('button.xf-advanced-find-search',formEl).click(function(){$(this).parents('form').find('[name="-action"]').val('list');$(this).parents('form').submit();});$(self).trigger('onready');});}else{self.loaded=true;callback.call(self);$(self).trigger('onready');}});}
function ready(callback){if(this.loaded){callback.call(this);}else{$(this).bind('onready',callback);if(!this.loading){this.load();}}}
function install(){if(this.installed)return;$(this.el).insertAfter('a.xf-show-advanced-find');this.installed=true;}
function show(){this.ready(function(){window.location.hash='#search';if(!this.loaded)throw"Cannot show advanced find until it is ready.";if(!this.installed)this.install();$(this.el).parents('form').find('[name="-action"]').val('list');if(!$(this.el).is(':visible')){$(this.el).slideDown(function(){var x=$(this).offset().left;$(this).width($(window).width()-x-5);});}});}
function hide(){this.ready(function(){window.location.hash='';if(!this.loaded||!this.installed)return;if($(this.el).is(':visible')){$(this.el).slideUp();}});}
function decorateConfigureButton(el){$('li.configure-advanced-find-form-action a',el).click(function(){var iframe=$('<iframe>').attr('width','100%').attr('height',$(window).height()*0.8).on('load',function(){var winWidth=$(window).width()*0.8;var width=Math.min(800,winWidth);$(this).width(width);var showHideController=iframe.contentWindow.xataface.controllers.ShowHideColumnsController;showHideController.saveCallbacks.push(function(data){data.preventDefault=true;dialog.dialog('close');window.location.reload(true);});}).attr('src',$(this).attr('href')+'&--format=iframe').get(0);;var dialog=$("<div></div>").append(iframe).appendTo("body").dialog({autoOpen:false,modal:true,resizable:false,width:"auto",height:"auto",close:function(){$(iframe).attr("src","");},buttons:{'Save':function(){$('button.save',iframe.contentWindow.document.body).click();}},create:function(event,ui){$('body').addClass('stop-scrolling');},beforeClose:function(event,ui){$('body').removeClass('stop-scrolling');}});dialog.dialog("option","title","Show/Hide Columns").dialog("open");return false;});}})();}
if(typeof(window.__xatajax_included__['jquery.floatheader.js'])=='undefined'){window.__xatajax_included__['jquery.floatheader.js']=true;(function($){$.fn.floatHeader=function(config){config=$.extend({fadeOut:200,fadeIn:200,forceClass:false,markerClass:'floating',floatClass:'floatHeader',recalculate:false,IE6Fix_DetectScrollOnBody:true},config);return this.each(function(){var self=$(this);var tableClone=self[0].cloneNode(false);var table=$(tableClone);var cloneId=table.attr("id")+"FloatHeaderClone";table.attr("id",cloneId);table.parent().remove();self.floatBox=$('<div class="'+config.floatClass+'"style="display:none"></div>');self.floatBox.append(table);self.IEWindowWidth=document.documentElement.clientWidth;self.IEWindowHeight=document.documentElement.clientHeight;if(!$.browser.msie){config.IE6Fix_DetectScrollOnBody=false;}else{if($.browser.version>7){config.IE6Fix_DetectScrollOnBody=false;}}
var scrollElement=config.IE6Fix_DetectScrollOnBody?$('body'):$('div.fixedLeftWrapper').add(window);scrollElement.scroll(function(){if(self.floatBoxVisible){if(!showHeader(self,self.floatBox)){var offset=self.offset();self.floatBox.css('position','absolute');self.floatBox.css('top',offset.top);self.floatBox.css('left',offset.left);self.floatBoxVisible=false;if(config.cbFadeOut){config.cbFadeOut(self.floatBox);}else{self.floatBox.stop(true,true);self.floatBox.fadeOut(config.fadeOut);}}}else if(showHeader(self,self.floatBox)){if(table.children().length===0){createFloater(table,self,config);}
self.floatBoxVisible=true;if($.browser.msie&&$.browser.version<7){self.floatBox.css('position','absolute');}else{self.floatBox.css('position','fixed');}
if(config.cbFadeIn){config.cbFadeIn(self.floatBox);}else{self.floatBox.stop(true,true);self.floatBox.fadeIn(config.fadeIn);}}
if(self.floatBoxVisible){if($.browser.msie&&$.browser.version<=7){self.floatBox.css('top',$(window).scrollTop());}else{self.floatBox.css('top',0);}
self.floatBox.css('left',self.offset().left-$(window).scrollLeft());if(config.recalculate){recalculateColumnWidth(table,self,config);}}});if($.browser.msie&&$.browser.version<=7){$(window).resize(function(){if((self.IEWindowWidth!=document.documentElement.clientWidth)||(self.IEWindowHeight!=document.documentElement.clientHeight)){self.IEWindowWidth=document.documentElement.clientWidth;self.IEWindowHeight=document.documentElement.clientHeight;if(table.children().length>0){table.fastempty();createFloater(table,self,config);}}});}else{$(window).resize(function(){if(table.children().length>0){table.fastempty();createFloater(table,self,config);}});};$(self).after(self.floatBox);this.fhRecalculate=function(){recalculateColumnWidth(table,self,config);};this.fhInit=function(){if(table.children().length>0){table.fastempty();createFloater(table,self,config);}};$.fn.fastempty=function(){if(this[0]){while(this[0].hasChildNodes()){this[0].removeChild(this[0].lastChild);}}
return this;};});};function createFloater(target,template,config){target.width(template.width());var items;if(!config.forceClass&&template.children('thead').length>0){items=template.children('thead').eq(0).children();var thead=jQuery("<thead/>");target.append(thead);target=thead;}else{items=template.find('.'+config.markerClass);}
items.each(function(){var row=$(this);var rowClone=row[0].cloneNode(false);var floatRow=$(rowClone);row.children().each(function(){var cell=$(this);var floatCell=cell.clone();floatCell.width(cell.width());floatRow.append(floatCell);});target.append(floatRow);});}
function recalculateColumnWidth(target,template,config){target.width(template.width());var src;var dst;if(!config.forceClass&&template.children('thead').length>0){src=template.children('thead').eq(0).children().eq(0);dst=target.children('thead').eq(0).children().eq(0);}else{src=template.find('.'+config.markerClass).eq(0);dst=target.children().eq(0);}
dst=dst.children().eq(0);src.children().each(function(index,element){dst.width($(element).width());dst=dst.next();});}
function showHeader(element,floater){var elem=$(element);var top=$(window).scrollTop();var y0=elem.offset().top;var height=elem.height()-floater.height();var foot=elem.children('tfoot');if(foot.length>0){height-=foot.height();}
return y0<=top&&top<=y0+height;}})(jQuery);}
(function(){var $=jQuery;var _=xataface.lang.get;$(document).ready(function(){$('#dataface-sections-left-column').each(function(){var txt=$(this).text().replace(/^\W+/,'').replace(/\W+$/);if(!txt&&$('img',this).length==0)$(this).hide();});$('#left_column').each(function(){var txt=$(this).text().replace(/^\W+/,'').replace(/\W+$/);if(!txt&&$('img',this).length==0)$(this).hide();});var resultListTable=$('#result_list').get(0);if(resultListTable){$(resultListTable).floatHeader({recalculate:true});var rowPermissions={};$('input.rowSelectorCheckbox[data-xf-permissions]',resultListTable).each(function(){var perms=$(this).attr('data-xf-permissions').split(',');$.each(perms,function(){rowPermissions[this]=1;});});$('.result-list-actions li.selected-action').each(function(){var perm=$(this).children('a').attr('data-xf-permission');if(perm&&!rowPermissions[perm]){$(this).hide();}});}
$('table.listing > tbody > tr > td span[data-fulltext]').each(function(){var span=this;if($(span).hasClass('short-text')){return;}
$(span).addClass('short-text');var moreDiv=null;var td=$(this).parent();while($(td).prop('tagName').toLowerCase()!='td'){td=$(td).parent();}
td=$(td).get(0);$(td).css({});var moreButton=$('<a>').addClass('listing-show-more-button').attr('href','#').html('...').click(showMore).get(0);var lessButton=$('<a href="#" class="listing-show-less-button">...</a>').click(showLess).get(0);function showMore(){var width=$(td).width();if(moreDiv==null){var divContent=null;var parentA=$(span).parent('a');if(parentA.size()>0){divContent=parentA.clone();$('span',divContent).removeClass('short-text').removeAttr('data-fulltext').text($(span).attr('data-fulltext'));}else{divContent=$(span).clone();divContent.removeClass('short-text').text($(span).attr('data-fulltext'));}
var divWidth=width-$(moreButton).width()-10;moreDiv=$('<div style="white-space:normal;"></div>').css('width',divWidth).append(divContent).addClass('full-text').get(0);$(td).prepend(moreDiv);}
$(td).addClass('expanded');return false;}
function showLess(){$(td).removeClass('expanded');return false;}
$(td).append(moreButton);$(td).append(lessButton);});$('table.listing td.row-actions-cell').each(function(){var reqWidth=0;$('.row-actions a',this).each(function(){reqWidth+=$(this).outerWidth(true);});$(this).width(reqWidth);$(this).css({padding:0,margin:0,'padding-right':'5px','padding-top':'3px'});});$(".xf-dropdown a.trigger").each(function(){var atag=this;$(this).parent().find('ul li.selected > a').each(function(){$(atag).append(': '+$(this).text());$(atag).parent().addClass('selected');});}).append('<span class="arrow"></span>').click(function(){var atag=this;if($(this).hasClass('menu-visible')){$(this).removeClass('menu-visible');$(this).parent().find(">ul").slideUp('slow');$('body').unbind('click.xf-dropdown');}else{$(this).addClass('menu-visible');$(this).parent().find(">ul").each(function(){if($(atag).hasClass('horizontal-trigger')){var pos=$(atag).position();$(this).css('top',0).css('left',20);}
$(this).css('z-index',10000);}).slideDown('fast',function(){$('body, .xf-dropdown a.trigger').bind('click.xf-dropdown',function(){$('body, .xf-dropdown a.trigger').unbind('click.xf-dropdown');if(this===atag){return;}
if($(atag).hasClass('menu-visible')){$(atag).trigger('click');}});}).show();}
return false;}).hover(function(){$(this).addClass("subhover");},function(){$(this).removeClass("subhover");});var hasResultListCheckboxes=XataJax.actions.hasRecordSelectors($('.resultList'));var hasRelatedListCheckboxes=XataJax.actions.hasRecordSelectors($('.relatedList'));$('.selected-action a').each(function(){if(!hasResultListCheckboxes){$(this).parent().hide();}}).click(function(){try{XataJax.actions.handleSelectedAction(this,'.resultList');}catch(e){console.log(e);}
return false;});$('.selected-or-full-set-action a').click(function(){try{var emptyMessage="No rows currently selected.  Would you like to perform this action on the full found set?";var emptyMessageAtt=$(this).parents('.selected-or-full-set-action').attr('data-xf-use-full-set-if-empty')
if(emptyMessageAtt){emptyMessage=emptyMessageAtt;}
$(this).attr('data-xf-use-full-set-if-empty',emptyMessage);XataJax.actions.handleSelectedAction(this,'.resultList');}catch(e){console.log(e);}
return false;});$('.full-set-action a').click(function(){try{var warningMessage="This action will operate on the full found set.  Do you wish to continue?";var warningMessageAtt=$(this).parents('.full-set-action').attr('data-xf-full-set-warning')
if(warningMessageAtt){warningMessage=warningMessageAtt;}
if(confirm(warningMessage)){return true;}}catch(e){console.log(e);}
return false;});$('.related-selected-action a').each(function(){if(!hasRelatedListCheckboxes){$(this).parent().hide();}}).click(function(){XataJax.actions.handleSelectedAction(this,'.relatedList');return false;});$('.xf-button-bar').each(function(){var bar=this;var container=$(bar).parent();var containerOffset=$(container).offset();if(containerOffset==null)containerOffset={left:0,top:0};var parentWidth=$(container).width();var rightBound=containerOffset.left+parentWidth;var windowWidth=$(window).width();var pos=$(this).offset();var left=pos.left;var screenWidth=$(window).width();var outerWidth=$(this).outerWidth();var excess=outerWidth+pos.left-screenWidth;if(excess>0){var oldWidth=$(this).width();$(this).width(oldWidth-excess);var newWidth=oldWidth-excess;}
$(window).scroll(function(){var container=$(bar).parent();var containerOffset=$(container).offset();if(containerOffset==null)containerOffset={left:0,top:0};var leftMost=containerOffset.left;var rightMost=leftMost+$(container).innerWidth();var currMarginLeft=$(bar).css('margin-left');var scrollLeft=$(window).scrollLeft();if(scrollLeft<left){$(bar).css('margin-left',-30);$(bar).width(Math.min(newWidth+scrollLeft,$(container).innerWidth()-10));}else if(scrollLeft<excess+60){$(bar).css('margin-left',scrollLeft-left-30);}});});$('.list-view-menu').each(function(){var self=this;if($('.action-sub-menu',this).children().size()<2){$(self).hide();}});$('form h3.Dataface_collapsible_sidebar').each(function(){var siblings=$(this).parent().parent().find('>div.xf-form-group-wrapper >h3.Dataface_collapsible_sidebar:visible');if(siblings.size()<=1)$(this).hide();});$('.xf-save-new-related-record a').click(function(){$('form input[name="-Save"]').click();return false;});$('.xf-save-new-record a').click(function(){$('form input[name="--session:save"]').click();return false;});$('.result-stats').each(function(){if($(this).hasClass('details-stats'))return;var resultStats=this;var isRelated=$(resultStats).hasClass('related-result-stats');var start=$('span.start',this).text().replace(/^\W+/,'').replace(/\W+$/);var end=$('span.end',this).text().replace(/^\W+/,'').replace(/\W+$/);var found=$('span.found',this).text().replace(/^\W+/,'').replace(/\W+$/);var limit=$('.limit-field input').val();start=parseInt(start)-1;end=parseInt(end);found=parseInt(found);limit=parseInt(limit);$(this).css('cursor','pointer');$(this).click(function(){var div=$('<div>').addClass('xf-change-limit-dialog');var label=$('<p>Show <input class="limitter" type="text" value="'+(limit)+'" size="2"/> per page starting at <input type="text" value="'+start+'" class="starter" size="2"/> </p>');$('input.limitter',label).change(function(){var query=XataJax.util.getRequestParams();var limitParam='-limit';if(isRelated){limitParam='-related:limit';}
query[limitParam]=$(this).val();window.location.href=XataJax.util.url(query);}).css({'font-size':'12px'});$('input.starter',label).change(function(){var query=XataJax.util.getRequestParams();var skipParam='-skip';if(isRelated){skipParam='-related:skip';}
query[skipParam]=$(this).val();window.location.href=XataJax.util.url(query);}).css({'font-size':'12px'});div.append(label);var offset=$(resultStats).offset();$('body').append(div);$(div).css({position:'absolute',top:offset.top+$(resultStats).height(),left:Math.min(offset.left,$(window).width()-275),'background-color':'#bbccff','z-index':1000,'padding':'2px 5px 2px 10px','border-radius':'5px'});$(div).show();$(div).click(function(e){e.preventDefault();e.stopPropagation();});function onBodyClick(){$(div).remove();$('body').unbind('click',onBodyClick);}
setTimeout(function(){$('body').bind('click',onBodyClick);},1000);});});$('.details-stats').each(function(){var resultStats=this;var cursor=$('span.cursor',this).text();var found=$('span.found',this).text();cursor=parseInt(cursor);found=parseInt(found);$(this).click(function(){var div=$('<div>').addClass('xf-change-limit-dialog');var label=$('<p>Show <input class="limitter" type="text" value="'+(cursor)+'" size="2"/> of '+found+' </p>');$('input.limitter',label).change(function(){var query=XataJax.util.getRequestParams();query['-cursor']=parseInt($(this).val())-1;window.location.href=XataJax.util.url(query);}).css({'font-size':'12px'});div.append(label);var offset=$(resultStats).offset();$('body').append(div);$(div).css({position:'absolute !important',top:offset.top+$(resultStats).height(),left:Math.min(offset.left,$(window).width()-150),'background-color':'#bbccff','z-index':1000,'padding':'2px 5px 2px 10px','border-radius':'5px'});$(div).show();$(div).click(function(e){e.preventDefault();e.stopPropagation();});function onBodyClick(){$(div).remove();$('body').unbind('click',onBodyClick);}
setTimeout(function(){$('body').bind('click',onBodyClick);},1000);}).css('cursor','pointer');});(function(){var searchField=$('.xf-search-field').parents('form').submit(function(){$(this).find(':input[value=""]').each(function(){if($(this).val()===''){$(this).attr('disabled',true);}});});})();(function(){if(typeof(sessionStorage)=='undefined'){sessionStorage={};}
function parseString(str){var parts=str.split('&');var out=[];$.each(parts,function(){var kv=this.split('=');out[decodeURIComponent(kv[0])]=decodeURIComponent(kv[1]);});return out;}
var currTable=$('meta#xf-meta-tablename').attr('content');if(currTable){var currSearch=$('meta#xf-meta-search-query').attr('content');var currSearchUrl=window.location.href;var searchSelected=false;if(!currSearch){currSearch=sessionStorage['xf-currSearch-'+currTable+'-params'];currSearchUrl=sessionStorage['xf-currSearch-'+currTable+'-url'];}else{searchSelected=true;sessionStorage['xf-currSearch-'+currTable+'-params']=currSearch;sessionStorage['xf-currSearch-'+currTable+'-url']=currSearchUrl;}
if(currSearch){var item=$('<li>');if(searchSelected)item.addClass('selected');var a=$('<a>').attr('href',currSearchUrl).attr('title',_('themes.g2.VIEW_SEARCH_RESULTS','View Search results')).text(_('themes.g2.SEARCH_RESULTS','Search Results'));item.append(a);$('.tableQuicklinks').append(item);}
var currRecord=$('meta#xf-meta-record-title').attr('content');var currRecordUrl=window.location.href;var recordSelected=false;if(!currRecord){currRecord=sessionStorage['xf-currRecord-'+currTable+'-title'];currRecordUrl=sessionStorage['xf-currRecord-'+currTable+'-url'];}else{recordSelected=true;sessionStorage['xf-currRecord-'+currTable+'-title']=currRecord;sessionStorage['xf-currRecord-'+currTable+'-url']=currRecordUrl;}
var currRecordId=$('meta#xf-meta-record-id').attr('content');if(currRecordId){(function(){$('a.xf-related-record-link[data-xf-related-record-id]').click(function(){var idKey='xf-parent-of-'+$(this).attr('data-xf-related-record-id');var idUrl='xf-parent-of-url-'+$(this).attr('data-xf-related-record-id');var idTitle='xf-parent-of-title-'+$(this).attr('data-xf-related-record-id');sessionStorage[idKey]=currRecordId;sessionStorage[idUrl]=currRecordUrl;sessionStorage[idTitle]=currRecord;return true;});})();}
if(currRecord){var isChildRecord=false;if(currRecordId){(function(){var idKey='xf-parent-of-'+currRecordId;var idUrl='xf-parent-of-url-'+currRecordId;var idTitle='xf-parent-of-title-'+currRecordId;if(sessionStorage[idUrl]){var item=$('<li>');var a=$('<a>').attr('href',sessionStorage[idUrl]).attr('title',sessionStorage[idTitle]).text(sessionStorage[idTitle]);item.append(a);$('.tableQuicklinks').append(item);isChildRecord=true;}})();}
var item=$('<li>');if(recordSelected)item.addClass('selected');var a=$('<a>').attr('href',currRecordUrl).attr('title',currRecord).text(currRecord);if(isChildRecord){$(a).addClass('xf-child-record');}
item.append(a);$('.tableQuicklinks').append(item);}
var g2=XataJax.load('xataface.modules.g2');var advancedFindForm=new g2.AdvancedFind({});function handleShowAdvancedFind(){advancedFindForm.show();$(this).addClass('expanded').removeClass('collapsed');$(this).unbind('click',handleShowAdvancedFind);$(this).bind('click',handleHideAdvancedFind);};function handleHideAdvancedFind(){advancedFindForm.hide();$(this).addClass('collapsed').removeClass('expanded');$(this).unbind('click',handleHideAdvancedFind);$(this).bind('click',handleShowAdvancedFind);}
$('a.xf-show-advanced-find').bind('click',handleShowAdvancedFind);}})();});})();}
if(typeof(window.__xatajax_included__['xataface/modules/switch_user/switch_user.js'])=='undefined'){window.__xatajax_included__['xataface/modules/switch_user/switch_user.js']=true;(function(){function _(key,defaultValue){if(xataface&&xataface.strings&&xataface.strings[key]){return xataface.strings[key];}else{return defaultValue;}}
var initSwitchUser;var $=jQuery;jQuery(document).ready(function($){var userbar=document.createElement('div');$(userbar).attr('id','switch-user-menu');$(userbar).html(_('switch_user.label.logged_in_as','Logged in as <span id="switch-user-username">&nbsp;</span>.')+' <a href="#" id="switch-user-btn" title="'+
_('switch_user.label.switch_user','Switch User')+'"><span>'+
_('switch_user.label.switch_user','Switch User')+'</span></a>');var usernameSpan=$('#switch-user-username',userbar).get(0);var switchUserBtn=$('#switch-user-btn',userbar).get(0);var isOriginalUser=true;function restoreToOriginalUser(){$.post(DATAFACE_SITE_HREF,{'-action':'switch_user','--restore':1},function(response){try{if(typeof(response)=='string'){eval('response='+response+';');}
if(response.code==200){$(usernameSpan).html(response.username);window.location.reload();}else{throw response.msg;}}catch(e){alert(e);}});}
function switchUser(username){$.post(DATAFACE_SITE_HREF,{'-action':'switch_user','--username':username},function(response){try{if(typeof(response)=='string'){eval('response='+response+';');}
if(response.code==200){$(usernameSpan).html(response.username);window.location.reload();}else{throw response.msg;}}catch(e){alert(e);}});}
initSwitchUser=function(username,isOriginal){$(usernameSpan).html(username);$('body').append(userbar);isOriginalUser=isOriginal;if(!isOriginalUser){$(userbar).addClass('non-original-user');}}
$(switchUserBtn).click(function(){if(isOriginalUser){var user=prompt(_('switch_user.message.enter_username','Please enter the name of the user you wish to switch to.'),_('switch_user.label.username','Username'));if(user){switchUser(user);}}else{if(confirm(_('switch_user.message.are_you_sure','Are you sure you want to exit this user account and return to your own account?'))){restoreToOriginalUser();}}
return false;});$.get(DATAFACE_SITE_HREF,{'-action':'switch_user_status'},function(response){try{if(response.username){initSwitchUser(response.username,response.isOriginal);}}catch(e){}});});})();}
if(typeof(window.__xatajax_included__['master_detail.js'])=='undefined'){window.__xatajax_included__['master_detail.js']=true;if(typeof(window.__xatajax_included__['split.min.js'])=='undefined'){window.__xatajax_included__['split.min.js']=true;"use strict";(function(){var e=this,t="addEventListener",i="removeEventListener",s="getBoundingClientRect",n=e.attachEvent&&!e[t],r=e.document,o=function(){var e,t=["","-webkit-","-moz-","-o-"];for(var i=0;i<t.length;i++){e=r.createElement("div");e.style.cssText="width:"+t[i]+"calc(9px)";if(e.style.length){return t[i]+"calc"}}}(),a=function(e){if(typeof e==="string"||e instanceof String){return r.querySelector(e)}else{return e}},l=function(l,u){var c,f,p,g,h,d,z,S,y=[];u=typeof u!=="undefined"?u:{};if(typeof u.gutterSize==="undefined")u.gutterSize=10;if(typeof u.minSize==="undefined")u.minSize=100;if(typeof u.snapOffset==="undefined")u.snapOffset=30;if(typeof u.direction==="undefined")u.direction="horizontal";if(u.direction=="horizontal"){c="width";p="clientWidth";g="clientX";h="left";d="gutter gutter-horizontal";z="paddingLeft";S="paddingRight";if(!u.cursor)u.cursor="ew-resize"}else if(u.direction=="vertical"){c="height";p="clientHeight";g="clientY";h="top";d="gutter gutter-vertical";z="paddingTop";S="paddingBottom";if(!u.cursor)u.cursor="ns-resize"}var v=function(i){var s=this,n=s.a,r=s.b;if(!s.dragging&&u.onDragStart){u.onDragStart()}i.preventDefault();s.dragging=true;s.move=b.bind(s);s.stop=m.bind(s);e[t]("mouseup",s.stop);e[t]("touchend",s.stop);e[t]("touchcancel",s.stop);s.parent[t]("mousemove",s.move);s.parent[t]("touchmove",s.move);n[t]("selectstart",U);n[t]("dragstart",U);r[t]("selectstart",U);r[t]("dragstart",U);n.style.userSelect="none";n.style.webkitUserSelect="none";n.style.MozUserSelect="none";n.style.pointerEvents="none";r.style.userSelect="none";r.style.webkitUserSelect="none";r.style.MozUserSelect="none";r.style.pointerEvents="none";s.gutter.style.cursor=u.cursor;s.parent.style.cursor=u.cursor;M.call(s)},m=function(){var t=this,s=t.a,n=t.b;if(t.dragging&&u.onDragEnd){u.onDragEnd()}t.dragging=false;e[i]("mouseup",t.stop);e[i]("touchend",t.stop);e[i]("touchcancel",t.stop);t.parent[i]("mousemove",t.move);t.parent[i]("touchmove",t.move);delete t.stop;delete t.move;s[i]("selectstart",U);s[i]("dragstart",U);n[i]("selectstart",U);n[i]("dragstart",U);s.style.userSelect="";s.style.webkitUserSelect="";s.style.MozUserSelect="";s.style.pointerEvents="";n.style.userSelect="";n.style.webkitUserSelect="";n.style.MozUserSelect="";n.style.pointerEvents="";t.gutter.style.cursor="";t.parent.style.cursor=""},b=function(e){var t;if(!this.dragging)return;if("touches"in e){t=e.touches[0][g]-this.start}else{t=e[g]-this.start}if(t<=this.aMin+u.snapOffset){t=this.aMin}else if(t>=this.size-this.bMin-u.snapOffset){t=this.size-this.bMin}x.call(this,t);if(u.onDrag){u.onDrag()}},M=function(){var t=e.getComputedStyle(this.parent),i=this.parent[p]-parseFloat(t[z])-parseFloat(t[S]);this.size=this.a[s]()[c]+this.b[s]()[c]+this.aGutterSize+this.bGutterSize;this.percentage=Math.min(this.size/i*100,100);this.start=this.a[s]()[h]},x=function(e){this.a.style[c]=o+"("+e/this.size*this.percentage+"% - "+this.aGutterSize+"px)";this.b.style[c]=o+"("+(this.percentage-e/this.size*this.percentage)+"% - "+this.bGutterSize+"px)"},G=function(){var e=this,t=e.a,i=e.b;if(t[s]()[c]<e.aMin){t.style[c]=e.aMin-e.aGutterSize+"px";i.style[c]=e.size-e.aMin-e.aGutterSize+"px"}else if(i[s]()[c]<e.bMin){t.style[c]=e.size-e.bMin-e.bGutterSize+"px";i.style[c]=e.bMin-e.bGutterSize+"px"}},w=function(){var e=this,t=e.a,i=e.b;if(i[s]()[c]<e.bMin){t.style[c]=e.size-e.bMin-e.bGutterSize+"px";i.style[c]=e.bMin-e.bGutterSize+"px"}else if(t[s]()[c]<e.aMin){t.style[c]=e.aMin-e.aGutterSize+"px";i.style[c]=e.size-e.aMin-e.aGutterSize+"px"}},E=function(e){for(var t=0;t<e.length;t++){M.call(e[t]);G.call(e[t])}for(t=e.length-1;t>=0;t--){M.call(e[t]);w.call(e[t])}},U=function(){return false},D=a(l[0]).parentNode;if(!u.sizes){var k=100/l.length;u.sizes=[];for(f=0;f<l.length;f++){u.sizes.push(k)}}if(!Array.isArray(u.minSize)){var L=[];for(f=0;f<l.length;f++){L.push(u.minSize)}u.minSize=L}for(f=0;f<l.length;f++){var O=a(l[f]),B=f==1,F=f==l.length-1,A,C=u.gutterSize,N;if(f>0){N={a:a(l[f-1]),b:O,aMin:u.minSize[f-1],bMin:u.minSize[f],dragging:false,parent:D,isFirst:B,isLast:F,direction:u.direction};N.aGutterSize=u.gutterSize;N.bGutterSize=u.gutterSize;if(B){N.aGutterSize=u.gutterSize/2}if(F){N.bGutterSize=u.gutterSize/2}}if(!n){if(f>0){var R=r.createElement("div");R.className=d;R.style[c]=u.gutterSize+"px";R[t]("mousedown",v.bind(N));R[t]("touchstart",v.bind(N));D.insertBefore(R,O);N.gutter=R}if(f===0||f==l.length-1){C=u.gutterSize/2}if(typeof u.sizes[f]==="string"||u.sizes[f]instanceof String){A=u.sizes[f]}else{A=o+"("+u.sizes[f]+"% - "+C+"px)"}}else{if(typeof u.sizes[f]==="string"||u.sizes[f]instanceof String){A=u.sizes[f]}else{A=u.sizes[f]+"%"}}O.style[c]=A;if(f>0){y.push(N)}}E(y)};if(typeof exports!=="undefined"){if(typeof module!=="undefined"&&module.exports){exports=module.exports=l}exports.Split=l}else{e.Split=l}}).call(window);}
(function(){var $=jQuery;function replaceQueryParam(str,name,value){var parts=str.split(/&/);var out='';var found=false;for(var i=0;i<parts.length;i++){var kv=parts[i];var k=kv;var v=undefined;if(kv.indexOf('=')!==-1){kv=kv.split(/=/);k=kv[0];v=kv[1];}
if(k===name){if(value===null||found){continue;}
found=true;v=encodeURIComponent(value);}
out+=k;if(v!==undefined){out+='='+v;}
out+='&';}
if(!found&&value!==null){out+=name+'='+encodeURIComponent(value)+'&';}
if(out.length>0){return out.substring(0,out.length-1);}
return out;}
function getQueryParam(str,name){var parts=str.split(/&/);for(var i=0;i<parts.length;i++){var kv=parts[i];var k=kv;var v='';if(kv.indexOf('=')!==-1){kv=kv.split(/=/);k=kv[0];v=kv[1];}
if(k===name){return decodeURIComponent(v);}}
return'';}
$(document).ready(function(){$('#xf-master-detail').each(function(){var n=$('#xf-master-detail-n',this);var s=$('#xf-master-detail-s',this);var md=$(this);Split(['#xf-master-detail-n','#xf-master-detail-s'],{direction:'vertical',gutterSize:8,cursor:'row-resize'});if(md.length>0){var padding=md.offset().left-md.parent().offset().left;md.width(md.parent().innerWidth()-2*padding);md.height($(window).height()-md.offset().top-padding-$('.fineprint').height());var ctr=0;while($('.fineprint').offset().top+$('.fineprint').outerHeight()>$(window).innerHeight()){md.height(md.height()-2);if(ctr++>50){break;}}
var mdn=$('#xf-master-detail-n',md);var mds=$('#xf-master-detail-s',md);var detailUrl=getQueryParam(window.location.hash,'detail-url');var unsavedChanges=false;var iframeLoaded=false;function loadDetails(url){if(url.indexOf('&-ui-root=main-content')!==-1){url=url.replace(/&-ui-root=main-content/,'');}
if(iframeLoaded){$('iframe.master-detail-iframe',mds).get(0).contentWindow.location=url+'&-ui-root=main-content';return false;}
iframeLoaded=true;$(mds).empty();var iframe=$('<iframe class="master-detail-iframe" style="width:100%; height:100%; border:none; padding:0; margin:0">').attr('src',url+'&-ui-root=main-content');$(iframe).load(function(){var self=this;window.location.hash=replaceQueryParam(window.location.hash,'detail-url',this.contentWindow.location.href);var oldSelectedRow=null;$('table.listing tr.master-detail-selected td',mdn).each(function(){$(this).removeClass('master-detail-selected');$(this).parent().removeClass('master-detail-selected');oldSelectedRow=$(this).parent();});$('table.listing > tbody > tr > td > a',mdn).each(function(){var winCursor=getQueryParam(self.contentWindow.location.search,'-cursor');var linkCursor=getQueryParam($(this).attr('href'),'-cursor');if(winCursor===linkCursor){$(this).closest('td').addClass('master-detail-selected');$(this).closest('tr').addClass('master-detail-selected');}});if(this.contentWindow.location.search.indexOf('--master-detail-delete-row=1')!==-1){if(oldSelectedRow!==null){$(oldSelectedRow).each(function(){$(this).removeClass('master-detail-selected');$('td',this).removeClass('master-detail-selected');var nex=$(this).next();while(nex.length>0&&!nex.is(':visible')){nex=nex.next();}
if(nex.length===0){nex=$(this).prev();while(nex.length>0&&!nex.is(':visible')){nex=nex.prev();}}
if(nex.length===0){iframeLoaded=false;$(iframe).remove();window.location.hash=replaceQueryParam(window.location.hash,'detail-url',null);}else{nex.addClass('master-detail-selected');$('td',nex).addClass('master-detail-selected');var newUrl=null;$('a[href]',nex).each(function(){if($(this).attr('href').indexOf('-cursor=')!==-1){newUrl=$(this).attr('href');}});if(newUrl!==null){loadDetails(newUrl);}else{iframeLoaded=false;$(iframe).remove();window.location.hash=replaceQueryParam(window.location.hash,'detail-url',null);}}
$(this).hide();});}else{iframeLoaded=false;$(iframe).remove();window.location.hash=replaceQueryParam(window.location.hash,'detail-url',null);}}
unsavedChanges=false;try{$(iframe).contents().find('li.record-back').hide();$(iframe).contents().find('input[data-xf-field],select[data-xf-field],textarea[data-xf-field]').change(function(){unsavedChanges=true;});$(iframe).contents().find('form.xf-form-group').submit(function(){unsavedChanges=false;});$(this.contentWindow).on('beforeunload',function(){if(unsavedChanges){return'This form has unsaved changes.';}});}catch(e){}});$(mds).append(iframe);}
var currentDetailsUrl=getQueryParam(window.location.hash,'detail-url');if(currentDetailsUrl){loadDetails(currentDetailsUrl);}
$('table tr td a[href]',mdn).each(function(){if($(this).attr('href').indexOf('-action=')!==-1){$(this).click(function(){loadDetails($(this).attr('href'));return false;});}});}});});})();}
if(typeof(window.__xatajax_included__['tagcloud.js'])=='undefined'){window.__xatajax_included__['tagcloud.js']=true;(function(){var $=jQuery;$(document).ready(function(){$('.xf-tagcloud li').each(function(){var freq=parseInt($(this).attr('data-xf-frequency'));$(this).children().css('font-size',(freq/10<1)?(freq/10+0.5)+"em":(freq/10>2)?"2.5em":(freq/10+0.5)+"em");});});})();}
if(typeof(XataJax)!="undefined")XataJax.ready();