webpackJsonp([10,11],{314:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=a(15),s=a(5),i=a(8);t.default={metaInfo:{titleTemplate:"%s - Usuários"},data:function(){return{form:new o.Form({name:"",display_name:"",description:""}),rows:[],dialogVisible:!1,loading:!1,msg:""}},methods:{openModal:function(){this.dialogVisible=!0},newPerm:function(){var e=this;this.loading=!0,this.form.post(s.permUrl).then(function(t){e.msg="Permissão "+t.data.name+" criada com sucesso!",e.rows.push(t.data),e.refreshTable(),e.loading=!1,e.form.reset()}).catch(function(t){e.loading=!1})},refreshTable:function(){self.dtHandle.destroy(),setTimeout(function(){self.dtHandle=$("#table1").DataTable()},100)}},created:function(){var e=this;i.http.get(s.permUrl).then(function(t){console.log(t),e.rows=t.data,setTimeout(function(){self.dtHandle=$("#table1").DataTable()},100)}).catch(function(e){console.log(e)})}}},463:function(e,t,a){t=e.exports=a(2)(),t.push([e.id,"","",{version:3,sources:[],names:[],mappings:"",file:"index.vue",sourceRoot:"webpack://"}])},523:function(e,t,a){var o=a(463);"string"==typeof o&&(o=[[e.id,o,""]]);a(3)(o,{});o.locals&&(e.exports=o.locals)},541:function(e,t,a){var o,s;a(523),o=a(314);var i=a(602);s=o=o||{},"object"!=typeof o.default&&"function"!=typeof o.default||(s=o=o.default),"function"==typeof s&&(s=s.options),s.render=i.render,s.staticRenderFns=i.staticRenderFns,e.exports=o},602:function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{},[2==e.$route.matched.length?[e.dialogVisible?a("el-dialog",{attrs:{title:"Criar Permissão",size:"small","before-close":e.handleClose},model:{value:e.dialogVisible,callback:function(t){e.dialogVisible=t},expression:"dialogVisible"}},[a("div",{staticClass:"row"},[a("form",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],on:{keydown:function(t){e.form.errors.clear(t.target.name)}}},[a("alert-success",{attrs:{form:e.form,message:e.msg}}),e._v(" "),a("alert-errors",{attrs:{form:e.form,classe:"alert bg-danger alert-styled-left",message:""}}),e._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-lg-6"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:""}},[e._v("Nome")]),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.name,expression:"form.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.form.name},on:{input:function(t){t.target.composing||(e.form.name=t.target.value)}}})])]),e._v(" "),a("div",{staticClass:"col-lg-6"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:""}},[e._v("Nome de Exibição")]),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.display_name,expression:"form.display_name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.form.display_name},on:{input:function(t){t.target.composing||(e.form.display_name=t.target.value)}}})])]),e._v(" "),a("div",{staticClass:"col-lg-12"},[a("div",{staticClass:"form-group"},[a("label",{attrs:{for:""}},[e._v("Descrição")]),e._v(" "),a("textarea",{directives:[{name:"model",rawName:"v-model",value:e.form.description,expression:"form.description"}],staticClass:"form-control",attrs:{rows:"5",cols:"80"},domProps:{value:e.form.description},on:{input:function(t){t.target.composing||(e.form.description=t.target.value)}}})])])])],1)]),e._v(" "),a("span",{staticClass:"dialog-footer",slot:"footer"},[a("el-button",{on:{click:function(t){e.dialogVisible=!1}}},[e._v("Fechar")]),e._v(" "),a("el-button",{attrs:{type:"primary",loading:e.loading},on:{click:e.newPerm}},[a("b",[e._v("SALVAR")])])],1)]):e._e(),e._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-lg-12"},[a("button",{staticClass:"pull-right btn bg-blue btn-labeled heading-btn",attrs:{type:"button"},on:{click:function(t){e.dialogVisible=!0}}},[e._m(0),e._v(" Criar Permissão")])])]),e._v(" "),a("br"),e._v(" "),a("div",{staticClass:"row"},[a("datatable-slot",{directives:[{name:"loading",rawName:"v-loading.body",value:e.loading,expression:"loading",modifiers:{body:!0}}],attrs:{title:"Lista de Permssões",id:"table1",url:"http://localhost:8000/api/teste",headers:[{header:"#"},{header:"Nome"},{header:"Nome de Exibição"},{header:"Descrição"},{header:"Criado em"},{header:"Ações"}]}},e._l(e.rows,function(t,o){return a("tr",[a("td",[e._v(e._s(o+1))]),e._v(" "),a("td",[e._v(e._s(t.name))]),e._v(" "),a("td",[e._v(e._s(t.display_name))]),e._v(" "),a("td",[e._v(e._s(t.description))]),e._v(" "),a("td",[e._v(e._s(t.created_at))]),e._v(" "),a("td",{attrs:{sortable:"false"}},[a("ul",{staticClass:"icons-list"},[a("li",{staticClass:"dropdown"},[a("a",{staticClass:"dropdown-toggle",attrs:{href:"#","data-toggle":"dropdown"}},[a("i",{staticClass:"icon-menu9"})]),e._v(" "),a("ul",{staticClass:"dropdown-menu dropdown-menu-right"})])])])])}))],1)]:[a("router-view")]],2)},staticRenderFns:[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("b",[a("i",{staticClass:"icon-user-plus"})])}]}}});
//# sourceMappingURL=10.425178aa77e43ca33ee5.js.map