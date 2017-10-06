webpackJsonp([5,11],{323:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var n=e(5),o=e(7);a.default={data:function(){return{timeRequest:moment().startOf("year").format("DD/MM/YYYY")+" - "+moment().endOf("month").format("DD/MM/YYYY"),loading:!1,label:"",labels:[],data:[]}},methods:{refreshData:function(){self=this,self.loading=!0,setTimeout(function(){self.fetchData()},1e3)},fetchData:function(){var t=this;o.http.get(n.boletosSolicitados,{params:{data:this.timeRequest}}).then(function(a){t.labels=[],t.data=[];for(var e=0;e<a.data.length;e++)t.labels.push(a.data[e].month_name),t.data.push(a.data[e].amount),t.label="Boletos Solicitados",t.loading=!1}).catch(function(a){t.loading=!1,console.log(a)})}},mounted:function(){var t=this;$(".daterange").daterangepicker({locale:{format:"DD/MM/YYYY",separator:" - ",applyLabel:"Aplicar",cancelLabel:"Cancelar",fromLabel:"De",toLabel:"Para",customRangeLabel:"Customizado"},ranges:{Hoje:[moment(),moment()],Ontem:[moment().subtract(1,"days"),moment().subtract(1,"days")],"Últimos 7 Dias":[moment().subtract(6,"days"),moment()],"Últimos 30 Dias":[moment().subtract(29,"days"),moment()],"Esse Mês":[moment().startOf("month"),moment().endOf("month")],"Último Mês":[moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]}}).on("input change",function(a){t.timeRequest=a.target.value}),t.loading=!0,setTimeout(function(){t.fetchData()},1e3)}}},337:function(t,a,e){"use strict";function n(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(a,"__esModule",{value:!0});var o=e(556),i=n(o);a.default={metaInfo:{titleTemplate:"%s - Dashboard"},components:{GraphBoletoSolicitado:i.default},mounted:function(){},methods:{},created:function(){$("body").removeClass("login-container"),this.$nextTick(function(){$.getScript("/static/assets/js/core/app.js")})}}},450:function(t,a,e){a=t.exports=e(2)(),a.push([t.id,".pagination{margin:0;float:right}.pagination a.page,.pagination a.page.active{border:1px solid #d3d3d3;border-radius:3px;padding:5px 10px;margin-right:2px}.pagination a.page.active{color:#fff;background-color:#337ab7}.pagination a.btn-nav,.pagination a.btn-nav.disabled{border:1px solid #d3d3d3;border-radius:3px;padding:5px 7px;margin-right:2px}.pagination a.btn-nav.disabled{color:#d3d3d3;cursor:not-allowed}.pagination-info{float:left}","",{version:3,sources:["/./src/Modulos/dashboard.vue"],names:[],mappings:"AACA,YAAY,SAAS,WAAW,CAC/B,AAGD,6CAFmB,yBAA2B,kBAAkB,iBAAiB,gBAAgB,CAGhG,AADD,0BAA0B,WAAY,wBAAyB,CAC9D,AAGD,qDAFsB,yBAA2B,kBAAkB,gBAAgB,gBAAgB,CAGlG,AADD,+BAA+B,cAAgB,AAA8E,kBAAkB,CAC9I,AACD,iBAAiB,UAAU,CAC1B",file:"dashboard.vue",sourcesContent:["\n.pagination{margin:0;float:right\n}\n.pagination a.page{border:1px solid lightgray;border-radius:3px;padding:5px 10px;margin-right:2px\n}\n.pagination a.page.active{color:white;background-color:#337ab7;border:1px solid lightgray;border-radius:3px;padding:5px 10px;margin-right:2px\n}\n.pagination a.btn-nav{border:1px solid lightgray;border-radius:3px;padding:5px 7px;margin-right:2px\n}\n.pagination a.btn-nav.disabled{color:lightgray;border:1px solid lightgray;border-radius:3px;padding:5px 7px;margin-right:2px;cursor:not-allowed\n}\n.pagination-info{float:left\n}\n"],sourceRoot:"webpack://"}])},452:function(t,a,e){a=t.exports=e(2)(),a.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"BoletoSolicitado.vue",sourceRoot:"webpack://"}])},504:function(t,a,e){var n=e(450);"string"==typeof n&&(n=[[t.id,n,""]]);e(3)(n,{});n.locals&&(t.exports=n.locals)},506:function(t,a,e){var n=e(452);"string"==typeof n&&(n=[[t.id,n,""]]);e(3)(n,{});n.locals&&(t.exports=n.locals)},556:function(t,a,e){var n,o;e(506),n=e(323);var i=e(590);o=n=n||{},"object"!=typeof n.default&&"function"!=typeof n.default||(o=n=n.default),"function"==typeof o&&(o=o.options),o.render=i.render,o.staticRenderFns=i.staticRenderFns,t.exports=n},570:function(t,a,e){var n,o;e(504),n=e(337);var i=e(588);o=n=n||{},"object"!=typeof n.default&&"function"!=typeof n.default||(o=n=n.default),"function"==typeof o&&(o=o.options),o.render=i.render,o.staticRenderFns=i.staticRenderFns,t.exports=n},588:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",["/home"==t.$route.path?e("div",{staticClass:"row"},[e("div",{staticClass:"col-lg-12"},[e("graph-boleto-solicitado")],1)]):t._e(),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-lg-12"},[e("router-view")],1)])])},staticRenderFns:[]}},590:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{},[e("div",{directives:[{name:"loading",rawName:"v-loading.body",value:t.loading,expression:"loading",modifiers:{body:!0}}],staticClass:"panel panel-flat"},[e("div",{staticClass:"panel-heading"},[e("div",{staticClass:"row"},[t._m(0),t._v(" "),e("div",{staticClass:"pull-right"},[e("div",{staticClass:"form-group"},[e("div",{staticClass:"input-group"},[t._m(1),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.timeRequest,expression:"timeRequest"}],staticClass:"form-control daterange",attrs:{type:"text"},domProps:{value:t.timeRequest},on:{input:function(a){a.target.composing||(t.timeRequest=a.target.value)}}}),t._v(" "),e("span",{staticClass:"input-group-btn"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:t.refreshData}},[t._v("Atualizar")])])])])])])]),t._v(" "),e("div",{staticClass:"panel-body"},[e("chartjs-line",{attrs:{responsive:!0,height:50,fill:!1,datalabel:"Boletos Solicitados",labels:t.labels,data:t.data,bind:!0}})],1)])])},staticRenderFns:[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("h6",{staticClass:"panel-title col-lg-6"},[e("i",{staticClass:"icon-graph"}),t._v(" Gráfico - Boletos Solicitados / Mês")])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("span",{staticClass:"input-group-addon"},[e("i",{staticClass:"icon-calendar22"})])}]}}});
//# sourceMappingURL=5.090e967d12d823328466.js.map