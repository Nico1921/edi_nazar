import{z as $,P as A,B as O,A as F,o as n,a as d,d as c,e as b,f as e,F as E,K as j,Q as L,t as l,u as s,j as J,h as q,k as C,b as N,H as W,L as X,n as Y,O as Z,M as V,R as ee}from"./app.6f12f04b.js";import{E as te}from"./EyeOutline.a95a3c84.js";import{D as se,_ as z,C as oe,R as ae}from"./AuthenticatedLayout.aa94ecda.js";import{R as ie,L as ne,I as G}from"./MenuRight.1817d377.js";import{S as re,L as le}from"./Magnify.425c7633.js";import{C as de}from"./LangueChoice.869b46ff.js";import{E as ce}from"./Pencil.e9733235.js";import{_ as ue}from"./InputNumber.4f63e9e4.js";import{S as me,N as pe,P as _e,a as ge,A as fe,b as he}from"./pagination.min.bb8b5cfa.js";import{f as ve,o as M}from"./transition.0925d229.js";import{N as be,_ as xe,U as ye}from"./dialog.d2f192ac.js";import"./micro-task.fe338338.js";import"./description.a5bf5428.js";const we={class:"bg-gray-100 shadow-lg"},$e={class:"swiper-button-prev-custom absolute top-1/2 right-0 z-40 cursor-pointer lg:block hidden"},Pe={class:"swiper-button-next-custom absolute top-1/2 left-0 z-40 cursor-pointer lg:block hidden"},ke=e("div",{class:"swiper-pagination-custom flex items-center justify-center py-2"},null,-1),De={class:"bg-gray-200 grid grid-cols-12 px-4 py-4"},Be={class:"2xl:col-span-4 lg:col-span-3 sm:col-span-2 xsm:col-span-4 col-span-5 flex items-stretch justify-center w-full"},Ie={key:0,class:"w-full"},Ee=["src","alt"],Ce={key:1,class:"text-3xl w-full flex items-stretch justify-center bg-gray-300"},Se={class:"2xl:col-span-8 lg:col-span-9 sm:col-span-10 xsm:col-span-8 col-span-7 px-2 grid grid-cols-1"},je={class:"sm:text-sm text-[0.700rem] font-bold"},Ae={class:"sm:text-sm text-[0.700rem] font-bold"},Ve={class:"sm:text-sm text-[0.700rem] font-bold"},Le={class:"sm:text-sm text-[0.700rem] font-bold"},qe={class:"grid grid-cols-12"},Ne={class:"2xl:pr-1 sm:col-span-1 col-span-2"},Te={key:0},Ue=e("span",{class:"bg-green-700 w-[20px] h-[20px] block rounded-full"},null,-1),Re=[Ue],ze={key:1},Me=e("span",{class:"bg-orange-400 w-[20px] h-[20px] block rounded-full"},null,-1),Oe=[Me],Fe={key:2},Ge=e("span",{class:"bg-red-700 w-[20px] h-[20px] block rounded-full"},null,-1),He=[Ge],Qe={class:"2xl:pr-1 sm:col-span-11 col-span-10"},Ke={key:0},Je=e("span",{class:"sm:text-sm text-[0.700rem] font-bold"},"En stock",-1),We=[Je],Xe={key:1},Ye=e("span",{class:"sm:text-sm text-[0.700rem] font-bold"},"Stock Faible",-1),Ze=[Ye],et={key:2},tt=e("span",{class:"sm:text-sm text-[0.700rem] font-bold"},"Rupture de stock",-1),st=[tt],ot={key:0,class:"mt-2"},at=["onSubmit"],it=["value"],nt=["value"],rt=["value"],lt=["value"],dt={class:"sm:col-span-3 col-span-8 mr-2"},ct={class:"sm:col-span-5 col-span-8"},ut={class:"h-10 flex items-start"},mt={type:"submit",class:"sm:text-sm text-[0.700rem] font-bold sm:h-full h-3/4 sm:mt-0 mt-2 sm:px-3 px-2 bg-primary-50 rounded hover:bg-primary-100 transition duration-300"},pt={key:1,class:"col-span-2 grid grid-cols-2"},_t={class:"col-span-2"},gt={class:"whitespace-pre-line"},ft={class:"grid grid-cols-8 col-span-2"},ht={class:"xl:col-span-5 sm:col-span-4 col-span-8 w-full h-8 bg-gray-300 flex items-center justify-center rounded"},vt={class:""},bt={class:"xl:col-span-3 sm:col-span-4 col-span-8 sm:mt-0 mt-1"},xt=["onClick"],yt=["onClick"],wt={__name:"DetailsDesignAction",props:["designs","gamme"],setup(m){const _=m;var h=$(_.designs),P=$(A().props.value.session.typeVente);O(()=>{P.value=A().props.value.session.typeVente});var S=(u,x)=>{u.preventDefault();var o=new FormData(u.target);const v=N({idProduit:o.get("id_produit"),quantiter:o.get("qte"),id_panier_edi_list:o.get("id_panier_edi_list"),id_client_edi:o.get("id_client_edi")});console.log(_.gamme),v.post("/orders/clients/products/"+_.gamme.nom_gamme+"/add",{preserveScroll:!0,preserveState:!0,onSuccess:f=>{f.props.session.status?(h.value[o.get("key_tab")].panier.id_panier_edi_list=f.props.session.id_panier_edi_list,h.value[o.get("key_tab")].isInPanier=!0,h.value[o.get("key_tab")].panier.quantiter=o.get("qte"),Toast.fire({icon:"success",title:x?"La quantiter pour ce produit \xE0 bien \xE9t\xE9 modifier":"Le produit \xE0 bien ajouter au panier"})):Toast.fire({icon:"error",title:f.props.session.message})}})},p=u=>{h.value[u].isInPanier=!1},k=(u,x)=>{Swal.fire({title:"Attention",text:"Etes-vous de supprimer cette article de la commande ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(o=>{o.isConfirmed&&N({id_panier_edi_list:u}).post("/orders/clients/products/"+_.gamme+"/delete",{preserveScroll:!0,onSuccess:f=>{f.props.session.status?(Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer de la commande"}),h.value[x].isInPanier=!1,h.value[x].panier.quantiter=0,h.value[x].panier.id_panier_edi_list=0):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la supression du produit de la commande"})}})})},B=u=>(Math.round(u*100)/100).toFixed(2);return F(()=>{const u=document.querySelector(".swiper").swiper;u.setBreakpoint({640:{slidesPerView:2},1024:{slidesPerView:3}}),u.update()}),(u,x)=>(n(),d("div",we,[c(s(he),{modules:[s(pe),s(_e),s(ge),s(fe)],"slides-per-view":3,"space-between":40,breakpoints:{1536:{slidesPerView:3},1024:{slidesPerView:2},0:{slidesPerView:1}},pagination:{clickable:!0,el:".swiper-pagination-custom",bulletActiveClass:"opacity-full",bulletClass:"swiper-pagination-bullet mx-2 !bg-primary-100",type:"bullets"},scrollbar:{draggable:!0},navigation:{nextEl:".swiper-button-prev-custom",prevEl:".swiper-button-next-custom",disabledClass:"opacity-50"},class:"lg:!px-9 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative"},{default:b(()=>[e("div",$e,[c(ie,{class:"!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100"})]),e("div",Pe,[c(ne,{class:"!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100"})]),ke,(n(!0),d(E,null,j(s(h),(o,v)=>(n(),L(s(me),{class:"sm:h-48 h-58",key:v},{default:b(()=>[e("div",De,[e("div",Be,[o.photo!=null?(n(),d("div",Ie,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+o.photo.img_produit,alt:o.code_sku,class:"w-full h-full object-content"},null,8,Ee)])):(n(),d("div",Ce,[c(G)]))]),e("div",Se,[e("span",je,"SKU : "+l(o.code_sku),1),e("span",Ae,"Taille : "+l(o.dimension.largeur)+"x"+l(o.dimension.longueur)+"cm",1),e("span",Ve,"EAN : "+l(o.gencode),1),e("span",Le,"Prix : "+l(s(B)(o.prixProduit))+" \u20AC HT",1),e("div",qe,[e("div",Ne,[o.stats_produit.stock_restant>10?(n(),d("div",Te,Re)):o.stats_produit.stock_restant>0?(n(),d("div",ze,Oe)):(n(),d("div",Fe,He))]),e("div",Qe,[o.stats_produit.stock_restant>10?(n(),d("div",Ke,We)):o.stats_produit.stock_restant>0?(n(),d("div",Xe,Ze)):(n(),d("div",et,st))])]),s(P)==2?(n(),d("div",ot,[o.stats_produit.stock_restant>0&&!o.isInPanier?(n(),d("form",{key:0,onSubmit:J(f=>s(S)(f,o.panier.quantiter>0),["prevent"]),class:"grid grid-cols-8"},[e("input",{type:"hidden",name:"id_produit",value:o.id_produit},null,8,it),e("input",{type:"hidden",name:"id_client_edi",value:o.id_client_edi},null,8,nt),e("input",{type:"hidden",name:"id_panier_edi_list",value:o.panier.id_panier_edi_list!=null?o.panier.id_panier_edi_list:0},null,8,rt),e("input",{type:"hidden",name:"key_tab",value:v},null,8,lt),e("div",dt,[c(ue,{class:"sm:h-10 h-8 sm:w-full w-32",name:"qte",max:o.stats_produit.stock_restant,value:o.panier.quantiter>0?o.panier.quantiter:1},null,8,["max","value"])]),e("div",ct,[e("div",ut,[e("button",mt,l(o.panier.quantiter>0?"Modifier":"Ajouter \xE0")+" la commande",1)])])],40,at)):o.isInPanier?(n(),d("div",pt,[e("div",_t,[e("span",gt,[c(de,{class:"text-green-500"}),q(" Ajouter \xE0 la commande du client. ")])]),e("div",ft,[e("div",ht,[e("span",vt,"Quantiter : "+l(o.panier.quantiter),1)]),e("div",bt,[e("button",{type:"button",onClick:f=>s(p)(v),class:"px-2 h-8 bg-primary-50 rounded hover:bg-primary-100 transition duration-300 sm:mx-1 mr-1 xl:mb-0 mb-2 sm:w-10 w-1/2"},[c(ce,{class:"text-white"})],8,xt),e("button",{type:"button",onClick:f=>s(k)(o.panier.id_panier_edi_list!=null?o.panier.id_panier_edi_list:0,v),class:"px-2 h-8 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 sm:w-10 w-1/2"},[c(se,{class:"text-white"})],8,yt)])])])):C("",!0)])):C("",!0)])])]),_:2},1024))),128))]),_:1},8,["modules","pagination","navigation"])]))}},$t={class:"container mx-auto mt-5"},Pt=e("h1",{class:"text-center text-3xl text-gray-800"},"S\xE9lectionner les produits pour votre client.",-1),kt={class:"bg-primary-50 p-5 rounded my-3 grid grid-cols-4"},Dt={class:"col-span-1"},Bt=e("h2",{class:"text-2xl text-gray-700"},"Information du client : ",-1),It={class:"flex flex-col bg-primary-100 py-2 px-4 m-2 rounded-xl"},Et={class:"text-lg text-gray-600"},Ct={class:"flex flex-col mb-2"},St=e("span",null,null,-1),jt={class:"my-3 flex items-center justify-center"},At={class:"col-span-3"},Vt={class:"grid grid-cols-4"},Lt=e("h4",{class:"col-span-4 text-xl text-gray-500"},"Produits de la commandes :",-1),qt=["onClick"],Nt={class:"col-span-1 flex items-center justify-center"},Tt={key:0,class:"lg:w-[45px] lg:h-[75px] sm:w-[60px] sm:h-[90px] w-[70px] h-[100px]"},Ut=["src","alt"],Rt={key:1},zt=e("span",null,"Pas de photo pour ce produit !",-1),Mt=[zt],Ot={class:"flex flex-col col-span-3"},Ft={class:"mx-1 flex flex-row w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0"},Gt={class:"relative flex-grow"},Ht={class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"},Qt={class:"grid grid-flow-row-dense grid-cols-12",id:"TabProducts"},Kt=["data-positiontab","id"],Jt={class:"grid grid-cols-12 bg-primary-100 rounded-lg sm:h-48 h-38 mx-6 my-4 p-4"},Wt={class:"xl:col-span-5 sm:col-span-4 col-span-2 items-stretch justify-center flex sm:h-40 h-full"},Xt={key:0,class:"cursor-pointer relative overflow-hidden bg-gray-200 w-full h-full"},Yt={class:"absolute flex items-center justify-center w-full h-full"},Zt=["onClick","src","alt"],es={key:1,class:"text-3xl h-full w-full flex items-center justify-center bg-gray-300"},ts={class:"xl:col-span-7 sm:col-span-8 col-span-10 flex flex-col ml-3"},ss={class:"font-bold xl:text-xl sm:text-lg text-sm text-gray-600"},os={class:"font-semibold 2xl:text-lg text-sm"},as={class:"flex flex-start items-end h-full"},is=["onClick"],ns={class:"grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6"},rs={class:"lg:col-span-1 sm:col-span-2 col-span-4 sm:text-start text-center"},ls=Z('<option value="8">8 par page</option><option value="12">12 par page</option><option value="18">18 par page</option><option value="50">50 par page</option><option value="100">100 par page</option>',5),ds=[ls],cs={class:"lg:col-span-2 sm:col-span-2 col-span-4 lg:text-center sm:text-end text-center sm:my-0 my-2"},us={class:"flex lg:justify-end justify-center lg:col-span-1 col-span-4"},ms={class:"relative z-0 inline-flex rounded-md shadow-sm -space-x-px","aria-label":"Pagination"},ps=["href"],_s={key:0},gs=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),fs={class:"fixed inset-0 overflow-y-auto"},hs={class:"flex min-h-full items-center justify-center p-4 text-center"},vs=e("span",{id:"nomVisuelImage"},null,-1),bs=e("div",{class:"mt-2 h-[40rem] w-full"},[e("img",{id:"visuelImage",class:"w-full h-full object-cover"})],-1),xs={layout:(m,_)=>m(z,()=>child),layout:z},Vs=Object.assign(xs,{__name:"Products",props:["client","products","produitsAchat","gamme"],setup(m){const _=m;var h=$(A().props.value.dynamique_client),P=$(_.produitsAchat.panier),S=$(_.products.data),p=$(_.products),k=0;const B=$(!1);function u(){B.value=!1}function x(a,i,t,r){B.value=!0;var g=i+" "+t+" "+r;console.log(document.getElementById("visuelImage")),document.getElementById("visuelImage").setAttribute("src","https://gestion.tapis-nazar.fr/img/produit/"+a),document.getElementById("visuelImage").setAttribute("alt",g),document.getElementById("nomVisuelImage").textContent=g}const o=a=>{if(a!=""&&a!=null){var t=document.getElementById("tab_idDesign"+a),i=t.dataset.positiontab,t=t.nextSibling;t.id!="viewDetailsDesign"?V.post("/orders/design",{id_design:a}).then(r=>{if(r.status==200){document.getElementById("viewDetailsDesign")!=null&&(document.getElementById("viewDetailsDesign").__vue_app__!=null&&document.getElementById("viewDetailsDesign").__vue_app__.unmount(),document.getElementById("viewDetailsDesign").remove());var g=ee(wt,{designs:r.data,gamme:_.gamme}),y=document.createElement("div");y.id="viewDetailsDesign",y.dataset.idDesign=a;var w=I.base1;i==2?w=I.base2:i==3?w=I.base3:i==4&&(w=I.base4),y.classList=I.default+" "+w,document.getElementById("tab_idDesign"+a).parentNode.insertBefore(y,document.getElementById("tab_idDesign"+a).nextSibling),g.mount(document.getElementById("viewDetailsDesign"))}}):t.id=="viewDetailsDesign"&&(document.getElementById("viewDetailsDesign").__vue_app__!=null&&document.getElementById("viewDetailsDesign").__vue_app__.unmount(),document.getElementById("viewDetailsDesign").remove())}},v=()=>{if(document.getElementById("viewDetailsDesign")!=null){var a=document.getElementById("viewDetailsDesign").dataset.idDesign,i=document.getElementById("viewDetailsDesign").previousSibling;i.id!="tab_idDesign"+a&&(document.getElementById("viewDetailsDesign").__vue_app__!=null&&document.getElementById("viewDetailsDesign").__vue_app__.unmount(),document.getElementById("viewDetailsDesign").remove())}};var f=a=>{Swal.fire({title:"Attention",text:"Etes-vous de supprimer cette article de la commande ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(i=>{i.isConfirmed&&N({id_panier_edi_list:a}).post("/orders/clients/products/"+_.gamme+"/delete",{preserveScroll:!0,onSuccess:r=>{r.props.session.status?Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer de la commande"}):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la supression du produit de la commande"})}})})},H=a=>(Math.round(a*100)/100).toFixed(2);F(()=>{var a=document.getElementById("TabProducts"),i={attributes:!0,childList:!0,subtree:!0},t=new MutationObserver(v);t.observe(a,i);var r=document.getElementById("per_page");r.value=Q();const g=new URL(window.location.href);var y=document.getElementById("searchGamme");y.value=g.searchParams.get("filter[global]")}),O(()=>{h.value=A().props.value.dynamique_client,V.get("/orders/clients/products/"+_.gamme+"/view").then(a=>{console.log(a),a.data.produitsAchat!=null&&(a.data.produitsAchat.panier!=null?P.value=a.data.produitsAchat.panier:P.value=[])})});var I={default:"col-span-12 mx-6 relative inline-block  text-sm text-gray-500 whitespace-nowrap mt-4 before:-mt-[1.8rem] before:border-r-solid before:content-[''] before:block before:absolute before:w-0 before:h-0 before:border-l-[30px] before:border-l-transparent before:border-l-solid before:border-r-[30px] before:border-r-transparent  before:border-b-[30px] before:border-b-gray-100",base1:"before:xl:right-[85%] before:lg:right-[80%] before:sm:right-[70%] before:right-[50%]",base2:"before:xl:right-[60%] before:lg:right-[45%] before:sm:right-[15%] before:right-[50%]",base3:"before:xl:right-[35%] before:lg:right-[10%] before:sm:right-[15%] before:right-[50%]",base4:"before:xl:right-[5%] before:lg:right-[45%] before:sm:right-[15%] before:right-[50%]"},D={previous:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",previous_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",next:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",next_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",number:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50",number_active:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 bg-gray-100"},T=()=>{const a=new URL(window.location.href);var i=document.getElementById("per_page");a.searchParams.set("perPage",i.value),window.location.href=a.href},Q=()=>{const a=new URL(window.location.href);return a.searchParams.get("perPage")!=null?a.searchParams.get("perPage"):12},U=a=>{const i=new URL(window.location.href);i.searchParams.delete("filter[global]");var t=i.searchParams.get("perPage");i.searchParams.delete("perPage");var r=i.searchParams.get("page");i.searchParams.delete("page");var g=i.href+"/search";i.href=g,console.log(g),i.searchParams.set("filter[global]",a.target.value),t!=""&&t!=null&&i.searchParams.set("perPage",t),r!=""&&r!=null&&i.searchParams.set("page",r);var y=i.href;V.post(y).then(w=>{if(w.status==200){const R=new URL(window.location.href);R.searchParams.set("filter[global]",a.target.value),S.value=w.data.products.data,p.value=w.data.products,window.history.replaceState("","",R.href)}})};const K=()=>(k==4?k=1:k++,k);return(a,i)=>(n(),d(E,null,[c(s(W),{title:"Orders Products Clients"}),e("section",$t,[Pt,e("div",kt,[e("div",Dt,[Bt,e("div",It,[e("h3",Et,"Client : "+l(m.client.prenom+" "+m.client.nom),1),e("span",null,"Adresse : "+l(m.client.nom_adresse),1),e("div",Ct,[St,e("span",null,l(m.client.adresse1),1),e("span",null,l(m.client.adresse2),1),e("span",null,l(m.client.adresse3),1),e("span",null,l(m.client.code_postal+", "+m.client.ville),1)]),e("div",jt,[c(s(X),{class:"rounded p-4 bg-primary-200 hover:bg-primary-50 transition duration-300",href:"/orders/clients/validation"},{default:b(()=>[q("Valider la commande")]),_:1})])])]),e("div",At,[e("div",Vt,[Lt,(n(!0),d(E,null,j(s(P),(t,r)=>(n(),d("div",{key:r,class:"col-span-1 grid grid-cols-4 bg-primary-100 p-1 m-2 relative rounded-xl"},[e("button",{onClick:g=>s(f)(t.panier.id_panier_edi_list),class:"absolute right-2 top-1 hover:text-primary-200 transition duration-300",type:"button"},[c(oe)],8,qt),e("div",Nt,[t.photo.img_produit!=null?(n(),d("div",Tt,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+t.photo.img_produit,alt:t.code_sku,class:"w-full h-full object-cover"},null,8,Ut)])):(n(),d("div",Rt,Mt))]),e("div",Ot,[e("span",null,"Gamme : "+l(t.gamme.nom_gamme),1),e("span",null,"Design : "+l(t.design.nom_design),1),e("span",null,"Couleur : "+l(t.couleur.nom_couleur),1),e("span",null,"Dimension : "+l(t.dimension.largeur+"x"+t.dimension.longueur)+"cm",1),e("span",null,"Quantiter : "+l(t.panier.quantiter),1),e("span",null,"Prix unitaire : "+l(s(H)(t.prix_produit))+" \u20AC",1)])]))),128))])])]),e("div",Ft,[e("div",Gt,[e("input",{class:"block w-full pl-9 text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300",placeholder:"Recherche...",id:"searchGamme",type:"text",name:"global",onInput:i[0]||(i[0]=(...t)=>s(U)&&s(U)(...t))},null,32),e("div",Ht,[c(re,{class:"text-xl mb-1"})])])]),e("div",Qt,[(n(!0),d(E,null,j(s(S),(t,r)=>(n(),d("div",{class:"xl:col-span-3 lg:col-span-4 sm:col-span-6 col-span-12",key:r,"data-positiontab":K(),id:"tab_idDesign"+t.id_design},[e("div",Jt,[e("div",Wt,[t.img_produit!=null?(n(),d("div",Xt,[e("div",Yt,[c(te,{class:"text-lg text-black"})]),e("img",{onClick:g=>x(t.img_produit,t.nom_gamme,t.nom_design,t.nom_couleur),src:"https://gestion.tapis-nazar.fr/img/produit/"+t.img_produit,alt:t.code_sku,class:"z-20 relative hover:opacity-50 transition duration-300 w-full h-full object-content"},null,8,Zt)])):(n(),d("div",es,[c(G)]))]),e("div",ts,[e("span",ss,l(t.nom_design),1),e("span",os,"Couleur : "+l(t.nom_couleur),1),e("div",as,[e("button",{class:"py-2 px-3 h-10 rounded bg-primary-200 hover:bg-primary-50 2xl:text-lg text-sm text-white hover:text-primary-400 transition duration-300",type:"button",onClick:g=>o(t.id_design)},"Voir les produits",8,is)])])])],8,Kt))),128))]),e("div",ns,[e("div",rs,[e("select",{id:"per_page",name:"per_page",dusk:"per-page-full",onChange:i[1]||(i[1]=(...t)=>s(T)&&s(T)(...t)),class:"xl:mr-5 mr-2 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"},ds,32),e("span",null,"Page "+l(s(p).current_page)+" sur "+l(s(p).last_page),1)]),e("span",cs,l(s(p).total)+" R\xE9sultats",1),e("div",us,[e("nav",ms,[(n(!0),d(E,null,j(s(p).links,(t,r)=>(n(),d("a",{key:r,class:Y(r!=0&&r+1!=s(p).links.length?t.active?s(D).number_active:s(D).number:r==0?s(p).current_page==1?s(D).previous_disabled:s(D).previous:s(p).current_page==s(p).last_page?s(D).next_disabled:s(D).next),href:t.url},[r!=0&&r+1!=s(p).links.length?(n(),d("span",_s,l(t.label),1)):C("",!0),r+1==s(p).links.length?(n(),L(ae,{key:1})):C("",!0),r==0?(n(),L(le,{key:2})):C("",!0)],10,ps))),128))])])])]),c(s(ve),{show:B.value,as:"template",unmount:!1},{default:b(()=>[c(s(be),{as:"div",onClose:u,class:"relative z-30",unmount:!1},{default:b(()=>[c(s(M),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0",unmount:!1},{default:b(()=>[gs]),_:1}),e("div",fs,[e("div",hs,[c(s(M),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95",unmount:!1},{default:b(()=>[c(s(xe),{class:"w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all",unmount:!1},{default:b(()=>[c(s(ye),{unmount:!1,as:"h3",class:"text-lg font-medium leading-6 text-gray-900"},{default:b(()=>[q(" Visuel image "),vs]),_:1}),bs,e("div",{class:"flex flex-row-reverse"},[e("button",{type:"button",class:"mt-4 inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300",onClick:u},"Fermer")])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"])],64))}});export{Vs as default};
