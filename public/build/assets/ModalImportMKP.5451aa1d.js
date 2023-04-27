import{o,a as n,f as e,t as l,k as h,m as z,A as T,K as k,e as d,d as p,u as s,h as x,F as C,J as $,n as M,U as B,S as A}from"./app.fe5102d3.js";import{_ as E}from"./_plugin-vue_export-helper.cdc0426e.js";import{C as H}from"./AuthenticatedLayout.d6ad7e45.js";import{o as w,f as P}from"./transition.add7e9d3.js";import{_ as V,U as I,N as j}from"./dialog.f0874ba2.js";const K={name:"AlertIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},N=["aria-hidden","aria-label"],F=["fill","width","height"],S={d:"M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z"},O={key:0};function q(_,t,c,f,r,v){return o(),n("span",z(_.$attrs,{"aria-hidden":!c.title,"aria-label":c.title,class:"material-design-icon alert-icon",role:"img",onClick:t[0]||(t[0]=u=>_.$emit("click",u))}),[(o(),n("svg",{fill:c.fillColor,class:"material-design-icon__svg",width:c.size,height:c.size,viewBox:"0 0 24 24"},[e("path",S,[c.title?(o(),n("title",O,l(c.title),1)):h("",!0)])],8,F))],16,N)}const U=E(K,[["render",q]]);const Q=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),D={class:"fixed inset-0 overflow-y-auto"},L={class:"flex min-h-full items-center justify-center p-4 text-center relative"},J={class:"grid grid-cols-10 ml-5 bg-primary-50 rounded-lg p-4 mb-4"},R={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},Z={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},G={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},W={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},X={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},Y={class:"groupProduit relative w-full flex items-center justify-center"},ee={class:"z-10 absolute xl:bottom-28 bottom-28 imageProduit"},te={key:0,class:"lg:w-[100px] lg:h-[150px] sm:w-[100px] sm:h-[150px] w-[80px] h-[120px]"},se=["src","alt"],le={key:1,class:"lg:w-[100px] lg:h-[150px] sm:w-[100px] sm:h-[100px] w-[80px] h-[100px]"},oe=e("span",null,"Pas de photo pour ce produit !",-1),ie=[oe],ne={class:"z-20 sm:w-80 w-72 absolute bottom-0 text-center bg-white rounded drop-shadow-xl flex flex-col py-2"},ae={class:"flex flex-col px-10"},re={class:"flex justify-center items-center py-2 w-full"},ce={key:0,class:"flex items-center justify-center mr-2"},de=e("span",{class:"bg-red-700 w-[10px] h-[10px] block rounded-full mx-2"},null,-1),pe={class:"flex flex-col"},ue={key:1,class:"flex items-center justify-center"},_e=e("span",null,"Il n'y a pas de produit pour ce client !",-1),me=[_e],xe={__name:"ModalImportMKP_client",props:["isOpen","client"],setup(_){const t=_,c=T(t.isOpen);function f(){c.value=!1,setTimeout(()=>{document.getElementById("productClientView").__vue_app__.unmount()},200)}console.log(t.client);var r={grid4:"grid-cols-4",grid3:"grid-cols-3",grid2:"grid-cols-2",grid1:"grid-cols-1"},v=()=>t.client.products.length==4?r.grid4:t.client.products.length==3?r.grid3:t.client.products.length==2?r.grid2:t.client.products.length==1?r.grid1:r.grid4,u=g=>(Math.round(g*100)/100).toFixed(2);return(g,y)=>(o(),k(s(P),{appear:"",show:c.value,as:"template"},{default:d(()=>[p(s(j),{as:"div",onClose:f,class:"relative z-[110]"},{default:d(()=>[p(s(w),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0"},{default:d(()=>[Q]),_:1}),e("div",D,[e("div",L,[p(s(w),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95"},{default:d(()=>[p(s(V),{class:"w-full max-w-6xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"},{default:d(()=>[p(s(I),{as:"h3",class:"sm:text-xl text-lg font-bold leading-6 text-gray-900"},{default:d(()=>[x(" D\xE9tail client : "+l(t.client.nom+" "+t.client.prenom),1)]),_:1}),e("div",null,[e("button",{onClick:f,type:"button",class:"absolute top-5 right-10"},[p(H)])]),e("div",J,[e("span",R,"Quantiter : "+l(t.client.products_tt),1),e("span",Z,"M\xB2 : "+l(t.client.m2_tt)+" m\xB2",1),e("span",G,"Prix HT : "+l(s(u)(t.client.prix_ht_tt))+" \u20AC",1),e("span",W,"Prix TVA : "+l(s(u)(t.client.prix_tva_tt))+" \u20AC",1),e("span",X,"Prix TTC : "+l(s(u)(t.client.prix_ttc_tt))+" \u20AC",1)]),t.client.products.length!=0?(o(),n("div",{key:0,class:M("overflow-auto lg:max-h-[50vh] max-h-[45vh] grid "+(t.client.products.length>4?s(r).grid4:s(v)()))},[(o(!0),n(C,null,$(t.client.products,(i,m)=>(o(),n("div",{class:"relative flex justify-center lg:col-span-1 col-span-4 h-80 w-full py-4 px-4",key:m},[e("div",Y,[e("div",ee,[i.url_image!=null?(o(),n("div",te,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+i.url_image,alt:i.sku,class:"w-full h-full object-cover"},null,8,se)])):(o(),n("div",le,ie))]),e("div",ne,[e("div",ae,[e("span",null,l(i.gamme),1),e("span",null,l(i.design),1),e("span",null,l(i.taille),1)]),e("div",re,[i.stock<=i.qte?(o(),n("span",ce,[x("Erreur Stock"),de,x(" | ")])):h("",!0),e("div",pe,[e("span",null,"Quantiter : "+l(i.qte),1),e("span",null,"Prix TTC Unitaire : "+l(s(u)(i.prix_TTC_unitaire))+" \u20AC",1)])])])])]))),128))],2)):(o(),n("div",ue,me))]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"]))}};const fe=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),ge={class:"fixed inset-0 overflow-y-auto"},he={class:"flex min-h-full items-center justify-center p-4 text-center"},ve={class:"mt-2"},ye={class:"text-sm text-gray-500"},we={key:0,class:"bg-yellow-100 rounded-lg text-center p-2"},be={class:"text-yellow-500"},Te={class:"grid grid-cols-10 xl:ml-5 bg-primary-50 rounded-lg p-4 mb-4 mt-4"},ke={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},Ce={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},$e={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},Me={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},Pe={class:"xl:col-span-2 sm:col-span-5 col-span-12 text-center"},Ve={key:0,class:"relative rounded-lg box w-full relative"},Ie={class:"rotate-front rounded-lg flex flex-col p-4 overflow-hidden"},je={key:0,class:"z-10 absolute top-2 right-2 flex flex-col"},ze=e("span",{class:"flex items-center justify-center"},[x("Erreur Stock "),e("span",{class:"bg-red-700 w-[10px] h-[10px] block rounded-full ml-2"})],-1),Be=[ze],Ae={class:"rotate-back rounded-lg py-4 px-4 flex justify-center items-center"},Ee=["onClick"],He={key:1,class:"cols-span-1"},Ke={class:"w-full py-2 bg-white flex items-center justify-center"},Qe={__name:"ModalImportMKP",props:["isOpen","importMKP","reussi","erreur","qteFinal","m2Final","prixHT_TT","prixTVA_TT","prixTTC_TT","stockInvalide"],setup(_){const t=_,c=T(t.isOpen);function f(){c.value=!1}var r={grid4:"grid-cols-4",grid3:"grid-cols-3",grid2:"grid-cols-2",grid1:"grid-cols-1"},v=()=>{if(t.reussi==4)return r.grid4;if(t.reussi==3)return r.grid3;if(t.reussi==2)return r.grid2;if(t.reussi==1)return r.grid1},u=i=>{document.getElementById("productClientView")!=null&&document.getElementById("productClientView").__vue_app__!=null&&document.getElementById("productClientView").__vue_app__.unmount();var m=B(xe,{isOpen:!0,client:t.importMKP[i]});m.mount(document.getElementById("productClientView"))},g=()=>{A.post("/dropshipping/clients/import/validation",{clients:t.importMKP}).then(i=>{i.status?document.location.href="/dropshipping/gamme":Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la validation de l'importation, veuillez renouveller l'op\xE9ration !"})})},y=i=>(Math.round(i*100)/100).toFixed(2);return(i,m)=>(o(),k(s(P),{appear:"",show:c.value,as:"template"},{default:d(()=>[p(s(j),{as:"div",onClose:f,class:"relative z-[100]"},{default:d(()=>[p(s(w),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0"},{default:d(()=>[fe]),_:1}),e("div",ge,[e("div",he,[p(s(w),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95"},{default:d(()=>[p(s(V),{class:"w-full max-w-5xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all relative"},{default:d(()=>[p(s(I),{as:"h3",class:"sm:text-xl text-lg font-medium leading-6 text-gray-900"},{default:d(()=>[x(" R\xE9sumer de l'importation ")]),_:1}),e("div",ve,[e("p",ye," Status de l'importation : "+l(t.erreur>0?"echec !":"r\xE9ussi !"),1)]),t.stockInvalide?(o(),n("div",we,[e("span",be,[p(U),x(" Vous avez une ou des commandes qui contienne des produits avec un stock insuffisant, ces commandes ne pourront \xEAtre valid\xE9es.")])])):h("",!0),e("div",Te,[e("span",ke,"Quantiter : "+l(t.qteFinal),1),e("span",Ce,"M\xB2 : "+l(t.m2Final)+" m\xB2",1),e("span",$e,"Prix HT : "+l(s(y)(t.prixHT_TT))+" \u20AC",1),e("span",Me,"Prix TVA : "+l(s(y)(t.prixTVA_TT))+" \u20AC",1),e("span",Pe,"Prix TTC : "+l(s(y)(t.prixTTC_TT))+" \u20AC",1)]),e("div",{class:M("overflow-auto max-h-[50vh] grid "+(t.erreur==0?t.reussi>4?s(r).grid4:s(v)():s(r).grid1))},[(o(!0),n(C,null,$(t.importMKP,(a,b)=>(o(),n("div",{class:"relative flex justify-center lg:col-span-1 col-span-4 py-4 px-4",key:b},[t.erreur==0&&a.status?(o(),n("div",Ve,[e("div",Ie,[a.clientProduitStockInvalide?(o(),n("div",je,Be)):h("",!0),e("span",null,"Client : "+l(a.prenom+" "+a.nom),1),e("span",null,"Adresse: "+l(a.adresse_livraison.adresse1),1),e("span",null,l(a.adresse_livraison.code_postal+", "+a.adresse_livraison.ville),1),e("span",null,l(a.adresse_livraison.pays),1),e("span",null,"Quantiter : "+l(a.products_tt),1),e("span",null,"M\xB2 total : "+l(a.m2_tt)+" m\xB2",1),e("span",null,"Prix TTC Total : "+l(a.prix_ttc_tt)+" \u20AC",1)]),e("div",Ae,[e("button",{type:"button",class:"bg-primary-100 hover:bg-primary-200 transition duration-300 p-2 rounded-lg",onClick:Ne=>s(u)(b)},"Voir plus",8,Ee)])])):a.status?h("",!0):(o(),n("div",He,[e("span",null,"Erreur : "+l(a.message),1)]))]))),128))],2),e("div",Ke,[e("button",{onClick:m[0]||(m[0]=(...a)=>s(g)&&s(g)(...a)),class:"py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},"Valider l'importation")])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"]))}};export{Qe as _};
