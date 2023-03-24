import{_ as b}from"./AuthenticatedLayout.e8c5195e.js";import{z as m,P as _,o as n,a as i,d as j,u as a,f as e,t,F as g,K as N,H as P,k,M as I}from"./app.8ecc81de.js";import{_ as A}from"./EtapeOrder.0d31c452.js";import"./LangueChoice.5a47e78b.js";const Y={class:"container mx-auto mt-5"},z={class:"grid grid-cols-4"},H={class:"xl:col-span-1 col-span-4"},B={class:"xl:col-span-3 col-span-4"},E=e("h1",{class:"text-center text-3xl text-primary-300"},"Finalisation de la commande",-1),F={class:"m-5"},S={class:"bg-primary-50 rounded m-2 p-4"},G=e("h2",{class:"text-center font-bold"},"Total Commande",-1),V={class:"grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6"},Q={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},U={class:"font-semibold text-gray-600"},Z=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),O={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},J={class:"font-semibold text-gray-600"},R=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),W={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},q={lass:"font-semibold text-gray-600"},X=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),K={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},$={lass:"font-semibold text-gray-600"},ee=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),se={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},te={lass:"font-semibold text-gray-600"},ae={class:"xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen sm:px-6 overflow-auto grid grid-cols-1 flex items-center justify-center my-4 mx-2"},oe={class:"border p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow"},re={class:"flex justify-between items-center mb-4"},le={class:"text-xl font-bold"},ne={class:"flex items-center mb-4"},ie={class:"font-bold"},de={class:"text-gray-600"},ce=e("div",{class:"border-b border-gray-300 mb-4"},null,-1),me={key:0,class:"grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50"},pe={class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},_e={class:"xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center"},ue={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},ge=["src","alt"],xe={key:1},he=e("span",null,"Pas de photo pour ce produit !",-1),ye=[he],fe={class:"xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm"},ve={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},be={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},je={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ne={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ie={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Te={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},we={key:1,class:"flex items-center"},Me=e("span",{class:"font-semibold"},"Panier Vide !",-1),De=[Me],Le={class:"border-t border-gray-300 mt-4 pt-4 text-right"},Ce={class:"font-bold text-xl"},Pe={class:"grid grid-cols-4 bg-primary-50 rounded px-4 py-2 mb-4"},ke={class:"lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center"},Ae=e("label",{for:"paymentCard",class:"ml-2 text-lg font-medium text-gray-900"},"Paiement par CB",-1),Ye={class:"lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center"},ze=e("label",{for:"paymentVirement",class:"ml-2 text-lg font-medium text-gray-900"},"Paiement par Virement Bancaire",-1),He=e("div",{id:"paymentCB"},null,-1),Be={class:"flex justify-center mb-5"},Ee=["disabled"],Fe={layout:(x,u)=>x(b,()=>child),layout:b},Ue=Object.assign(Fe,{__name:"ValidationDrop",props:["client","panier","produits"],setup(x){var u=m(_().props.value.auth.user[0].client),T=m(_().props.value.PanierDrop.panier.clients),d=m(_().props.value.PanierDrop.panier.panierActuel);m(_().props.value.PanierDrop);var w=["Panier","Adresse Livraison / Facturation","Finaliser commande"];const M="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";console.log(d.value);const h=(l,o)=>l.toFixed(o);var p=l=>new Intl.NumberFormat("fr-FR",{style:"currency",currency:"EUR"}).format(l),c=m(0),y=()=>{I.post("/dropshipping/cart/validation/order",{paymentType:c.value}).then(l=>{l.status==200?document.location.href="/shippings/order/clients/"+l.data.num_commande:Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre commande, veuillez ressayer !"})})},D=l=>(Math.round(l*100)/100).toFixed(2),f=l=>{var o=l;return u.value.taux_remise>0&&(o=o-o*(u.value.taux_remise/100)),D(o)},v=(l,o)=>{l.target.checked?(c.value=o,o==2&&I.post("/dropshipping/cart/payment/cb",{paymentType:c.value}).then(s=>{s.status==200?(s.data.statut?document.getElementById("paymentCB").innerHTML=s.data.formpay:Toast.fire({icon:"error",title:s.data.msg}),console.log(s)):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la g\xE9n\xE9ration du formulaire de paiement, veuillez ressayer !"})})):c.value=0};return(l,o)=>(n(),i(g,null,[j(a(P),{title:"Validation - Panier"}),e("section",Y,[e("div",z,[e("div",H,[j(A,{etape:3,nbEtape:3,listeEtape:a(w)},null,8,["listeEtape"])]),e("div",B,[E,e("div",F,[e("div",S,[G,e("div",V,[e("div",Q,[e("span",U,"Quantiter : "+t(a(d).produits_total)+" pcs",1),Z]),e("div",O,[e("span",J,"M\xB2 : "+t(a(d).total_m2)+" m\xB2",1),R]),e("div",W,[e("span",q,"Prix HT : "+t(a(p)(a(d).total_HT)),1),X]),e("div",K,[e("span",$,"Prix TVA : "+t(a(p)(a(d).total_taxe)),1),ee]),e("div",se,[e("span",te,"Prix TTC : "+t(a(p)(a(d).total_ttc)),1)])])]),e("div",ae,[(n(!0),i(g,null,N(a(T),(s,L)=>(n(),i("div",{key:L,class:"my-2"},[e("div",oe,[e("div",re,[e("h2",le,t(s.client.ref_externe)+" - "+t(s.client.prenom+" "+s.client.nom),1)]),e("div",ne,[e("img",{src:M,alt:"Logo client",class:"w-12 h-12 rounded-full mr-4"}),e("div",null,[e("p",ie,t(s.client.nom_adresse),1),e("p",de,t(s.client.adresse1)+", "+t(s.client.adresse2!=""&&s.client.adresse2!=null?s.client.adresse2+",":"")+" "+t(s.client.adresse3!=""&&s.client.adresse3!=null?s.client.adresse3+",":"")+" "+t(s.client.code_postal)+" "+t(s.client.ville)+", "+t(s.client.pays),1)])]),ce,e("div",null,[s.produits!=null?(n(),i("div",me,[s.produits.length>0?(n(!0),i(g,{key:0},N(s.produits,(r,C)=>(n(),i("div",{key:C,class:"2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2"},[e("div",pe,[e("div",_e,[r.photo!=null?(n(),i("div",ue,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+r.photo.img_produit,alt:r.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,ge)])):(n(),i("div",xe,ye))]),e("div",fe,[e("span",ve,"SKU : "+t(r.code_sku),1),e("span",be,"Taille : "+t(r.dimension.largeur+"x"+r.dimension.longueur),1),e("span",je,"Prix du M\xB2 : "+t(a(f)(r.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",Ne,"M\xB2 : "+t(h(r.dimension.largeur/100*(r.dimension.longueur/100)*r.panier.quantiter,2))+" m\xB2",1),e("span",Ie,"Quantiter : "+t(r.panier.quantiter),1),e("span",Te,"Prix HT : "+t(h(r.dimension.largeur/100*(r.dimension.longueur/100)*r.panier.quantiter*a(f)(r.gamme.prix_vente_ht_m2),2))+" \u20AC",1)])])]))),128)):(n(),i("div",we,De))])):k("",!0)]),e("div",Le,[e("p",Ce,"Total commande HT : "+t(a(p)(s.client.total_ht)),1)])])]))),128))]),e("form",Pe,[e("div",ke,[e("input",{onClick:o[0]||(o[0]=s=>a(v)(s,2)),id:"paymentCard",name:"paymentType",type:"radio",value:"2",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),Ae]),e("div",Ye,[e("input",{onClick:o[1]||(o[1]=s=>a(v)(s,1)),id:"paymentVirement",name:"paymentType",type:"radio",value:"1",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),ze])]),He,e("div",Be,[e("button",{disabled:a(c)==0,onClick:o[2]||(o[2]=(...s)=>a(y)&&a(y)(...s)),type:"button",class:"p-2 border border-primary-300 rounded bg-primary-50 hover:bg-primary-100 transition duration-300 disabled:cursor-not-allowed disabled:bg-primary-200"},"Finaliser la commande",8,Ee)])])])])])],64))}});export{Ue as default};
