import{z as m,P as u,o as n,a as i,d as v,u as s,f as e,t as o,F as g,K as I,w as k,p as A,k as j,H as Y,M as N}from"./app.2129a415.js";import{_ as w}from"./AuthenticatedLayout.91e2f63d.js";import{_ as z}from"./EtapeOrder.09c1332c.js";import"./LangueChoice.5abadb29.js";const B={class:"container mx-auto mt-5"},H={class:"grid grid-cols-4"},E={class:"xl:col-span-1 col-span-4"},F={class:"xl:col-span-3 col-span-4"},S=e("h1",{class:"text-center text-3xl text-primary-300"},"Finalisation de la commande",-1),G={class:"m-5"},V={class:"bg-primary-50 rounded m-2 p-4"},Q=e("h2",{class:"text-center font-bold"},"Total Commande",-1),U={class:"grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6"},Z={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},O={class:"font-semibold text-gray-600"},J=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),R={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},W={class:"font-semibold text-gray-600"},q=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),X={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},K={lass:"font-semibold text-gray-600"},$=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),ee={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},te={lass:"font-semibold text-gray-600"},se=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),oe={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ae={lass:"font-semibold text-gray-600"},re={class:"xl:max-h-[calc(100vh-550px)] lg:max-h-[calc(100vh-250px)] max-h-screen sm:px-6 overflow-auto grid grid-cols-1 flex items-center justify-center my-4 mx-2"},le={class:"border p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow"},ne={class:"flex justify-between items-center mb-4"},ie={class:"text-xl font-bold"},de={class:"flex items-center mb-4"},ce={class:"font-bold"},me={class:"text-gray-600"},pe=e("div",{class:"border-b border-gray-300 mb-4"},null,-1),ue={key:0,class:"grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50"},_e={class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},ge={class:"xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center"},xe={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},ye=["src","alt"],he={key:1},fe=e("span",null,"Pas de photo pour ce produit !",-1),be=[fe],ve={class:"xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm"},Ie={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},je={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ne={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},we={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Te={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Me={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Le={key:1,class:"flex items-center"},De=e("span",{class:"font-semibold"},"Panier Vide !",-1),Ce=[De],Pe={class:"border-t border-gray-300 mt-4 pt-4 text-right"},ke={class:"font-bold text-xl"},Ae={class:"grid grid-cols-4 bg-primary-50 rounded px-4 py-2 mb-4"},Ye={class:"lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center"},ze=e("label",{for:"paymentCard",class:"ml-2 text-lg font-medium text-gray-900"},"Paiement par CB",-1),Be={class:"lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center"},He=e("label",{for:"paymentVirement",class:"ml-2 text-lg font-medium text-gray-900"},"Paiement par Virement Bancaire",-1),Ee={id:"paymentCB",class:"flex items-center justify-center mb-5"},Fe={key:0,class:"flex justify-center mb-5"},Se=["disabled"],Ge={layout:(x,_)=>x(w,()=>child),layout:w},Oe=Object.assign(Ge,{__name:"ValidationDrop",props:["client","panier","produits"],setup(x){var _=m(u().props.value.auth.user[0].client),T=m(u().props.value.PanierDrop.panier.clients),c=m(u().props.value.PanierDrop.panier.panierActuel);m(u().props.value.PanierDrop);var M=["Panier","Adresse Livraison / Facturation","Finaliser commande"];const L="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+";console.log(c.value);const y=(l,a)=>l.toFixed(a);var p=l=>new Intl.NumberFormat("fr-FR",{style:"currency",currency:"EUR"}).format(l),d=m(0),h=()=>{N.post("/dropshipping/cart/validation/order",{paymentType:d.value}).then(l=>{l.status==200?document.location.href="/shippings/order/clients/"+l.data.num_commande:Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre commande, veuillez ressayer !"})})},D=l=>(Math.round(l*100)/100).toFixed(2),f=l=>{var a=l;return _.value.taux_remise>0&&(a=a-a*(_.value.taux_remise/100)),D(a)},b=(l,a)=>{l.target.checked?(d.value=a,a==2&&(console.log(document.getElementById("paymentCB").innerHTML),document.getElementById("paymentCB").innerHTML===""&&N.post("/dropshipping/cart/payment/cb",{paymentType:d.value}).then(t=>{t.status==200?(t.data.statut?(document.getElementById("paymentCB").innerHTML=t.data.formpay,document.getElementById("submitPayButton").classList.add("text-blue-900","bg-blue-100","hover:bg-blue-200","border","border-blue-200","focus:ring-4","focus:outline-none","focus:ring-blue-100","font-medium","rounded-lg","text-sm","px-5","py-4","text-center","inline-flex","items-center","mr-2","mb-2","transition","duration-300")):Toast.fire({icon:"error",title:t.data.msg}),console.log(t)):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la g\xE9n\xE9ration du formulaire de paiement, veuillez ressayer !"})}))):d.value=0};return(l,a)=>(n(),i(g,null,[v(s(Y),{title:"Validation - Panier"}),e("section",B,[e("div",H,[e("div",E,[v(z,{etape:3,nbEtape:3,listeEtape:s(M)},null,8,["listeEtape"])]),e("div",F,[S,e("div",G,[e("div",V,[Q,e("div",U,[e("div",Z,[e("span",O,"Quantiter : "+o(s(c).produits_total)+" pcs",1),J]),e("div",R,[e("span",W,"M\xB2 : "+o(s(c).total_m2)+" m\xB2",1),q]),e("div",X,[e("span",K,"Prix HT : "+o(s(p)(s(c).total_HT)),1),$]),e("div",ee,[e("span",te,"Prix TVA : "+o(s(p)(s(c).total_taxe)),1),se]),e("div",oe,[e("span",ae,"Prix TTC : "+o(s(p)(s(c).total_ttc)),1)])])]),e("div",re,[(n(!0),i(g,null,I(s(T),(t,C)=>(n(),i("div",{key:C,class:"my-2"},[e("div",le,[e("div",ne,[e("h2",ie,o(t.client.ref_externe)+" - "+o(t.client.prenom+" "+t.client.nom),1)]),e("div",de,[e("img",{src:L,alt:"Logo client",class:"w-12 h-12 rounded-full mr-4"}),e("div",null,[e("p",ce,o(t.client.nom_adresse),1),e("p",me,o(t.client.adresse1)+", "+o(t.client.adresse2!=""&&t.client.adresse2!=null?t.client.adresse2+",":"")+" "+o(t.client.adresse3!=""&&t.client.adresse3!=null?t.client.adresse3+",":"")+" "+o(t.client.code_postal)+" "+o(t.client.ville)+", "+o(t.client.pays),1)])]),pe,e("div",null,[t.produits!=null?(n(),i("div",ue,[t.produits.length>0?(n(!0),i(g,{key:0},I(t.produits,(r,P)=>(n(),i("div",{key:P,class:"2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2"},[e("div",_e,[e("div",ge,[r.photo!=null?(n(),i("div",xe,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+r.photo.img_produit,alt:r.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,ye)])):(n(),i("div",he,be))]),e("div",ve,[e("span",Ie,"SKU : "+o(r.code_sku),1),e("span",je,"Taille : "+o(r.dimension.largeur+"x"+r.dimension.longueur),1),e("span",Ne,"Prix du M\xB2 : "+o(s(f)(r.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",we,"M\xB2 : "+o(y(r.dimension.largeur/100*(r.dimension.longueur/100)*r.panier.quantiter,2))+" m\xB2",1),e("span",Te,"Quantiter : "+o(r.panier.quantiter),1),e("span",Me,"Prix HT : "+o(y(r.dimension.largeur/100*(r.dimension.longueur/100)*r.panier.quantiter*s(f)(r.gamme.prix_vente_ht_m2),2))+" \u20AC",1)])])]))),128)):(n(),i("div",Le,Ce))])):j("",!0)]),e("div",Pe,[e("p",ke,"Total commande HT : "+o(s(p)(t.client.total_ht)),1)])])]))),128))]),e("form",Ae,[e("div",Ye,[e("input",{onClick:a[0]||(a[0]=t=>s(b)(t,2)),id:"paymentCard",name:"paymentType",type:"radio",value:"2",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),ze]),e("div",Be,[e("input",{onClick:a[1]||(a[1]=t=>s(b)(t,1)),id:"paymentVirement",name:"paymentType",type:"radio",value:"1",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),He])]),k(e("div",Ee,null,512),[[A,s(d)==2]]),s(d)==1||s(d)==0?(n(),i("div",Fe,[e("button",{disabled:s(d)==0,onClick:a[2]||(a[2]=(...t)=>s(h)&&s(h)(...t)),type:"button",class:"p-2 border border-primary-300 rounded bg-primary-50 hover:bg-primary-100 transition duration-300 disabled:cursor-not-allowed disabled:bg-primary-200"},"Finaliser la commande",8,Se)])):j("",!0)])])])])],64))}});export{Oe as default};
