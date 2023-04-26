import{A as u,I as E,B as A,o as n,a as c,d,u as t,f as e,j as F,n as U,h as b,k as _,F as g,J as y,t as i,H,K as L,q as $,S as R,N as q}from"./app.6dd0db0f.js";import{S as D,R as O,L as J}from"./Magnify.3132453d.js";import{_ as T,C as K}from"./AuthenticatedLayout.661d89ca.js";import{E as Q}from"./MicrosoftExcel.b2956daa.js";import{_ as W,r as X}from"./Breadcrumbs.34cde499.js";import{r as Y}from"./BackspaceIcon.478c846c.js";import{r as Z}from"./ListBulletIcon.26a7ca4f.js";import"./_plugin-vue_export-helper.cdc0426e.js";const ee={class:"container mx-auto mt-5"},te={class:"flex lg:flex-row flex-col items-center justify-center relative pb-10"},se=e("h1",{class:"font-semibold text-center mx-1 lg:text-2xl text-lg text-gray-800 py-2"},"Commande Entrep\xF4t - Gamme",-1),re={key:0,class:"lg:absolute inset-0 lg:flex items-center justify-end"},oe={class:""},ne=["onSubmit"],ae={class:"block text-sm cursor-pointer text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300 px-2 py-2 rounded-xl",for:"file_import_cart"},ie={class:"hidden whitespace-nowrap truncate",id:"file_name_span_client"},le=e("span",{id:"file_name_client"},null,-1),ce={class:"mt-1 ml-1 text-sm text-gray-500"},me=["href"],de=["href"],pe={key:0,class:"col-span-1"},ue=e("button",{type:"submit",class:"px-2 py-2 rounded-xl text-sm text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300"},"Importer !",-1),_e=[ue],ge={class:"mx-1 my-1 flex sm:flex-row flex-col w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0"},fe={class:"relative flex-grow"},xe={class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"},he={class:"sm:w-auto w-full sm:pl-2 pl-0 sm:pt-0 pt-2"},ve={class:"grid grid-cols-4",id:"gammes"},be=["href"],ye={class:"relative group z-20"},we={key:0,class:"relative w-full lg:h-60 sm:h-52 h-40 z-20"},Ie=["src","alt"],Be={key:1,class:"relative w-full h-60"},ke=e("span",null,"Pas de photo pour cette gamme !",-1),Ce=[ke],Pe={class:"absolute bottom-0 z-30 w-full overflow-hidden text-sm"},Ee={class:"max-h-0 group-hover:max-h-60 rounded group-hover:p-1 transition-full duration-500 bg-primary-300 text-center flex flex-col sm:bg-opacity-70 text-white z-30"},Ue={class:"capitalize"},Le={class:"flex flex-wrap items-center justify-center text-center lg:px-4 px-0 py-2"},Re={class:"capitalize text-center font-semibold"},Te={class:"grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6"},ze={class:"lg:col-span-1 sm:col-span-2 col-span-4 sm:text-start text-center"},Ve=$('<option value="8">8 par page</option><option value="12">12 par page</option><option value="18">18 par page</option><option value="50">50 par page</option><option value="100">100 par page</option>',5),je=[Ve],Ne={class:"lg:col-span-2 sm:col-span-2 col-span-4 lg:text-center sm:text-end text-center sm:my-0 my-2"},Se={class:"flex lg:justify-end justify-center lg:col-span-1 col-span-4"},Ge={class:"relative z-0 inline-flex rounded-md shadow-sm -space-x-px","aria-label":"Pagination"},Me=["href"],Ae={key:0},Fe={layout:(f,x)=>f(T,()=>child),layout:T},We=Object.assign(Fe,{__name:"Products",props:["products","dimensions"],setup(f){const x=f;var z=[{title:"Accueil",link:"/",icon:X,active:!1},{title:"Commande Entrep\xF4t",link:"/order_entrepot/gamme",icon:Z,active:!1},{title:"Gamme",link:"/order_entrepot/gamme",icon:"",active:!0}];const V=new URL("/build/assets/Template_Vierge_Com.b1659618.xlsx",self.location).href,j=new URL("/build/assets/Template_Model_Com.8eb69b5c.xlsx",self.location).href;u(!1);var l=u(x.products);u(E().props.value.auth.user[0].client);let p=u(!1);var N=u(E().props.value.session.typeVente),w=o=>{o.target.value==""?(document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),p.value=!1):(document.getElementById("file_name_client").innerText=o.target.files[0].name,document.getElementById("file_name_span_client").classList.remove("hidden"),p.value=!0)},I=()=>{document.getElementById("file_import_cart").value=null,document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),p.value=!1};const S=()=>{var o=new FormData(document.getElementById("fileCartImport"));R.post("/order_entrepot/panier/import",o).then(r=>{r.status?document.location.href="/cart":Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'importation de votre fichier, veuillez v\xE9rifier que votre fichier correspond bien \xE0 l'exemple fournis puis ressayer !"})})},h=o=>HtmlEntities.decode(o.toLowerCase()),G=o=>x.dimensions.filter(({id_gamme:r})=>r===o);var m={previous:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",previous_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",next:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",next_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",number:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50",number_active:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 bg-gray-100"},B=()=>{const o=new URL(window.location.href);var r=document.getElementById("per_page");o.searchParams.set("perPage",r.value),window.location.href=o.href},M=()=>{const o=new URL(window.location.href);return o.searchParams.get("perPage")!=null?o.searchParams.get("perPage"):12},k=o=>{var r="/order_entrepot/gamme?filter[nom_gamme]="+o.target.value;R.post(encodeURI(r)).then(s=>{if(s.status==200){const a=new URL(window.location.href);a.searchParams.set("filter[nom_gamme]",o.target.value),l.value=s.data.products,window.history.replaceState("","",a.href)}})},C=()=>{Swal.fire({title:"Attention",text:"\xCAtes-vous de vouloir vider votre panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(o=>{o.isConfirmed&&q.Inertia.post("/cart/empty",{},{preserveScroll:!0,onSuccess:r=>{console.log(r),r.props.session.status?Toast.fire({icon:"success",title:"Le panier a bien \xE9t\xE9 vider !"}):Toast.fire({icon:"error",title:"Une erreur est survenue, pour vider votre panier, vous pouvez aussi vous d\xE9connecter et vous reconnecter."})}})})};return A(()=>{var o=document.getElementById("per_page");o.value=M();const r=new URL(window.location.href);var s=document.getElementById("searchGamme");s.value=r.searchParams.get("filter[nom_gamme]")}),(o,r)=>(n(),c(g,null,[d(t(H),{title:"Produits"}),e("section",ee,[d(W,{links:t(z)},null,8,["links"]),e("div",te,[se,t(N)==1?(n(),c("div",re,[e("div",oe,[e("form",{id:"fileCartImport",class:"grid grid-cols-4 max-w-[21rem]",onSubmit:F(S,["prevent"])},[e("div",{class:U(["relative lg:mx-2 mx-1 flex flex-col max-w-sm",t(p)?"col-span-3":" col-span-4"])},[e("label",ae,[b("Importer fichier de commandes "),d(Q)]),e("span",ie,[e("button",{type:"button",onClick:r[0]||(r[0]=(...s)=>t(I)&&t(I)(...s))},[d(K)]),le]),e("input",{onChange:r[1]||(r[1]=(...s)=>t(w)&&t(w)(...s)),type:"file",class:"hidden",id:"file_import_cart",accept:"application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",name:"fileImport"},null,32),e("span",ce,[e("a",{href:t(V),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Template vierge",8,me),b(" / "),e("a",{href:t(j),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Mod\xE8le",8,de)])],2),t(p)?(n(),c("div",pe,_e)):_("",!0)],40,ne)])])):_("",!0)]),e("div",ge,[e("div",fe,[e("input",{class:"block w-full pl-9 text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300",placeholder:"Recherche...",id:"searchGamme",type:"text",name:"global",onInput:r[2]||(r[2]=(...s)=>t(k)&&t(k)(...s))},null,32),e("div",xe,[d(D,{class:"text-xl mb-1"})])]),e("div",he,[e("button",{type:"button",onClick:r[3]||(r[3]=(...s)=>t(C)&&t(C)(...s)),class:"sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[d(t(Y),{class:"w-5 h-5 mr-2"}),b("Vider mon panier")])])]),e("div",ve,[(n(!0),c(g,null,y(t(l).data,(s,a)=>(n(),c("a",{key:a,href:"/order_entrepot/gamme/"+h(s.nom_gamme),class:"z-30 lg:col-span-1 col-span-2 group p-4 hover:scale-110 transition-full duration-300 cursor-pointer"},[e("div",ye,[s.img_gamme!=null?(n(),c("div",we,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/gamme/"+s.img_gamme,alt:s.nom_gamme,class:"z-20 rounded relative w-full h-full object-cover"},null,8,Ie)])):(n(),c("div",Be,Ce)),e("div",Pe,[e("div",Ee,[e("span",null,"Tapis "+i(s.type_tapis==0?"int\xE9rieur":s.type_tapis==1?"ext\xE9rieur":"int\xE9rieur / ext\xE9rieur"),1),e("span",null,"Poils "+i(s.type_poils==1?"court":"long")+" - "+i(s.uv_proof==1?"R\xE9sistants aux UV":"Non R\xE9sistants aux UV"),1),e("span",Ue,i(h(s.nom_special)),1),e("div",Le,[(n(!0),c(g,null,y(G(s.id_gamme),(P,v)=>(n(),c("span",{key:v,class:"block text-center w-auto lg:px-1"},i(!Number.isInteger(v/3)&&v!=0?" - ":"")+" "+i(P.largeur)+"x"+i(P.longueur)+"cm ",1))),128))]),e("span",null,"Prix HT m\xB2 : "+i(s.prix_vente_ht_m2_remise?s.prix_vente_ht_m2_remise:s.prix_vente_ht_m2)+" \u20AC",1)])])]),e("div",null,[e("h2",Re,"Collection "+i(h(s.nom_gamme)),1)])],8,be))),128))]),e("div",Te,[e("div",ze,[e("select",{id:"per_page",name:"per_page",dusk:"per-page-full",onChange:r[4]||(r[4]=(...s)=>t(B)&&t(B)(...s)),class:"xl:mr-5 mr-2 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"},je,32),e("span",null,"Page "+i(t(l).current_page)+" sur "+i(t(l).last_page),1)]),e("span",Ne,i(t(l).total)+" R\xE9sultats",1),e("div",Se,[e("nav",Ge,[(n(!0),c(g,null,y(t(l).links,(s,a)=>(n(),c("a",{key:a,class:U(a!=0&&a+1!=t(l).links.length?s.active?t(m).number_active:t(m).number:a==0?t(l).current_page==1?t(m).previous_disabled:t(m).previous:t(l).current_page==t(l).last_page?t(m).next_disabled:t(m).next),href:s.url},[a!=0&&a+1!=t(l).links.length?(n(),c("span",Ae,i(s.label),1)):_("",!0),a+1==t(l).links.length?(n(),L(O,{key:1})):_("",!0),a==0?(n(),L(J,{key:2})):_("",!0)],10,Me))),128))])])])])],64))}});export{We as default};
