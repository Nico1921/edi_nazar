import{z as p,P as L,A,o,a as c,d as g,u as t,f as e,j as G,n as U,h as R,k as u,F as _,K as b,t as l,H as X,Q as k,O as D,M as z}from"./app.8c3dbf91.js";import{_ as C,C as O,R as q}from"./AuthenticatedLayout.34de6b41.js";import{S as K,L as Q}from"./Magnify.fd2e68dc.js";import{E as $}from"./MicrosoftExcel.47d618a4.js";import"./LangueChoice.afc02887.js";const J={class:"container mx-auto mt-5"},W=e("h1",{class:"font-semibold mx-1 lg:text-2xl text-lg text-gray-800 py-2"},"Produits",-1),Y={key:0,class:"bg-primary-50 rounded xl:mx-40 mb-5"},Z=e("h2",{class:"text-center lg:text-xl text-lg text-primary-300 py-1 bg-primary-100 rounded-t-lg"},"Ajouter au panier via un fichier",-1),ee={class:"p-4 flex flex-col items-center justify-items-center justify-center"},te=["onSubmit"],se={class:"block lg:text-lg text-sm cursor-pointer text-primary-500 bg-primary-200 p-3 rounded-lg",for:"file_import_cart"},re={class:"hidden",id:"file_name_span_client"},ae=e("span",{id:"file_name_client"},null,-1),oe=e("p",{class:"mt-1 text-sm text-gray-500",id:"file_input_helper"},".XLS,.XLSX",-1),ne={class:"absolute bottom-0 right-0"},le=["href"],ie=["href"],ce={key:0,class:"col-span-1"},de=e("button",{type:"submit",class:"p-3 rounded-lg lg:text-lg text-sm text-primary-500 bg-primary-100 hover:bg-primary-200 transition duration-300"},"Importer !",-1),me=[de],pe={class:"mx-1 flex flex-row w-auto sm:flex-grow order-1 sm:order-2 mb-2 sm:mb-0"},ue={class:"relative flex-grow"},ge={class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"},_e={class:"grid grid-cols-4",id:"gammes"},fe=["href"],xe={class:"relative group z-20"},he={key:0,class:"relative w-full lg:h-60 sm:h-52 h-40 z-20"},ve=["src","alt"],be={key:1,class:"relative w-full h-60"},ye=e("span",null,"Pas de photo pour cette gamme !",-1),we=[ye],Ie={class:"absolute bottom-0 z-30 w-full overflow-hidden text-sm"},Pe={class:"max-h-0 group-hover:max-h-60 rounded group-hover:p-1 transition-full duration-500 bg-primary-100 text-center flex flex-col sm:bg-opacity-70 text-white z-30"},Ee={class:"capitalize"},Be={class:"flex flex-wrap items-center justify-center text-center lg:px-4 px-0 py-2"},Le={class:"capitalize text-center font-semibold"},Ue={class:"grid grid-cols-4 justify-center items-center bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 xl:px-6"},Re={class:"lg:col-span-1 sm:col-span-2 col-span-4 sm:text-start text-center"},ke=D('<option value="8">8 par page</option><option value="12">12 par page</option><option value="18">18 par page</option><option value="50">50 par page</option><option value="100">100 par page</option>',5),ze=[ke],Ce={class:"lg:col-span-2 sm:col-span-2 col-span-4 lg:text-center sm:text-end text-center sm:my-0 my-2"},je={class:"flex lg:justify-end justify-center lg:col-span-1 col-span-4"},Te={class:"relative z-0 inline-flex rounded-md shadow-sm -space-x-px","aria-label":"Pagination"},Ve=["href"],Ne={key:0},Se={layout:(f,x)=>f(C,()=>child),layout:C},Xe=Object.assign(Se,{__name:"Products",props:["products","dimensions"],setup(f){const x=f,j=new URL("/build/assets/Template_Vierge_Com.e9d70c87.xlsx",self.location).href,T=new URL("/build/assets/Template_Model_Com.4738a9ce.xlsx",self.location).href;p(!1);var i=p(x.products),y=p(L().props.value.auth.user[0].client);let m=p(!1);var V=p(L().props.value.session.typeVente),w=r=>{r.target.value==""?(document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),m.value=!1):(document.getElementById("file_name_client").innerText=r.target.files[0].name,document.getElementById("file_name_span_client").classList.remove("hidden"),m.value=!0)},I=()=>{document.getElementById("file_import_cart").value=null,document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),m.value=!1};const N=()=>{var r=new FormData(document.getElementById("fileCartImport"));z.post("/order_entrepot/panier/import",r).then(a=>{console.log(a),a.status?document.location.href="/cart":Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'importation de votre fichier, veuillez v\xE9rifier que votre fichier correspond bien \xE0 l'exemple fournis puis ressayer !"})})},h=r=>HtmlEntities.decode(r.toLowerCase()),S=r=>x.dimensions.filter(({id_gamme:a})=>a===r);var d={previous:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",previous_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium",next:"text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",next_disabled:"cursor-not-allowed text-gray-400 relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium",number:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50",number_active:"relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 bg-gray-100"},P=()=>{const r=new URL(window.location.href);var a=document.getElementById("per_page");r.searchParams.set("perPage",a.value),window.location.href=r.href},M=()=>{const r=new URL(window.location.href);return r.searchParams.get("perPage")!=null?r.searchParams.get("perPage"):12},E=r=>{var a="/order_entrepot/gamme?filter[nom_gamme]="+r.target.value;z.post(encodeURI(a)).then(s=>{if(s.status==200){const n=new URL(window.location.href);n.searchParams.set("filter[nom_gamme]",r.target.value),i.value=s.data.products,window.history.replaceState("","",n.href)}})},F=r=>(Math.round(r*100)/100).toFixed(2),H=r=>{var a=r;return y.value.taux_remise>0&&(a=a-a*(y.value.taux_remise/100)),F(a)};return A(()=>{var r=document.getElementById("per_page");r.value=M();const a=new URL(window.location.href);var s=document.getElementById("searchGamme");s.value=a.searchParams.get("filter[nom_gamme]")}),(r,a)=>(o(),c(_,null,[g(t(X),{title:"Products"}),e("section",J,[W,t(V)==1?(o(),c("div",Y,[Z,e("div",ee,[e("form",{id:"fileCartImport",class:"grid grid-cols-4",onSubmit:G(N,["prevent"])},[e("div",{class:U(t(m)?"relative col-span-3 lg:mx-2 mx-1":"relative col-span-4 lg:mx-2 mx-1")},[e("label",se,[R("Importer fichier de commandes "),g($)]),e("span",re,[e("button",{type:"button",onClick:a[0]||(a[0]=(...s)=>t(I)&&t(I)(...s))},[g(O)]),ae]),e("input",{onChange:a[1]||(a[1]=(...s)=>t(w)&&t(w)(...s)),type:"file",class:"hidden",id:"file_import_cart",accept:"application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",name:"fileImport"},null,32),oe,e("span",ne,[e("a",{href:t(j),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Template vierge",8,le),R(" / "),e("a",{href:t(T),class:"mt-1 text-sm text-blue-400 hover:text-blue-300 transition duration-300"},"Mod\xE8le",8,ie)])],2),t(m)?(o(),c("div",ce,me)):u("",!0)],40,te)])])):u("",!0),e("div",pe,[e("div",ue,[e("input",{class:"block w-full pl-9 text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300",placeholder:"Recherche...",id:"searchGamme",type:"text",name:"global",onInput:a[2]||(a[2]=(...s)=>t(E)&&t(E)(...s))},null,32),e("div",ge,[g(K,{class:"text-xl mb-1"})])])]),e("div",_e,[(o(!0),c(_,null,b(t(i).data,(s,n)=>(o(),c("a",{key:n,href:"/order_entrepot/gamme/"+h(s.nom_gamme),class:"z-30 lg:col-span-1 col-span-2 group p-4 hover:scale-110 transition-full duration-300 cursor-pointer"},[e("div",xe,[s.img_gamme!=null?(o(),c("div",he,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/gamme/"+s.img_gamme,alt:s.nom_gamme,class:"z-20 rounded relative w-full h-full object-cover"},null,8,ve)])):(o(),c("div",be,we)),e("div",Ie,[e("div",Pe,[e("span",null,"Tapis "+l(s.type_tapis==0?"int\xE9rieur":s.type_tapis==1?"ext\xE9rieur":"int\xE9rieur / ext\xE9rieur"),1),e("span",null,"Poils "+l(s.type_poils==1?"court":"long")+" - "+l(s.uv_proof==1?"R\xE9sistants aux UV":"Non R\xE9sistants aux UV"),1),e("span",Ee,l(h(s.nom_special)),1),e("div",Be,[(o(!0),c(_,null,b(S(s.id_gamme),(B,v)=>(o(),c("span",{key:v,class:"block text-center w-auto lg:px-1"},l(!Number.isInteger(v/3)&&v!=0?" - ":"")+" "+l(B.largeur)+"x"+l(B.longueur)+"cm ",1))),128))]),e("span",null,"Prix HT m\xB2 : "+l(t(H)(s.prix_vente_ht_m2))+" \u20AC",1)])])]),e("div",null,[e("h2",Le,"Collection "+l(h(s.nom_gamme)),1)])],8,fe))),128))]),e("div",Ue,[e("div",Re,[e("select",{id:"per_page",name:"per_page",dusk:"per-page-full",onChange:a[3]||(a[3]=(...s)=>t(P)&&t(P)(...s)),class:"xl:mr-5 mr-2 focus:ring-indigo-500 focus:border-indigo-500 min-w-max shadow-sm text-sm border-gray-300 rounded-md"},ze,32),e("span",null,"Page "+l(t(i).current_page)+" sur "+l(t(i).last_page),1)]),e("span",Ce,l(t(i).total)+" R\xE9sultats",1),e("div",je,[e("nav",Te,[(o(!0),c(_,null,b(t(i).links,(s,n)=>(o(),c("a",{key:n,class:U(n!=0&&n+1!=t(i).links.length?s.active?t(d).number_active:t(d).number:n==0?t(i).current_page==1?t(d).previous_disabled:t(d).previous:t(i).current_page==t(i).last_page?t(d).next_disabled:t(d).next),href:s.url},[n!=0&&n+1!=t(i).links.length?(o(),c("span",Ne,l(s.label),1)):u("",!0),n+1==t(i).links.length?(o(),k(q,{key:1})):u("",!0),n==0?(o(),k(Q,{key:2})):u("",!0)],10,Ve))),128))])])])])],64))}});export{Xe as default};
