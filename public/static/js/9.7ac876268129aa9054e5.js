webpackJsonp([9,11],{317:function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={metaInfo:{titleTemplate:"%s - Analytics Boleto"},data:function(){return{CLIENT_ID:"1064016171890-33ska3ge53e03ikk4na1rjg6hqio6fbq.apps.googleusercontent.com",SCOPES:["https://www.googleapis.com/auth/analytics.readonly"],access_token:"",loading:!1}},methods:{authorize:function(e){self=this,gapi.analytics.auth.authorize({container:"embed-api-auth-container",clientid:self.CLIENT_ID});var t=new gapi.analytics.ViewSelector({container:"view-selector-container"});t.execute();var n=new gapi.analytics.googleCharts.DataChart({query:{metrics:"ga:sessions",dimensions:"ga:date","start-date":"30daysAgo","end-date":"today"},chart:{container:"chart-container",type:"LINE",options:{width:"100%"}}});t.on("change",function(e){n.set({query:{ids:e}}).execute()})},querySessions:function(){this.$http.get("https://www.googleapis.com/analytics/v3/data/realtime?access_token="+this.access_token).then(function(e){})}},mounted:function(){this.authorize()}}},442:function(e,t,n){t=e.exports=n(2)(),t.push([e.id,"","",{version:3,sources:[],names:[],mappings:"",file:"boletos.vue",sourceRoot:"webpack://"}])},496:function(e,t,n){var a=n(442);"string"==typeof a&&(a=[[e.id,a,""]]);n(3)(a,{});a.locals&&(e.exports=a.locals)},550:function(e,t,n){var a,s;n(496),a=n(317);var i=n(579);s=a=a||{},"object"!=typeof a.default&&"function"!=typeof a.default||(s=a=a.default),"function"==typeof s&&(s=s.options),s.render=i.render,s.staticRenderFns=i.staticRenderFns,e.exports=a},579:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement;e._self._c||t;return e._m(0)},staticRenderFns:[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"panel panel-default"},[n("div",{staticClass:"panel-heading"},[e._v("\n    Analytics Boletos\n  ")]),e._v(" "),n("div",{staticClass:"panel-body"},[n("div",{attrs:{id:"embed-api-auth-container"}}),e._v(" "),n("h1",[e._v("Gráfico de Sessões")]),e._v(" "),n("div",{attrs:{id:"chart-container"}}),e._v(" "),n("div",{attrs:{id:"view-selector-container"}})])])}]}}});
//# sourceMappingURL=9.7ac876268129aa9054e5.js.map