webpackJsonp([1,11],{330:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var o=a(15),s=a(5),r=a(7);e.default={name:"create",metaInfo:{titleTemplate:"%s - Novo Usuário"},data:function(){return{msg:"",loading:!1,options:[],form:new o.Form({name:"",email:"",password:"",password_confirmation:"",roles:[]})}},created:function(){var t=this,e=[];console.log(e),r.http.get(s.roleUrl).then(function(a){for(var o=0;o<a.data.length;o++)console.log(a.data[o]),e.push({value:a.data[o].id,label:a.data[o].display_name});t.options=e})},methods:{clearForm:function(){this.form.name="",this.form.email="",this.form.password="",this.form.password_confirmation=""},newUser:function(){var t=this;this.loading=!0;this.form.post(s.userURL).then(function(e){t.msg="Usuário "+e.data.name+" criado com sucesso!",t.loading=!1,t.clearForm()}).catch(function(e){t.loading=!1})}}}},331:function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={}},332:function(t,e,a){"use strict";function o(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(e,"__esModule",{value:!0});var s=a(5),r=a(7),i=a(12),n=o(i);e.default={metaInfo:{titleTemplate:"%s - Usuários"},data:function(){return{rows:[]}},watch:{$route:"fetchData"},created:function(){this.fetchData(),setTimeout(function(){self.dtHandle=$("#table1").DataTable()},100)},methods:{fetchData:function(){var t=this;r.http.get(s.userURL).then(function(e){console.log(e),t.rows=e.data,t.refreshTable()}).catch(function(t){console.log(t)})},pluckRoles:function(t){return n.default.map(t,"display_name").join(", ")},date:function(t){return moment(t).format("DD/MM/YYYY HH:mm:ss")},askInactive:function(t){var e=this,a=this.rows[t];swal({title:"Deseja inativar o usuário "+a.name+" ?",text:"",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",cancelButtonText:"Cancelar",confirmButtonText:"Sim, inativar!",closeOnConfirm:!1},function(){return e.disabledUser(t)})},askActive:function(t){var e=this,a=this.rows[t];swal({title:"Deseja ativar o usuário "+a.name+" ?",text:"",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",cancelButtonText:"Cancelar",confirmButtonText:"Sim, ativar!",closeOnConfirm:!1},function(){return e.enableUser(t)})},disabledUser:function(t){var e=this,a=this.rows[t];r.http.delete(s.userURL+"/"+a.id).then(function(o){e.rows[t]=o.data,swal("Usuário "+a.name+" inativado!","","success"),e.fetchData()})},enableUser:function(t){var e=this,a=this.rows[t];r.http.put(s.userURL+"/"+a.id,{enabled:1}).then(function(o){e.rows[t]=o.data.user,swal("Usuário "+a.name+" ativado!","","success"),e.fetchData()})},refreshTable:function(){self.dtHandle.destroy(),setTimeout(function(){self.dtHandle=$("#table1").DataTable()},100)}}}},333:function(t,e,a){"use strict";function o(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(e,"__esModule",{value:!0});var s=a(347),r=o(s),i=a(5),n=a(15),l=o(n),c=a(7);e.default={metaInfo:{titleTemplate:"%s - Meu Perfil"},data:function(){return{user:"",msg:"",options:[],form:new l.default({name:"",email:"",password:"",password_confirmation:"",roles:[]}),loading:!0,loadingButton:!1,dialogFormVisible:!1}},watch:{user:function(t){this.form.name=t.name,this.form.email=t.email}},methods:{date:function(t){return moment(t).format("DD/MM/YYYY HH:mm:ss")},clearForm:function(){this.form.name="",this.form.email="",this.form.password="",this.form.password_confirmation=""},updateProfile:function(){var t=this;this.loadingButton=!0,this.form.put(i.userURL+"/"+this.user.id).then(function(e){t.msg="Usuário "+e.data.user.name+" atualizado com sucesso!",window.localStorage.setItem("authUser",(0,r.default)(e.data.user)),t.user=e.data.user,t.$store.dispatch("setUser",e.data.user),t.clearForm(),t.loadingButton=!1,t.dialogFormVisible=!1}).catch(function(e){t.loadingButton=!1,console.log(e)})}},created:function(){var t=this,e=this;setTimeout(function(){c.http.get(i.meURL).then(function(t){e.user=t.data,e.form.name=e.user.name,e.form.email=e.user.email}).catch(function(t){console.log(t),e.$notify({title:"Erro",message:"Houve um erro de resposta no servidor",type:"error",duration:5e3})}),e.loading=!1},1e3);var a=[];c.http.get(i.roleUrl).then(function(e){for(var o=0;o<e.data.length;o++)console.log(e.data[o]),a.push({value:e.data[o].id,label:e.data[o].display_name});t.options=a})}}},347:function(t,e,a){t.exports={default:a(404),__esModule:!0}},404:function(t,e,a){var o=a(11),s=o.JSON||(o.JSON={stringify:JSON.stringify});t.exports=function(t){return s.stringify.apply(s,arguments)}},444:function(t,e,a){e=t.exports=a(2)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"edit.vue",sourceRoot:"webpack://"}])},446:function(t,e,a){e=t.exports=a(2)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"index.vue",sourceRoot:"webpack://"}])},457:function(t,e,a){e=t.exports=a(2)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"create.vue",sourceRoot:"webpack://"}])},467:function(t,e,a){e=t.exports=a(2)(),e.push([t.id,"","",{version:3,sources:[],names:[],mappings:"",file:"profile.vue",sourceRoot:"webpack://"}])},498:function(t,e,a){var o=a(444);"string"==typeof o&&(o=[[t.id,o,""]]);a(3)(o,{});o.locals&&(t.exports=o.locals)},500:function(t,e,a){var o=a(446);"string"==typeof o&&(o=[[t.id,o,""]]);a(3)(o,{});o.locals&&(t.exports=o.locals)},512:function(t,e,a){var o=a(457);"string"==typeof o&&(o=[[t.id,o,""]]);a(3)(o,{});o.locals&&(t.exports=o.locals)},529:function(t,e,a){var o=a(467);"string"==typeof o&&(o=[[t.id,o,""]]);a(3)(o,{});o.locals&&(t.exports=o.locals)},563:function(t,e,a){var o,s;a(512),o=a(330);var r=a(596);s=o=o||{},"object"!=typeof o.default&&"function"!=typeof o.default||(s=o=o.default),"function"==typeof s&&(s=s.options),s.render=r.render,s.staticRenderFns=r.staticRenderFns,t.exports=o},564:function(t,e,a){var o,s;a(498),o=a(331);var r=a(582);s=o=o||{},"object"!=typeof o.default&&"function"!=typeof o.default||(s=o=o.default),"function"==typeof s&&(s=s.options),s.render=r.render,s.staticRenderFns=r.staticRenderFns,t.exports=o},565:function(t,e,a){var o,s;a(500),o=a(332);var r=a(584);s=o=o||{},"object"!=typeof o.default&&"function"!=typeof o.default||(s=o=o.default),"function"==typeof s&&(s=s.options),s.render=r.render,s.staticRenderFns=r.staticRenderFns,t.exports=o},566:function(t,e,a){var o,s;a(529),o=a(333);var r=a(612);s=o=o||{},"object"!=typeof o.default&&"function"!=typeof o.default||(s=o=o.default),"function"==typeof s&&(s=s.options),s.render=r.render,s.staticRenderFns=r.staticRenderFns,t.exports=o},582:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement;t._self._c||e;return t._m(0)},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{},[a("h1",[t._v("Edit")])])}]}},584:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{},[2==t.$route.matched.length?[a("div",{staticClass:"pull-right"},[a("div",{staticClass:"col-lg-12 form-group"},[a("router-link",{staticClass:"btn bg-blue btn-labeled heading-btn",attrs:{to:"/users/create"}},[a("b",[a("i",{staticClass:"icon-user-plus"})]),t._v(" Criar Usuário")])],1)]),t._v(" "),a("datatable-slot",{directives:[{name:"loading",rawName:"v-loading.body",value:t.loading,expression:"loading",modifiers:{body:!0}}],attrs:{title:"Lista de Usuários",id:"table1",url:"http://localhost:8000/api/teste",headers:[{header:"#"},{header:"Nome"},{header:"Email"},{header:"Niveis de Acesso"},{header:"Status"},{header:"Criado em"},{header:"Ações"}]}},t._l(t.rows,function(e,o){return a("tr",[a("td",[t._v(t._s(o+1))]),t._v(" "),a("td",[t._v(t._s(e.name))]),t._v(" "),a("td",[t._v(t._s(e.email))]),t._v(" "),a("td",[t._v(t._s(t.pluckRoles(e.roles)))]),t._v(" "),a("td",[null===e.deleted_at?a("span",{staticClass:"label bg-success"},[t._v("Ativo")]):a("el-tooltip",{staticStyle:{cursor:"pointer"},attrs:{content:"Usuário desativado em "+t.date(e.deleted_at),placement:"top"}},[a("span",{staticClass:"label bg-danger"},[t._v("Inativo")])])],1),t._v(" "),a("td",[t._v(t._s(t.date(e.created_at)))]),t._v(" "),a("td",{attrs:{sortable:"false"}},[a("ul",{staticClass:"icons-list"},[a("li",{staticClass:"dropdown"},[a("a",{staticClass:"dropdown-toggle",attrs:{href:"#","data-toggle":"dropdown"}},[a("i",{staticClass:"icon-menu9"})]),t._v(" "),a("ul",{staticClass:"dropdown-menu dropdown-menu-right"},[a("li",[a("router-link",{attrs:{to:{name:"user.edit",params:{id:e.id}}}},[a("i",{staticClass:"icon-database-remove"}),t._v(" Editar")])],1),t._v(" "),null===e.deleted_at?a("li",{on:{click:function(e){t.askInactive(o)}}},[a("a",{attrs:{href:"javascript:void(0)"}},[a("i",{staticClass:"icon-database-remove"}),t._v(" Inativar")])]):a("li",{on:{click:function(e){t.askActive(o)}}},[a("a",{attrs:{href:"javascript:void(0)"}},[a("i",{staticClass:"icon-database-add"}),t._v(" Ativar")])])])])])])])}))]:[a("router-view")]],2)},staticRenderFns:[]}},596:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"panel panel-default"},[a("div",{staticClass:"panel-heading"},[t._v("\n      Criar Usuário\n    ")]),t._v(" "),a("div",{staticClass:"panel-body"},[a("form",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],on:{submit:function(e){e.preventDefault(),t.newUser(e)},keydown:function(e){t.form.errors.clear(e.target.name)}}},[a("alert-success",{attrs:{form:t.form,message:t.msg}}),t._v(" "),a("alert-errors",{attrs:{form:t.form,classe:"alert bg-danger alert-styled-left",message:""}}),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"form-group col-lg-6"},[a("label",[t._v("Nome:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],staticClass:"form-control",attrs:{type:"text",value:""},domProps:{value:t.form.name},on:{input:function(e){e.target.composing||(t.form.name=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group col-lg-6"},[a("label",[t._v("Email:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control",attrs:{type:"email",value:""},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||(t.form.email=e.target.value)}}})])]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"form-group col-lg-6"},[a("label",[t._v("Password:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password,expression:"form.password"}],staticClass:"form-control",attrs:{type:"password",value:""},domProps:{value:t.form.password},on:{input:function(e){e.target.composing||(t.form.password=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group col-lg-6"},[a("label",[t._v("Password Confirmation:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password_confirmation,expression:"form.password_confirmation"}],staticClass:"form-control",attrs:{type:"password",value:""},domProps:{value:t.form.password_confirmation},on:{input:function(e){e.target.composing||(t.form.password_confirmation=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group col-lg-12"},[a("label",{attrs:{for:""}},[t._v("Níveis de Permissão")]),a("br"),t._v(" "),a("el-select",{attrs:{multiple:"",placeholder:"Escolha os Niveis de Permissão"},model:{value:t.form.roles,callback:function(e){t.form.roles=e},expression:"form.roles"}},t._l(t.options,function(t){return a("el-option",{key:t.value,attrs:{label:t.label,value:t.value}})}))],1)]),t._v(" "),t._m(0)],1)])])},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"row"},[a("div",{staticClass:"form-group col-lg-12"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Criar ")])])])}]}},612:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{},[a("el-dialog",{attrs:{title:"Atualizar Perfil",visible:t.dialogFormVisible},on:{"update:visible":function(e){t.dialogFormVisible=e}},model:{value:t.dialogFormVisible,callback:function(e){t.dialogFormVisible=e},expression:"dialogFormVisible"}},[a("form",{on:{keydown:function(e){t.form.errors.clear(e.target.name)},keyup:function(e){return"button"in e||!t._k(e.keyCode,"enter",13)?void t.updateProfile(e):null}}},[a("alert-errors",{attrs:{form:t.form,classe:"alert bg-danger alert-styled-left",message:""}}),t._v(" "),a("div",{staticClass:"form-group"},[a("label",[t._v("Name:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.form.name},on:{input:function(e){e.target.composing||(t.form.name=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group"},[a("label",[t._v("Email:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||(t.form.email=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group"},[a("label",[t._v("Password:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password,expression:"form.password"}],staticClass:"form-control",attrs:{type:"password"},domProps:{value:t.form.password},on:{input:function(e){e.target.composing||(t.form.password=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group"},[a("label",[t._v("Password Confirmation:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password_confirmation,expression:"form.password_confirmation"}],staticClass:"form-control",attrs:{type:"password"},domProps:{value:t.form.password_confirmation},on:{input:function(e){e.target.composing||(t.form.password_confirmation=e.target.value)}}})])],1),t._v(" "),a("span",{staticClass:"dialog-footer",slot:"footer"},[a("el-button",{on:{click:function(e){t.dialogFormVisible=!1}}},[t._v("Cancelar")]),t._v(" "),a("el-button",{attrs:{"native-type":"submit",type:"primary",loading:t.loadingButton},on:{click:t.updateProfile}},[t._v("Atualizar")])],1)]),t._v(" "),a("alert-success",{attrs:{form:t.form,message:t.msg}}),t._v(" "),a("div",{directives:[{name:"loading",rawName:"v-loading.body",value:t.loading,expression:"loading",modifiers:{body:!0}}],staticClass:"panel panel-default"},[a("div",{staticClass:"panel-heading"},[t._m(0),t._v(" "),a("div",{staticClass:"heading-elements"},[a("ul",{staticClass:"icons-list"},[a("li",{staticClass:"dropdown"},[t._m(1),t._v(" "),a("ul",{staticClass:"dropdown-menu dropdown-menu-right"},[a("li",{on:{click:function(e){t.dialogFormVisible=!0}}},[t._m(2)])])])])])]),t._v(" "),t.user?a("div",{staticClass:"panel-body"},[a("div",{staticClass:"form-group"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-lg-6"},[a("label",{attrs:{for:""}},[t._v("Nome:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.user.name,expression:"user.name"}],staticClass:"form-control",attrs:{type:"text",name:"",disabled:""},domProps:{value:t.user.name},on:{input:function(e){e.target.composing||(t.user.name=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"col-lg-6"},[a("label",{attrs:{for:""}},[t._v("Email:")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.user.email,expression:"user.email"}],staticClass:"form-control",attrs:{type:"text",name:"",disabled:""},domProps:{value:t.user.email},on:{input:function(e){e.target.composing||(t.user.email=e.target.value)}}})])])]),t._v(" "),a("div",{staticClass:"form-group"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-lg-6"},[a("label",{attrs:{for:""}},[t._v("Criado em:")]),t._v(" "),a("input",{staticClass:"form-control",attrs:{type:"text",name:"",disabled:""},domProps:{value:t.date(t.user.created_at)}})]),t._v(" "),a("div",{staticClass:"col-lg-6"},[a("label",{attrs:{for:""}},[t._v("Ultima atualização:")]),t._v(" "),a("input",{staticClass:"form-control",attrs:{type:"text",name:"",disabled:""},domProps:{value:t.date(t.user.updated_at)}})])])]),t._v(" "),a("div",{staticClass:"form-group"},[a("label",{attrs:{for:""}},[t._v("Níveis de Permissão")]),a("br"),t._v(" "),a("ul",t._l(t.user.roles,function(e){return a("li",[t._v(t._s(e.display_name))])}))])]):t._e()])],1)},staticRenderFns:[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("h6",{staticClass:"panel-title"},[t._v("Meu Perfil"),a("a",{staticClass:"heading-elements-toggle"},[a("i",{staticClass:"icon-more"})])])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{staticClass:"dropdown-toggle",attrs:{href:"#","data-toggle":"dropdown","aria-expanded":"false"}},[a("i",{staticClass:"icon-menu7"}),t._v(" "),a("span",{staticClass:"caret"})])},function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a",{attrs:{href:"javascript:void(0)"}},[a("i",{staticClass:"icon-sync"}),t._v(" Atualizar dados\n                    ")])}]}}});
//# sourceMappingURL=1.0919402ff30097cd26c6.js.map