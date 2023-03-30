import{z as k,P as M,o as r,a as c,d as o,u as a,f as e,t as l,k as u,F as T,K as N,e as _,i as z,w as f,p as h,h as B,H as U,n as x,M as j}from"./app.4fc3d25a.js";import{_ as C}from"./AuthenticatedLayout.e3e60cf1.js";import{_ as $}from"./EtapeOrder.13a034e5.js";import{y as A,O as I,g as P,h as V,r as q,a as E,b as L,_ as O,c as S}from"./BouttonPaiement.4b8cfd6e.js";import"./LangueChoice.88b632ba.js";import"./label.0a34e9c4.js";import"./description.c68df103.js";const D={class:"container mx-auto mt-5"},K={class:"grid grid-cols-4"},Q={class:"xl:col-span-1 col-span-4"},R={class:"xl:col-span-3 col-span-4"},G=e("h1",{class:"text-center text-3xl text-primary-300"},"Finalisation de la commande",-1),J={class:"m-5"},W={class:"grid grid-cols-2"},X={class:"bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4"},Y=e("h2",{class:"text-center font-bold"},"Adresse de livraison",-1),Z={key:0},ee={key:1},se={class:"bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4"},te=e("h2",{class:"text-center font-bold"},"Adresse de facturation",-1),ae={key:0},le={key:1},ne={class:"bg-primary-50 rounded m-2 p-4"},oe=e("h2",{class:"text-center font-bold"},"Total Commande",-1),ie={class:"grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6"},re={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ce={class:"font-semibold text-gray-600"},de=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),me={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ue={class:"font-semibold text-gray-600"},_e=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),pe={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},xe={lass:"font-semibold text-gray-600"},fe=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),he={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ge={lass:"font-semibold text-gray-600"},ye=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),ve={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},be={lass:"font-semibold text-gray-600"},we={class:"grid grid-cols-1 flex items-center justify-center my-4 mx-2"},ke=e("h2",{class:"px-5 py-3 bg-primary-50 rounded font-bold text-center"},"Produits",-1),Te={key:0,class:"grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50 xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen overflow-auto"},Be={class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},je={class:"xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center"},Ce={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},Pe=["src","alt"],Ve={key:1},Ee=e("span",null,"Pas de photo pour ce produit !",-1),Fe=[Ee],He={class:"xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm"},Me={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ne={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},ze={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ue={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},$e={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ae={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ie={class:"bg-gray-100 rounded-b-lg"},qe=e("div",{class:"text-center bg-primary-50 rounded-t-lg py-1"},[e("h2",{class:"text-lg font-bold"},"Moyen de paiement")],-1),Le={class:"mx-auto w-full my-2"},Oe={class:"flex sm:flex-row flex-col w-full sm:justify-evenly justify-center items-center"},Se={class:"flex w-full items-center justify-between"},De={class:"flex items-center"},Ke={class:"text-sm"},Qe=e("span",{class:"ml-2"}," Carte Bancaire",-1),Re={class:"shrink-0 text-white"},Ge={class:"flex w-full items-center justify-between"},Je={class:"flex items-center"},We={class:"text-sm"},Xe=e("span",{class:"ml-2"}," Virement Bancaire",-1),Ye={class:"shrink-0 text-white"},Ze={class:"py-2"},es={id:"paymentCB",class:"flex items-center justify-center mb-5"},ss={key:0,class:"flex justify-center mb-5"},ts=["disabled"],as={layout:(p,t)=>p(C,()=>child),layout:C},ms=Object.assign(as,{__name:"Validation",props:["client","panier","produits"],setup(p){const t=p;var g=k(M().props.value.auth.user[0].client),F=["Panier","Adresse Livraison / Facturation","Finaliser commande"];const y=(m,n)=>m.toFixed(n);var d=k(0),v=()=>{j.post("/cart/adresses/validation/order",{paymentType:d.value}).then(m=>{m.status==200?document.location.href="/shippings/order/clients/"+m.data.num_commande:Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre commande, veuillez ressayer !"})})},H=m=>(Math.round(m*100)/100).toFixed(2),b=m=>{var n=m;return g.value.taux_remise>0&&(n=n-n*(g.value.taux_remise/100)),H(n)},w=(m,n)=>{n==2&&document.getElementById("paymentCB").getElementsByTagName("form").length===0&&j.post("/cart/payment/cb",{paymentType:d.value}).then(s=>{if(s.status==200)if(s.data.statut){var i=document.getElementById("bouttonPaiement");document.getElementById("paymentCB").innerHTML=s.data.formpay,document.getElementById("submitPayButton").appendChild(i)}else Toast.fire({icon:"error",title:s.data.msg});else Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la g\xE9n\xE9ration du formulaire de paiement, veuillez ressayer !"})})};return(m,n)=>(r(),c(T,null,[o(a(U),{title:"Validation - Panier"}),e("section",D,[e("div",K,[e("div",Q,[o($,{etape:3,nbEtape:3,listeEtape:a(F)},null,8,["listeEtape"])]),e("div",R,[G,e("div",J,[e("div",W,[e("div",X,[Y,e("span",null,l(t.client.nom_adresse)+",",1),e("span",null,l(t.client.adresse1)+",",1),t.client.adresse2!=""&&t.client.adresse2!=null?(r(),c("span",Z,l(t.client.adresse2)+",",1)):u("",!0),t.client.adresse3!=""&&t.client.adresse3!=null?(r(),c("span",ee,l(t.client.adresse3)+",",1)):u("",!0),e("span",null,l(t.client.code_postal+", "+t.client.ville)+",",1),e("span",null,l(t.client.pays),1)]),e("div",se,[te,e("span",null,l(t.client.nom_adresse_facturation)+",",1),e("span",null,l(t.client.adresse1_facturation)+",",1),t.client.adresse2_facturation!=""&&t.client.adresse2_facturation!=null?(r(),c("span",ae,l(t.client.adresse2_facturation)+",",1)):u("",!0),t.client.adresse3_facturation!=""&&t.client.adresse3_facturation!=null?(r(),c("span",le,l(t.client.adresse3_facturation)+",",1)):u("",!0),e("span",null,l(t.client.code_postal_facturation+", "+t.client.ville_facturation)+",",1),e("span",null,l(t.client.pays_facturation),1)])]),e("div",ne,[oe,e("div",ie,[e("div",re,[e("span",ce,"Quantiter : "+l(t.panier.produits_total)+" pcs",1),de]),e("div",me,[e("span",ue,"M\xB2 : "+l(t.panier.total_m2)+" m\xB2",1),_e]),e("div",pe,[e("span",xe,"Prix HT : "+l(t.panier.total_HT)+" \u20AC",1),fe]),e("div",he,[e("span",ge,"Prix TVA : "+l(t.panier.total_taxe)+" \u20AC",1),ye]),e("div",ve,[e("span",be,"Prix TTC : "+l(t.panier.total_ttc)+" \u20AC",1)])])]),e("div",we,[ke,p.produits!=null?(r(),c("div",Te,[(r(!0),c(T,null,N(t.produits.panier,(s,i)=>(r(),c("div",{key:i,class:"2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2"},[e("div",Be,[e("div",je,[s.photo!=null?(r(),c("div",Ce,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+s.photo.img_produit,alt:s.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,Pe)])):(r(),c("div",Ve,Fe))]),e("div",He,[e("span",Me,"SKU : "+l(s.code_sku),1),e("span",Ne,"Taille : "+l(s.dimension.largeur+"x"+s.dimension.longueur),1),e("span",ze,"Prix du M\xB2 : "+l(a(b)(s.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",Ue,"M\xB2 : "+l(y(s.dimension.largeur/100*(s.dimension.longueur/100)*s.panier.quantiter,2))+" m\xB2",1),e("span",$e,"Quantiter : "+l(s.panier.quantiter),1),e("span",Ae,"Prix HT : "+l(y(s.dimension.largeur/100*(s.dimension.longueur/100)*s.panier.quantiter*a(b)(s.gamme.prix_vente_ht_m2),2))+" \u20AC",1)])])]))),128))])):u("",!0)]),e("div",Ie,[qe,e("div",Le,[o(a(A),{modelValue:a(d),"onUpdate:modelValue":n[2]||(n[2]=s=>z(d)?d.value=s:d=s)},{default:_(()=>[o(a(I),{class:"sr-only"},{default:_(()=>[B("Type de paiement")]),_:1}),e("div",Oe,[o(a(P),{as:"template",value:"2",onClick:n[0]||(n[0]=s=>a(w)(s,2))},{default:_(({active:s,checked:i})=>[e("div",{class:x([[s?"ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300":"",i?"bg-blue-900 bg-opacity-75 text-white ":"bg-white "],"relative sm:my-0 my-2 mx-2 w-full sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"])},[e("div",Se,[e("div",De,[e("div",Ke,[o(a(V),{as:"span",class:x([i?"text-blue-100":"text-gray-500","inline flex items-center"])},{default:_(()=>[o(a(q),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"}),Qe]),_:2},1032,["class"])])]),f(e("div",Re,[o(a(E),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"})],512),[[h,i]])])],2)]),_:1}),o(a(P),{as:"template",value:"1",onClick:n[1]||(n[1]=s=>a(w)(s,1))},{default:_(({active:s,checked:i})=>[e("div",{class:x([[s?"ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300":"",i?"bg-blue-900 bg-opacity-75 text-white ":"bg-white "],"relative w-full sm:my-0 my-2 mx-2 sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"])},[e("div",Ge,[e("div",Je,[e("div",We,[o(a(V),{as:"span",class:x([i?"text-blue-100":"text-gray-500","inline flex items-center"])},{default:_(()=>[o(a(L),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"}),Xe]),_:2},1032,["class"])])]),f(e("div",Ye,[o(a(E),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"})],512),[[h,i]])])],2)]),_:1})])]),_:1},8,["modelValue"])]),e("div",Ze,[f(e("div",es,[o(O,{id:"bouttonPaiement"})],512),[[h,a(d)==2]]),a(d)==1||a(d)==0?(r(),c("div",ss,[e("button",{disabled:a(d)==0,onClick:n[3]||(n[3]=(...s)=>a(v)&&a(v)(...s)),type:"button",class:"py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},[B("Finaliser la commande "),o(a(S),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})],8,ts)])):u("",!0)])])])])])])],64))}});export{ms as default};
