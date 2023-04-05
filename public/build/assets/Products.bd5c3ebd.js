import{A as p,I as U,B as $,o as a,a as c,d,u as t,f as e,j as q,n as T,h as b,k as g,F as _,K as y,t as i,H as D,J as L,q as O,S as R,N as J}from"./app.ca28ce8f.js";import{S as K,R as Q,L as W}from"./Magnify.02e63689.js";import{_ as z,C as X}from"./AuthenticatedLayout.d322e44e.js";import{E as Y}from"./MicrosoftExcel.4b1cc309.js";import{_ as Z,r as ee}from"./Breadcrumbs.ffc166ce.js";import{r as te}from"./BackspaceIcon.780bdbb6.js";import{r as re}from"./ListBulletIcon.c273368d.js";import"./_plugin-vue_export-helper.cdc0426e.js";const se={class:"container mx-auto mt-5"},oe={class:"flex lg:flex-row flex-col items-center justify-center relative pb-10"},ae=e("h1",{class:"font-semibold text-center mx-1 lg:text-2xl text-lg text-gray-800 py-2"},"Commande Entrep\xF4t - Gamme",-1),ne={key:0,class:"lg:absolute inset-0 lg:flex items-center justify-end"},ie={class:""},le=["onSubmit"],ce={class:"block text-sm cursor-pointer text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300 px-2 py-2 rounded-xl",for:"file_import_cart"},me={class:"hidden whitespace-nowrap truncate",id:"file_name_span_client"},de=e("span",{id:"file_name_client"},null,-1),ue={class:"mt-1 ml-1 text-sm text-gray-500"},pe=["href"],ge=["href"],_e={key:0,class:"col-span-1"},fe=e("button",{type:"submit",class:"px-2 py-2 rounded-xl text-sm text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300"},"Importer !",-1),xe=[fe],he={class:"mx-1 my-1 flex sm:flex-row flex-col w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0"},ve={class:"relative flex-grow"},be={class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"},ye={class:"sm:w-auto w-full sm:pl-2 pl-0 sm:pt-0 pt-2"},we={class:"grid grid-cols-4",id:"gammes"},Ie=["href"],Be={class:"relative group z-20"},Ce={key:0,class:"relative w-full lg:h-60 sm:h-52 h-40 z-20"},Pe=["src","alt"],ke={key:1,class:"relative w-full h-60"},Ee=e("span",null,"Pas de photo pour cette gamme !",-1),Ue=[Ee],Te={class:"absolute bottom-0 z-30 w-full overflow-hidden text-sm"},Le={class:"max-h-0 group-hover:max-h-60 rounded group-hover:p-1 transition-full duration-500 bg-primary-300 text-center flex flex-col sm:bg-opacity-70 text-white z-30"},Re={class:"capitalize"},ze={class:"flex flex-wrap items-center justify-center text-center lg:px-4 px-0 py-2"},Ne={class:"capitalize text-center font-semibold"},Ve={class:"grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6"},je={class:"lg:col-span-1 sm:col-span-2 col-span-4 sm:text-start text-center"},Se=O('<option value="8">8 par page</option><option value="12">12 par page</option><option value="18">18 par page</option><option value="50">50 par page</option><option value="100">100 par page</option>',5),Me=[Se],Fe={class:"lg:col-span-2 sm:col-span-2 col-span-4 lg:text-center sm:text-end text-center sm:my-0 my-2"},Ge={class:"flex lg:justify-end justify-center lg:col-span-1 col-span-4"},He={class:"relative z-0 inline-flex rounded-md shadow-sm -space-x-px","aria-label":"Pagination"},Ae=["href"],$e={key:0},qe={layout:(f,x)=>f(z,()=>child),layout:z},Ze=Object.assign(qe,{__name:"Products",props:["products","dimensions"],setup(f){const x=f;var N=[{title:"Accueil",link:"/",icon:ee,active:!1},{title:"Commande Entrep\xF4t - Gamme",link:"/order_entrepot/gamme",icon:re,active:!0}];const V=new URL("/build/assets/Template_Vierge_Com.b1659618.xlsx",self.location).href,j=new URL("/build/assets/Template_Model_Com.8eb69b5c.xlsx",self.location).href;p(!1);var l=p(x.products),w=p(U().props.value.auth.user[0].client);let u=p(!1);var S=p(U().props.value.session.typeVente),I=o=>{o.target.value==""?(document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),u.value=!1):(document.getElementById("file_name_client").innerText=o.target.files[0].name,document.getElementById("file_name_span_client").classList.remove("hidden"),u.value=!0)},B=()=>{document.getElementById("file_import_cart").value=null,document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),u.value=!1};const M=()=>{var o=new FormData(document.getElementById("fileCartImport"));R.post("/order_entrepot/panier/import",o).then(s=>{console.log(s),s.status?document.location.href="/cart":Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'importation de votre fichier, veuillez v\xE9rifier que votre fichier correspond bien \xE0 l'exemple fournis puis ressayer !"})})},h=o=>HtmlEntities.decode(o.toLowerCase()),F=o=>x.dimensions.filter(({id_gamme:s})=>s===o);var m={previous:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",previous_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",next:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",next_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",number:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50",number_active:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 bg-gray-100"},C=()=>{const o=new URL(window.location.href);var s=document.getElementById("per_page");o.searchParams.set("perPage",s.value),window.location.href=o.href},G=()=>{const o=new URL(window.location.href);return o.searchParams.get("perPage")!=null?o.searchParams.get("perPage"):12},P=o=>{var s="/order_entrepot/gamme?filter[nom_gamme]="+o.target.value;R.post(encodeURI(s)).then(r=>{if(r.status==200){const n=new URL(window.location.href);n.searchParams.set("filter[nom_gamme]",o.target.value),l.value=r.data.products,window.history.replaceState("","",n.href)}})},H=o=>(Math.round(o*100)/100).toFixed(2),A=o=>{var s=o;return w.value.taux_remise>0&&(s=s-s*(w.value.taux_remise/100)),H(s)},k=()=>{Swal.fire({title:"Attention",text:"\xCAtes-vous de vider votre panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(o=>{o.isConfirmed&&J.Inertia.post("/cart/empty",{},{preserveScroll:!0,onSuccess:s=>{console.log(s),s.props.session.status?Toast.fire({icon:"success",title:"Le panier a bien \xE9t\xE9 vider !"}):Toast.fire({icon:"error",title:"Une erreur est survenue, pour vider votre panier, vous pouvez aussi vous d\xE9connecter et vous reconnecter."})}})})};return $(()=>{var o=document.getElementById("per_page");o.value=G();const s=new URL(window.location.href);var r=document.getElementById("searchGamme");r.value=s.searchParams.get("filter[nom_gamme]")}),(o,s)=>(a(),c(_,null,[d(t(D),{title:"Produits"}),e("section",se,[d(Z,{links:t(N)},null,8,["links"]),e("div",oe,[ae,t(S)==1?(a(),c("div",ne,[e("div",ie,[e("form",{id:"fileCartImport",class:"grid grid-cols-4 max-w-[21rem]",onSubmit:q(M,["prevent"])},[e("div",{class:T(["relative lg:mx-2 mx-1 flex flex-col max-w-sm",t(u)?"col-span-3":" col-span-4"])},[e("label",ce,[b("Importer fichier de commandes "),d(Y)]),e("span",me,[e("button",{type:"button",onClick:s[0]||(s[0]=(...r)=>t(B)&&t(B)(...r))},[d(X)]),de]),e("input",{onChange:s[1]||(s[1]=(...r)=>t(I)&&t(I)(...r)),type:"file",class:"hidden",id:"file_import_cart",accept:"application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",name:"fileImport"},null,32),e("span",ue,[e("a",{href:t(V),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Template vierge",8,pe),b(" / "),e("a",{href:t(j),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Mod\xE8le",8,ge)])],2),t(u)?(a(),c("div",_e,xe)):g("",!0)],40,le)])])):g("",!0)]),e("div",he,[e("div",ve,[e("input",{class:"block w-full pl-9 text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300",placeholder:"Recherche...",id:"searchGamme",type:"text",name:"global",onInput:s[2]||(s[2]=(...r)=>t(P)&&t(P)(...r))},null,32),e("div",be,[d(K,{class:"text-xl mb-1"})])]),e("div",ye,[e("button",{type:"button",onClick:s[3]||(s[3]=(...r)=>t(k)&&t(k)(...r)),class:"sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[d(t(te),{class:"w-5 h-5 mr-2"}),b("Vider mon panier")])])]),e("div",we,[(a(!0),c(_,null,y(t(l).data,(r,n)=>(a(),c("a",{key:n,href:"/order_entrepot/gamme/"+h(r.nom_gamme),class:"z-30 lg:col-span-1 col-span-2 group p-4 hover:scale-110 transition-full duration-300 cursor-pointer"},[e("div",Be,[r.img_gamme!=null?(a(),c("div",Ce,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/gamme/"+r.img_gamme,alt:r.nom_gamme,class:"z-20 rounded relative w-full h-full object-cover"},null,8,Pe)])):(a(),c("div",ke,Ue)),e("div",Te,[e("div",Le,[e("span",null,"Tapis "+i(r.type_tapis==0?"int\xE9rieur":r.type_tapis==1?"ext\xE9rieur":"int\xE9rieur / ext\xE9rieur"),1),e("span",null,"Poils "+i(r.type_poils==1?"court":"long")+" - "+i(r.uv_proof==1?"R\xE9sistants aux UV":"Non R\xE9sistants aux UV"),1),e("span",Re,i(h(r.nom_special)),1),e("div",ze,[(a(!0),c(_,null,y(F(r.id_gamme),(E,v)=>(a(),c("span",{key:v,class:"block text-center w-auto lg:px-1"},i(!Number.isInteger(v/3)&&v!=0?" - ":"")+" "+i(E.largeur)+"x"+i(E.longueur)+"cm ",1))),128))]),e("span",null,"Prix HT m\xB2 : "+i(t(A)(r.prix_vente_ht_m2))+" \u20AC",1)])])]),e("div",null,[e("h2",Ne,"Collection "+i(h(r.nom_gamme)),1)])],8,Ie))),128))]),e("div",Ve,[e("div",je,[e("select",{id:"per_page",name:"per_page",dusk:"per-page-full",onChange:s[4]||(s[4]=(...r)=>t(C)&&t(C)(...r)),class:"xl:mr-5 mr-2 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"},Me,32),e("span",null,"Page "+i(t(l).current_page)+" sur "+i(t(l).last_page),1)]),e("span",Fe,i(t(l).total)+" R\xE9sultats",1),e("div",Ge,[e("nav",He,[(a(!0),c(_,null,y(t(l).links,(r,n)=>(a(),c("a",{key:n,class:T(n!=0&&n+1!=t(l).links.length?r.active?t(m).number_active:t(m).number:n==0?t(l).current_page==1?t(m).previous_disabled:t(m).previous:t(l).current_page==t(l).last_page?t(m).next_disabled:t(m).next),href:r.url},[n!=0&&n+1!=t(l).links.length?(a(),c("span",$e,i(r.label),1)):g("",!0),n+1==t(l).links.length?(a(),L(Q,{key:1})):g("",!0),n==0?(a(),L(W,{key:2})):g("",!0)],10,Ae))),128))])])])])],64))}});export{Ze as default};
