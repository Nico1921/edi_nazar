import{z as u,P as g,o as c,a as m,d as i,u as t,f as e,t as o,F as y,K as M,e as p,i as S,w as v,p as b,h as D,k as C,H as V,n as h,M as L}from"./app.1659d670.js";import{_ as P}from"./AuthenticatedLayout.84c73bc0.js";import{_ as G}from"./EtapeOrder.825f6e44.js";import{y as Q,O as U,g as B,h as k,r as O,a as z,b as Z,_ as J,c as R}from"./BouttonPaiement.aec3cb86.js";import"./LangueChoice.dfbe587c.js";import"./label.46596fef.js";import"./description.f567a273.js";const $={class:"container mx-auto mt-5"},W={class:"grid grid-cols-4"},q={class:"xl:col-span-1 col-span-4"},X={class:"xl:col-span-3 col-span-4"},K=e("h1",{class:"text-center text-3xl text-primary-300"},"Finalisation de la commande",-1),ee={class:"m-5"},se={class:"bg-primary-50 rounded m-2 p-4"},te=e("h2",{class:"text-center font-bold"},"Total Commande",-1),oe={class:"grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6"},ae={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},le={class:"font-semibold text-gray-600"},ie=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),ne={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},re={class:"font-semibold text-gray-600"},de=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),ce={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},me={lass:"font-semibold text-gray-600"},_e=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),pe={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ue={lass:"font-semibold text-gray-600"},xe=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),ge={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},he={lass:"font-semibold text-gray-600"},fe={class:"xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen sm:px-6 overflow-auto grid grid-cols-1 flex items-center justify-center my-4 mx-2"},ye={class:"border p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow"},ve={class:"flex justify-between items-center mb-4"},be={class:"text-xl font-bold"},we={class:"flex items-center mb-4"},je={class:"font-bold"},Ie={class:"text-gray-600"},Ne=e("div",{class:"border-b border-gray-300 mb-4"},null,-1),Te={key:0,class:"grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50"},Me={class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},De={class:"xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center"},Ce={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},Le=["src","alt"],Pe={key:1},Be=e("span",null,"Pas de photo pour ce produit !",-1),ke=[Be],ze={class:"xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm"},Ae={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ye={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ee={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},He={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Fe={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Se={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ve={key:1,class:"flex items-center"},Ge=e("span",{class:"font-semibold"},"Panier Vide !",-1),Qe=[Ge],Ue={class:"border-t border-gray-300 mt-4 pt-4 text-right"},Oe={class:"font-bold text-xl"},Ze={class:"bg-gray-100 rounded-b-lg"},Je=e("div",{class:"text-center bg-primary-50 rounded-t-lg py-1"},[e("h2",{class:"text-lg font-bold"},"Moyen de paiement")],-1),Re={class:"mx-auto w-full my-2"},$e={class:"flex sm:flex-row flex-col w-full sm:justify-evenly justify-center items-center"},We={class:"flex w-full items-center justify-between"},qe={class:"flex items-center"},Xe={class:"text-sm"},Ke=e("span",{class:"ml-2"}," Carte Bancaire",-1),es={class:"shrink-0 text-white"},ss={class:"flex w-full items-center justify-between"},ts={class:"flex items-center"},os={class:"text-sm"},as=e("span",{class:"ml-2"}," Virement Bancaire",-1),ls={class:"shrink-0 text-white"},is={class:"py-2"},ns={id:"paymentCB",class:"flex items-center justify-center mb-5"},rs={key:0,class:"flex justify-center mb-5"},ds=["disabled"],cs={layout:(w,f)=>w(P,()=>child),layout:P},fs=Object.assign(cs,{__name:"ValidationDrop",props:["client","panier","produits"],setup(w){var f=u(g().props.value.auth.user[0].client),A=u(g().props.value.PanierDrop.panier.clients),_=u(g().props.value.PanierDrop.panier.panierActuel);u(g().props.value.PanierDrop);var Y=["Panier","Adresse Livraison / Facturation","Finaliser commande"];const E="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";console.log(_.value);const j=(n,a)=>n.toFixed(a);var x=n=>new Intl.NumberFormat("fr-FR",{style:"currency",currency:"EUR"}).format(n),d=u(0),I=()=>{L.post("/dropshipping/cart/validation/order",{paymentType:d.value}).then(n=>{n.status==200?document.location.href="/shippings/order/clients/"+n.data.num_commande:Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre commande, veuillez ressayer !"})})},H=n=>(Math.round(n*100)/100).toFixed(2),N=n=>{var a=n;return f.value.taux_remise>0&&(a=a-a*(f.value.taux_remise/100)),H(a)},T=(n,a)=>{a==2&&document.getElementById("paymentCB").getElementsByTagName("form").length===0&&L.post("/dropshipping/cart/payment/cb",{paymentType:d.value}).then(s=>{if(s.status==200)if(s.data.statut){var r=document.getElementById("bouttonPaiement");document.getElementById("paymentCB").innerHTML=s.data.formpay,document.getElementById("submitPayButton").appendChild(r)}else Toast.fire({icon:"error",title:s.data.msg});else Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la g\xE9n\xE9ration du formulaire de paiement, veuillez ressayer !"})})};return(n,a)=>(c(),m(y,null,[i(t(V),{title:"Validation - Panier"}),e("section",$,[e("div",W,[e("div",q,[i(G,{etape:3,nbEtape:3,listeEtape:t(Y)},null,8,["listeEtape"])]),e("div",X,[K,e("div",ee,[e("div",se,[te,e("div",oe,[e("div",ae,[e("span",le,"Quantiter : "+o(t(_).produits_total)+" pcs",1),ie]),e("div",ne,[e("span",re,"M\xB2 : "+o(t(_).total_m2)+" m\xB2",1),de]),e("div",ce,[e("span",me,"Prix HT : "+o(t(x)(t(_).total_HT)),1),_e]),e("div",pe,[e("span",ue,"Prix TVA : "+o(t(x)(t(_).total_taxe)),1),xe]),e("div",ge,[e("span",he,"Prix TTC : "+o(t(x)(t(_).total_ttc)),1)])])]),e("div",fe,[(c(!0),m(y,null,M(t(A),(s,r)=>(c(),m("div",{key:r,class:"my-2"},[e("div",ye,[e("div",ve,[e("h2",be,o(s.client.ref_externe)+" - "+o(s.client.prenom+" "+s.client.nom),1)]),e("div",we,[e("img",{src:E,alt:"Logo client",class:"w-12 h-12 rounded-full mr-4"}),e("div",null,[e("p",je,o(s.client.nom_adresse),1),e("p",Ie,o(s.client.adresse1)+", "+o(s.client.adresse2!=""&&s.client.adresse2!=null?s.client.adresse2+",":"")+" "+o(s.client.adresse3!=""&&s.client.adresse3!=null?s.client.adresse3+",":"")+" "+o(s.client.code_postal)+" "+o(s.client.ville)+", "+o(s.client.pays),1)])]),Ne,e("div",null,[s.produits!=null?(c(),m("div",Te,[s.produits.length>0?(c(!0),m(y,{key:0},M(s.produits,(l,F)=>(c(),m("div",{key:F,class:"2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2"},[e("div",Me,[e("div",De,[l.photo!=null?(c(),m("div",Ce,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+l.photo.img_produit,alt:l.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,Le)])):(c(),m("div",Pe,ke))]),e("div",ze,[e("span",Ae,"SKU : "+o(l.code_sku),1),e("span",Ye,"Taille : "+o(l.dimension.largeur+"x"+l.dimension.longueur),1),e("span",Ee,"Prix du M\xB2 : "+o(t(N)(l.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",He,"M\xB2 : "+o(j(l.dimension.largeur/100*(l.dimension.longueur/100)*l.panier.quantiter,2))+" m\xB2",1),e("span",Fe,"Quantiter : "+o(l.panier.quantiter),1),e("span",Se,"Prix HT : "+o(j(l.dimension.largeur/100*(l.dimension.longueur/100)*l.panier.quantiter*t(N)(l.gamme.prix_vente_ht_m2),2))+" \u20AC",1)])])]))),128)):(c(),m("div",Ve,Qe))])):C("",!0)]),e("div",Ue,[e("p",Oe,"Total commande HT : "+o(t(x)(s.client.total_ht)),1)])])]))),128))]),e("div",Ze,[Je,e("div",Re,[i(t(Q),{modelValue:t(d),"onUpdate:modelValue":a[2]||(a[2]=s=>S(d)?d.value=s:d=s)},{default:p(()=>[i(t(U),{class:"sr-only"},{default:p(()=>[D("Type de paiement")]),_:1}),e("div",$e,[i(t(B),{as:"template",value:"2",onClick:a[0]||(a[0]=s=>t(T)(s,2))},{default:p(({active:s,checked:r})=>[e("div",{class:h([[s?"ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300":"",r?"bg-blue-900 bg-opacity-75 text-white ":"bg-white "],"relative sm:my-0 my-2 mx-2 w-full sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"])},[e("div",We,[e("div",qe,[e("div",Xe,[i(t(k),{as:"span",class:h([r?"text-blue-100":"text-gray-500","inline flex items-center"])},{default:p(()=>[i(t(O),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"}),Ke]),_:2},1032,["class"])])]),v(e("div",es,[i(t(z),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"})],512),[[b,r]])])],2)]),_:1}),i(t(B),{as:"template",value:"1",onClick:a[1]||(a[1]=s=>t(T)(s,1))},{default:p(({active:s,checked:r})=>[e("div",{class:h([[s?"ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-300":"",r?"bg-blue-900 bg-opacity-75 text-white ":"bg-white "],"relative w-full sm:my-0 my-2 mx-2 sm:max-w-sm max-w-xs flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"])},[e("div",ss,[e("div",ts,[e("div",os,[i(t(k),{as:"span",class:h([r?"text-blue-100":"text-gray-500","inline flex items-center"])},{default:p(()=>[i(t(Z),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"}),as]),_:2},1032,["class"])])]),v(e("div",ls,[i(t(z),{class:"h-6 w-6",viewBox:"0 0 24 24",fill:"none"})],512),[[b,r]])])],2)]),_:1})])]),_:1},8,["modelValue"])]),e("div",is,[v(e("div",ns,[i(J,{id:"bouttonPaiement"})],512),[[b,t(d)==2]]),t(d)==1||t(d)==0?(c(),m("div",rs,[e("button",{disabled:t(d)==0,onClick:a[3]||(a[3]=(...s)=>t(I)&&t(I)(...s)),type:"button",class:"py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},[D("Finaliser la commande "),i(t(R),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})],8,ds)])):C("",!0)])])])])])])],64))}});export{fs as default};