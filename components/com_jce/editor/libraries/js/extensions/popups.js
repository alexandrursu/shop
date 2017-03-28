/* JCE Editor - 2.3.2.3 | 11 March 2013 | http://www.joomlacontenteditor.net | Copyright (C) 2006 - 2013 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
var WFPopups=WFExtensions.add('Popups',{popups:{},popup:'',config:{},addPopup:function(n,o){this.popups[n]=o;WFExtensions.addExtension('popups',n,o);},getPopups:function(){return this.popups;},setup:function(){var self=this,ed=tinyMCEPopup.editor,s=ed.selection,n;$('#popup_list').change(function(){self.selectPopup(this.value);}).change();if(!s.isCollapsed()){n=s.getNode();var state=true,v;function setText(state,v){if(state&&v){$('#popup_text').val(v);$('#popup_text').attr('disabled',false);}else{$('#popup_text').val(tinyMCEPopup.getLang('dlg.element_selection','Element Selection'));$('#popup_text').attr('disabled',true);$('#popup_text').addClass('disabled');}}
v=s.getContent({format:'text'});if(n){var children=tinymce.grep(n.childNodes,function(node){return ed.dom.is(node,'br[data-mce-bogus]')==false;});state=children.length==1&&children[0].nodeType==3;}
setText(state,v);}
$.each(this.popups,function(k,v){self._call('setup','',v);});},isPopup:function(n,v){return n&&n.nodeName=='A'&&this._call('check',n,v);},getPopup:function(n,index){var self=this,ed=tinyMCEPopup.editor,popup,popups=this.getPopups();if(n.nodeName!='A'){n=ed.dom.getParent(n,'a');}
$.each(this.popups,function(k,v){if(self.isPopup(n,k)){self.popup=k;}});if(this.popup){this.selectPopup(this.popup);return this.getAttributes(n,index);}
return'';},setPopup:function(s){this.popup=s;},setConfig:function(config){$.extend(this.config,config);},setParams:function(n,p){var popup=this.popups[n];if(popup){if(typeof popup.params=='undefined'){popup.params={};}
$.extend(popup.params,p);}},getParams:function(n){return this.popups[n].params||{};},getParam:function(n,p){var params=this.getParams(n);return params[p]||null;},selectPopup:function(v){var self=this;self.popup=v;$('option','#popup_list').each(function(){if(this.value){$('#popup_extension_'+this.value).hide();if(v==this.value||$(this).is(':selected')){this.selected=true;$('#popup_extension_'+this.value).show();self._call('onSelect',[],this.value);}}});},setAttributes:function(n,args,index){var ed=tinyMCEPopup.editor;if(this.config['map']){$.each(this.config['map'],function(to,from){var v=args[from]||$('#'+from).val();ed.dom.setAttrib(n,to,v);delete args[from];});}
return this._call('setAttributes',[n,args,index]);},getAttributes:function(n,index){var ed=tinyMCEPopup.editor,k,v,at,data;if(n.nodeName!='A'){n=ed.dom.getParent(n,'a');}
if(this.isPopup(n)){data=this._call('getAttributes',[n,index]);}
return data;},isEnabled:function(){return this.popup;},createPopup:function(n,args,index){var self=this,ed=tinyMCEPopup.editor,o,el;args=args||{};if(this.isEnabled()){if(n&&(n.nodeName=='A'||ed.dom.getParent(n,'A'))){if(n.nodeName!='A'){n=ed.dom.getParent(n,'A');}
this.removePopups(n);this.setAttributes(n,args,index);}else{var se=ed.selection,marker;if(se.isCollapsed()){ed.execCommand('mceInsertContent',false,'<a href="#mce_temp_url#">'+$('#popup_text').val()+'</a>',{skip_undo:1});}else{ed.execCommand('mceInsertLink',false,'#mce_temp_url#',{skip_undo:1});}
tinymce.each(ed.dom.select('a[href="#mce_temp_url#"]'),function(link){self.setAttributes(link,args,index);});}}else{var s=false;$.each(this.popups,function(k,v){if(self.isPopup(n,v)){s=true;}});if(s){ed.dom.remove(n,true);}}},removePopups:function(n){var self=this;$.each(this.popups,function(k,v){self._call('remove',n,v);});},onSelectFile:function(args){this._call('onSelectFile',args);},_call:function(fn,args,popup){if(!popup){popup=this.popup;}
if(typeof popup=='string'){popup=this.popups[popup]||{};}
fn=popup[fn];if(fn){if(typeof args=='object'&&args instanceof Array){return fn.apply(popup,args);}else{return fn.call(popup,args);}}
return false;}});