import{A as h,I as $,o as r,a as c,d as n,u as s,f as e,t as l,k as _,F as B,J as z,e as p,i as A,w as g,p as y,h as v,H as I,n as f,S as T}from"./app.fae32ddb.js";import{_ as j,r as M}from"./AuthenticatedLayout.f7b1a3b5.js";import{_ as N}from"./EtapeOrder.5af8c06c.js";import{y as S,_ as U,r as q,O as L,g as V,h as P,a as O,b as E}from"./BouttonPaiement.46faf685.js";import{r as D}from"./ArrowRightCircleIcon.c3951998.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./label.cc79420f.js";import"./description.092ef6cb.js";import"./use-controllable.ff7f07be.js";const J={class:"container mx-auto mt-5"},Q={class:"grid grid-cols-4"},R={class:"col-span-4"},G={class:"col-span-4 xl:mx-16 lg:mx-8"},K=e("h1",{class:"text-center text-3xl text-primary-300"},"Finalisation de la commande",-1),W={class:"m-5"},X={class:"grid grid-cols-2"},Y={class:"bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4"},Z=e("h2",{class:"text-center font-bold"},"Adresse de livraison",-1),ee={key:0},te={key:1},se={class:"bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4"},ae=e("h2",{class:"text-center font-bold"},"Adresse de facturation",-1),le={key:0},ne={key:1},oe={class:"bg-primary-50 rounded m-2 p-4"},ie=e("h2",{class:"text-center font-bold"},"Total Commande",-1),re={class:"grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6"},ce={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},de={class:"font-semibold text-gray-600"},me=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),_e={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},pe={class:"font-semibold text-gray-600"},ue=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),xe={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},fe={lass:"font-semibold text-gray-600"},he=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),ge={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ye={lass:"font-semibold text-gray-600"},ve=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),be={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},we={lass:"font-semibold text-gray-600"},ke={class:"grid grid-cols-1 flex items-center justify-center my-4 mx-2"},Ce=e("h2",{class:"px-5 py-3 bg-primary-50 rounded font-bold text-center"},"Produits",-1),Be={key:0,class:"grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50 xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen overflow-auto"},Te={class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},je={class:"xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center"},Ve={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},Pe=["src","alt"],Ee={key:1},Fe=e("span",null,"Pas de photo pour ce produit !",-1),He=[Fe],$e={class:"xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm"},ze={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ae={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ie={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Me={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ne={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Se={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ue={class:"bg-gray-100 rounded-b-lg"},qe=e("div",{class:"text-center bg-primary-50 rounded-t-lg py-1"},[e("h2",{class:"text-lg font-bold"},"Moyen de paiement")],-1),Le={key:0,class:"bg-yellow-200 px-4 py-2 rounded flex items-center"},Oe=e("span",{class:"pl-2 text-yellow-600"},"Pour continuer, veuillez s\xE9lectionner votre moyen de paiement et accepter les CGV.",-1),De={class:"mx-auto w-full my-4"},Je={class:"flex sm:flex-row flex-col w-full sm:justify-evenly justify-center items-center"},Qe={class:"flex w-full items-center justify-between"},Re={class:"flex items-center"},Ge={class:"text-sm"},Ke=e("span",{class:"ml-2"}," Carte Bancaire",-1),We={class:"shrink-0 text-white"},Xe={class:"flex w-full items-center justify-between"},Ye={class:"flex items-center"},Ze={class:"text-sm"},et=e("span",{class:"ml-2"}," Virement Bancaire",-1),tt={class:"shrink-0 text-white"},st={class:"flex items-center my-6 2xl:mx-28 xl:mx-12 lg:mx-[4.4rem] sm:mx-2 xsm:mx-14 mx-auto max-w-sm"},at=e("label",{for:"checkVenteCondition",class:"ml-2 sm:text-lg text-sm font-medium text-gray-900"},[v("J'accepte les "),e("a",{href:"/cgv",class:"text-gray-400 underline hover:text-[1.15rem] cursor-pointer transition-all duration-300"},"conditions g\xE9n\xE9rales de vente")],-1),lt={class:"py-2"},nt={id:"paymentCB",class:"flex items-center justify-center mb-5"},ot={key:0,class:"flex justify-center mb-5"},it=["disabled"],rt={layout:(x,a)=>x(j,()=>child),layout:j},gt=Object.assign(rt,{__name:"Validation",props:["client","panier","produits"],setup(x){const a=x;console.log(a.produits),h($().props.value.auth.user[0].client);var F=["Panier","Adresse Livraison / Facturation","Finaliser commande"],H=["/cart","/cart/adresses","/cart/validation"];const b=(m,o)=>parseFloat(m).toFixed(o);var u=h(0),i=h(0),w=()=>{T.post("/cart/validation/order",{paymentType:i.value}).then(m=>{m.status==200?document.location.href="/shippings/order/clients/"+m.data.num_commande:Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre commande, veuillez ressayer !"})})},k=(m,o)=>{o==2&&document.getElementById("paymentCB").getElementsByTagName("form").length===0&&T.post("/cart/payment/cb",{paymentType:i.value}).then(t=>{if(t.status==200)if(t.data.statut){var d=document.getElementById("bouttonPaiement");document.getElementById("paymentCB").innerHTML=t.data.formpay,document.getElementById("submitPayButton").appendChild(d)}else Toast.fire({icon:"error",title:t.data.msg});else Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la g\xE9n\xE9ration du formulaire de paiement, veuillez ressayer !"})})},C=m=>{m.target.checked?u.value=!0:u.value=!1};return(m,o)=>(r(),c(B,null,[n(s(I),{title:"Validation - Panier"}),e("section",J,[e("div",Q,[e("div",R,[n(N,{hrefEtape:s(H),etape:3,nbEtape:3,listeEtape:s(F)},null,8,["hrefEtape","listeEtape"])]),e("div",G,[K,e("div",W,[e("div",X,[e("div",Y,[Z,e("span",null,l(a.client.nom_adresse)+",",1),e("span",null,l(a.client.adresse1)+",",1),a.client.adresse2!=""&&a.client.adresse2!=null?(r(),c("span",ee,l(a.client.adresse2)+",",1)):_("",!0),a.client.adresse3!=""&&a.client.adresse3!=null?(r(),c("span",te,l(a.client.adresse3)+",",1)):_("",!0),e("span",null,l(a.client.code_postal+", "+a.client.ville)+",",1),e("span",null,l(a.client.pays),1)]),e("div",se,[ae,e("span",null,l(a.client.nom_adresse_facturation)+",",1),e("span",null,l(a.client.adresse1_facturation)+",",1),a.client.adresse2_facturation!=""&&a.client.adresse2_facturation!=null?(r(),c("span",le,l(a.client.adresse2_facturation)+",",1)):_("",!0),a.client.adresse3_facturation!=""&&a.client.adresse3_facturation!=null?(r(),c("span",ne,l(a.client.adresse3_facturation)+",",1)):_("",!0),e("span",null,l(a.client.code_postal_facturation+", "+a.client.ville_facturation)+",",1),e("span",null,l(a.client.pays_facturation),1)])]),e("div",oe,[ie,e("div",re,[e("div",ce,[e("span",de,"Quantiter : "+l(a.panier.produits_total)+" pcs",1),me]),e("div",_e,[e("span",pe,"M\xB2 : "+l(a.panier.total_m2)+" m\xB2",1),ue]),e("div",xe,[e("span",fe,"Prix HT : "+l(a.panier.total_HT)+" \u20AC",1),he]),e("div",ge,[e("span",ye,"Prix TVA : "+l(a.panier.total_taxe)+" \u20AC",1),ve]),e("div",be,[e("span",we,"Prix TTC : "+l(a.panier.total_ttc)+" \u20AC",1)])])]),e("div",ke,[Ce,x.produits!=null?(r(),c("div",Be,[(r(!0),c(B,null,z(a.produits.panier,(t,d)=>(r(),c("div",{key:d,class:"2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2"},[e("div",Te,[e("div",je,[t.photo!=null?(r(),c("div",Ve,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+t.photo.img_produit,alt:t.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,Pe)])):(r(),c("div",Ee,He))]),e("div",$e,[e("span",ze,"SKU : "+l(t.code_sku),1),e("span",Ae,"Taille : "+l(t.dimension.largeur+"x"+t.dimension.longueur),1),e("span",Ie,"Prix du M\xB2 : "+l(t.gamme.prix_vente_ht_m2_remise?t.gamme.prix_vente_ht_m2_remise:t.gamme.prix_vente_ht_m2)+" \u20AC HT",1),e("span",Me,"M\xB2 : "+l(b(t.dimension.largeur/100*(t.dimension.longueur/100)*t.panier.quantiter,2))+" m\xB2",1),e("span",Ne,"Quantiter : "+l(t.panier.quantiter),1),e("span",Se,"Prix HT : "+l(b(t.dimension.largeur/100*(t.dimension.longueur/100)*t.panier.quantiter*(t.gamme.prix_vente_ht_m2_remise?t.gamme.prix_vente_ht_m2_remise:t.gamme.prix_vente_ht_m2),2))+" \u20AC",1)])])]))),128))])):_("",!0)]),e("div",Ue,[qe,s(i)==0||!s(u)?(r(),c("div",Le,[n(s(q),{class:"h-8 w-8 text-yellow-600"}),Oe])):_("",!0),e("div",De,[n(s(S),{modelValue:s(i),"onUpdate:modelValue":o[2]||(o[2]=t=>A(i)?i.value=t:i=t)},{default:p(()=>[n(s(L),{class:"sr-only"},{default:p(()=>[v("Type de paiement")]),_:1}),e("div",Je,[n(s(V),{as:"template",value:"2",onClick:o[0]||(o[0]=t=>s(k)(t,2))},{default:p(({active:t,checked:d})=>[e("div",{class:f([[t?"ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300":"",d?"bg-blue-900 bg-opacity-75 text-white ":"bg-white "],"relative sm:my-0 my-2 mx-2 w-full sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"])},[e("div",Qe,[e("div",Re,[e("div",Ge,[n(s(P),{as:"span",class:f([d?"text-blue-100":"text-gray-500","inline flex items-center"])},{default:p(()=>[n(s(O),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"}),Ke]),_:2},1032,["class"])])]),g(e("div",We,[n(s(E),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"})],512),[[y,d]])])],2)]),_:1}),n(s(V),{as:"template",value:"1",onClick:o[1]||(o[1]=t=>s(k)(t,1))},{default:p(({active:t,checked:d})=>[e("div",{class:f([[t?"ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300":"",d?"bg-blue-900 bg-opacity-75 text-white ":"bg-white "],"relative w-full sm:my-0 my-2 mx-2 sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"])},[e("div",Xe,[e("div",Ye,[e("div",Ze,[n(s(P),{as:"span",class:f([d?"text-blue-100":"text-gray-500","inline flex items-center"])},{default:p(()=>[n(s(M),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"}),et]),_:2},1032,["class"])])]),g(e("div",tt,[n(s(E),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"})],512),[[y,d]])])],2)]),_:1})])]),_:1},8,["modelValue"])]),e("div",st,[e("input",{onClick:o[3]||(o[3]=(...t)=>s(C)&&s(C)(...t)),id:"checkVenteCondition",type:"checkbox",value:"1",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),at]),e("div",lt,[g(e("div",nt,[n(U,{disabled:s(i)==0||!s(u),id:"bouttonPaiement"},null,8,["disabled"])],512),[[y,s(i)==2]]),s(i)==1||s(i)==0?(r(),c("div",ot,[e("button",{disabled:s(i)==0||!s(u),onClick:o[4]||(o[4]=(...t)=>s(w)&&s(w)(...t)),type:"button",class:"py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},[v("Finaliser la commande "),n(s(D),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})],8,it)])):_("",!0)])])])])])])],64))}});export{gt as default};