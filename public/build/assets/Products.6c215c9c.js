import{A as b,J as F,b as G,B as H,o as n,a,d as m,u as t,f as e,j as A,n as y,h as w,k as p,F as g,q as k,t as l,H as O,e as U,K as z,M as q,$ as D,O as J}from"./app.97255e9c.js";import{E as K,S as Q,r as W,R as X,L as Y}from"./Magnify.0c24fa81.js";import{_ as L,C as Z}from"./AuthenticatedLayout.872a0e20.js";import{_ as ee,r as te}from"./Breadcrumbs.d6d20c8d.js";import{T as se}from"./floating-vue.es.561bf362.js";import{_ as re}from"./InputError.930e3767.js";import{r as oe}from"./BackspaceIcon.ab49af5b.js";import{r as ne}from"./ListBulletIcon.7abe640a.js";import"./_plugin-vue_export-helper.cdc0426e.js";const ae={class:"container mx-auto mt-5"},ie={class:"flex lg:flex-row flex-col items-center justify-center relative pb-10"},le=e("h1",{class:"font-semibold text-center mx-1 lg:text-2xl text-lg text-gray-800 py-2"},"Commandes Entrep\xF4t - Gammes",-1),ce={key:0,class:"lg:absolute inset-0 lg:flex items-center justify-end"},me={class:""},de=["onSubmit"],pe={class:"block text-sm cursor-pointer text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300 px-2 py-2 rounded-xl",for:"file_import_cart"},ue={class:"hidden whitespace-nowrap truncate",id:"file_name_span_client"},_e=e("span",{id:"file_name_client"},null,-1),ge={class:"mt-1 ml-1 text-sm text-gray-500"},fe=["href"],xe=["href"],he={key:0,class:"col-span-1"},ve=["disabled"],be={class:"mx-1 my-1 flex sm:flex-row flex-col w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0"},ye={class:"relative flex-grow"},we={class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"},ke={class:"sm:w-auto w-full sm:pl-2 pl-0 sm:pt-0 pt-2"},Ie={class:"grid grid-cols-4",id:"gammes"},Pe=["href"],Be={class:"relative group z-20"},Ce={key:0,class:"relative w-full lg:h-60 sm:h-52 h-40 z-20"},Ee=["src","alt"],Te={key:1,class:"relative w-full h-60"},Ue=e("span",null,"Pas de photo pour cette gamme !",-1),ze=[Ue],Le={class:"absolute bottom-0 z-30 w-full overflow-hidden text-sm"},Re={class:"max-h-0 group-hover:max-h-60 rounded group-hover:p-1 transition-full duration-500 bg-primary-300 text-center flex flex-col sm:bg-opacity-70 text-white z-30"},je={class:"capitalize"},Ve={class:"flex flex-wrap items-center justify-center text-center lg:px-4 px-0 py-2"},Ne={key:0},Se={key:1},$e={class:"flex items-center justify-center mt-1"},Me={class:"capitalize text-center font-semibold"},Fe=["href"],Ge=e("span",null,"T\xE9l\xE9charger la trame",-1),He={class:"grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6"},Ae={class:"lg:col-span-1 sm:col-span-2 col-span-4 sm:text-start text-center"},Oe=q('<option value="8">8 par page</option><option value="12">12 par page</option><option value="18">18 par page</option><option value="50">50 par page</option><option value="100">100 par page</option>',5),qe=[Oe],De={class:"lg:col-span-2 sm:col-span-2 col-span-4 lg:text-center sm:text-end text-center sm:my-0 my-2"},Je={class:"flex lg:justify-end justify-center lg:col-span-1 col-span-4"},Ke={class:"relative z-0 inline-flex rounded-md shadow-sm -space-x-px","aria-label":"Pagination"},Qe=["href"],We={key:0},Xe={layout:(f,x)=>f(L,()=>child),layout:L},it=Object.assign(Xe,{__name:"Products",props:["products","dimensions"],setup(f){const x=f;var R=[{title:"Accueil",link:"/",icon:te,active:!1},{title:"Commandes Entrep\xF4t",link:"/order_entrepot/gamme",icon:ne,active:!1},{title:"Gammes",link:"/order_entrepot/gamme",icon:"",active:!0}];const j=new URL("/build/assets/Template_Vierge_Com.b1659618.xlsx",self.location).href,V=new URL("/build/assets/Template_Model_Com.8eb69b5c.xlsx",self.location).href;var c=b(x.products);let u=b(!1);var N=b(F().props.value.session.typeVente),_=G({fileImport:null}),I=o=>{o.target.value==""?(document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),u.value=!1):(document.getElementById("file_name_client").innerText=o.target.files[0].name,document.getElementById("file_name_span_client").classList.remove("hidden"),u.value=!0)},P=()=>{document.getElementById("file_import_cart").value=null,document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),u.value=!1};const S=()=>{_.post("/order_entrepot/panier/import",{onError:o=>{Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'importation de votre fichier, veuillez v\xE9rifier que votre fichier correspond bien \xE0 l'exemple fourni puis ressayer !"})}})},h=o=>HtmlEntities.decode(o.toLowerCase()),$=o=>x.dimensions.filter(({id_gamme:r})=>r===o);var d={previous:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",previous_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",next:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",next_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",number:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50",number_active:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 bg-gray-100"},B=()=>{const o=new URL(window.location.href);var r=document.getElementById("per_page");o.searchParams.set("perPage",r.value),window.location.href=o.href},M=()=>{const o=new URL(window.location.href);return o.searchParams.get("perPage")!=null?o.searchParams.get("perPage"):12},C=o=>{var r="/order_entrepot/gamme?filter[nom_gamme]="+o.target.value;D.post(encodeURI(r)).then(s=>{if(s.status==200){const i=new URL(window.location.href);i.searchParams.set("filter[nom_gamme]",o.target.value),c.value=s.data.products,window.history.replaceState("","",i.href)}})},E=()=>{Swal.fire({title:"Attention",text:"\xCAtes-vous de vouloir vider votre panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(o=>{o.isConfirmed&&J.Inertia.post("/cart/empty",{},{preserveScroll:!0,onSuccess:r=>{console.log(r),r.props.session.status?Toast.fire({icon:"success",title:"Le panier a bien \xE9t\xE9 vider !"}):Toast.fire({icon:"error",title:"Une erreur est survenue, pour vider votre panier, vous pouvez aussi vous d\xE9connecter et vous reconnecter."})}})})};return H(()=>{var o=document.getElementById("per_page");o.value=M();const r=new URL(window.location.href);var s=document.getElementById("searchGamme");s.value=r.searchParams.get("filter[nom_gamme]")}),(o,r)=>(n(),a(g,null,[m(t(O),{title:"Produits"}),e("section",ae,[m(ee,{links:t(R)},null,8,["links"]),e("div",ie,[le,t(N)==1?(n(),a("div",ce,[e("div",me,[e("form",{id:"fileCartImport",class:"grid grid-cols-4 max-w-[21rem]",onSubmit:A(S,["prevent"])},[e("div",{class:y(["relative lg:mx-2 mx-1 flex flex-col max-w-sm",t(u)?"col-span-3":" col-span-4"])},[e("label",pe,[w("Importer fichier de commandes "),m(K)]),e("span",ue,[e("button",{type:"button",onClick:r[0]||(r[0]=(...s)=>t(P)&&t(P)(...s))},[m(Z)]),_e]),e("input",{onInput:r[1]||(r[1]=s=>t(_).fileImport=s.target.files[0]),onChange:r[2]||(r[2]=(...s)=>t(I)&&t(I)(...s)),type:"file",class:"hidden",id:"file_import_cart",accept:"application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",name:"fileImport"},null,32),e("span",ge,[e("a",{href:t(j),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Template vierge",8,fe),w(" / "),e("a",{href:t(V),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Mod\xE8le",8,xe)]),m(re,{class:"mt-2",message:t(_).errors.fileImport},null,8,["message"])],2),t(u)?(n(),a("div",he,[e("button",{class:y([{"opacity-25":t(_).processing},"px-2 py-2 rounded-xl text-sm text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300"]),disabled:t(_).processing,type:"submit"},"Importer !",10,ve)])):p("",!0)],40,de)])])):p("",!0)]),e("div",be,[e("div",ye,[e("input",{class:"block w-full pl-9 text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300",placeholder:"Recherche...",id:"searchGamme",type:"text",name:"global",onInput:r[3]||(r[3]=(...s)=>t(C)&&t(C)(...s))},null,32),e("div",we,[m(Q,{class:"text-xl mb-1"})])]),e("div",ke,[e("button",{type:"button",onClick:r[4]||(r[4]=(...s)=>t(E)&&t(E)(...s)),class:"sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[m(t(oe),{class:"w-5 h-5 mr-2"}),w("Vider mon panier")])])]),e("div",Ie,[(n(!0),a(g,null,k(t(c).data,(s,i)=>(n(),a("a",{key:i,href:"/order_entrepot/gamme/"+h(s.nom_gamme),class:"z-30 lg:col-span-1 col-span-2 group p-4 hover:scale-110 transition-full duration-300 cursor-pointer"},[e("div",Be,[s.img_gamme!=null?(n(),a("div",Ce,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/gamme/"+s.img_gamme,alt:s.nom_gamme,class:"z-20 rounded relative w-full h-full object-cover"},null,8,Ee)])):(n(),a("div",Te,ze)),e("div",Le,[e("div",Re,[e("span",null,"Tapis "+l(s.type_tapis==0?"int\xE9rieur":s.type_tapis==1?"ext\xE9rieur":"int\xE9rieur / ext\xE9rieur"),1),e("span",null,"Poils "+l(s.type_poils==1?"courts":"longs")+" - "+l(s.uv_proof==1?"R\xE9sistants aux UV":"Non R\xE9sistants aux UV"),1),e("span",je,l(h(s.nom_special)),1),e("div",Ve,[(n(!0),a(g,null,k($(s.id_gamme),(T,v)=>(n(),a("span",{key:v,class:"block text-center w-auto lg:px-1"},l(!Number.isInteger(v/3)&&v!=0?" - ":"")+" "+l(T.largeur)+"x"+l(T.longueur)+"cm ",1))),128))]),s.prix_piece?(n(),a("span",Ne,"Prix HT \xE0 la pi\xE8ce")):(n(),a("span",Se,"Prix HT m\xB2 : "+l(s.prix_vente_ht_m2_remise?s.prix_vente_ht_m2_remise:s.prix_vente_ht_m2)+" \u20AC",1))])])]),e("div",$e,[e("h2",Me,"Collection "+l(h(s.nom_gamme)),1),m(t(se),{placement:"right",triggers:["hover","focus","click"]},{popper:U(()=>[Ge]),default:U(()=>[e("div",null,[s.nom_trame!=null&&s.nom_trame!=""?(n(),a("a",{key:0,href:"https://gestion.tapis-nazar.fr/xls/trame/"+s.nom_trame,class:"ml-2 flex items-center justify-center",download:""},[m(t(W),{class:"rounded-full border border-black p-0.5 w-5 h-5 mr-2"})],8,Fe)):p("",!0)])]),_:2},1024)])],8,Pe))),128))]),e("div",He,[e("div",Ae,[e("select",{id:"per_page",name:"per_page",dusk:"per-page-full",onChange:r[5]||(r[5]=(...s)=>t(B)&&t(B)(...s)),class:"xl:mr-5 mr-2 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"},qe,32),e("span",null,"Page "+l(t(c).current_page)+" sur "+l(t(c).last_page),1)]),e("span",De,l(t(c).total)+" R\xE9sultats",1),e("div",Je,[e("nav",Ke,[(n(!0),a(g,null,k(t(c).links,(s,i)=>(n(),a("a",{key:i,class:y(i!=0&&i+1!=t(c).links.length?s.active?t(d).number_active:t(d).number:i==0?t(c).current_page==1?t(d).previous_disabled:t(d).previous:t(c).current_page==t(c).last_page?t(d).next_disabled:t(d).next),href:s.url},[i!=0&&i+1!=t(c).links.length?(n(),a("span",We,l(s.label),1)):p("",!0),i+1==t(c).links.length?(n(),z(X,{key:1})):p("",!0),i==0?(n(),z(Y,{key:2})):p("",!0)],10,Qe))),128))])])])])],64))}});export{it as default};