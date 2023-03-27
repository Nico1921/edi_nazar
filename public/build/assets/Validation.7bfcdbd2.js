import{_ as h}from"./AuthenticatedLayout.f96130c6.js";import{z as f,P as w,o as l,a as r,d as y,u as i,f as e,t,k as c,F as b,K as P,H as C,M as v}from"./app.4ddaa9db.js";import{_ as V}from"./EtapeOrder.a2c67de5.js";import"./LangueChoice.37bf89c9.js";const F={class:"container mx-auto mt-5"},H={class:"grid grid-cols-4"},B={class:"xl:col-span-1 col-span-4"},E={class:"xl:col-span-3 col-span-4"},M=e("h1",{class:"text-center text-3xl text-primary-300"},"Finalisation de la commande",-1),A={class:"m-5"},N={class:"grid grid-cols-2"},q={class:"bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4"},z=e("h2",{class:"text-center font-bold"},"Adresse de livraison",-1),U={key:0},K={key:1},L={class:"bg-primary-50 rounded sm:col-span-1 col-span-2 m-2 flex flex-col p-4"},Q=e("h2",{class:"text-center font-bold"},"Adresse de facturation",-1),S={key:0},$={key:1},D={class:"bg-primary-50 rounded m-2 p-4"},O=e("h2",{class:"text-center font-bold"},"Total Commande",-1),R={class:"grid lg:grid-cols-5 grid-cols-4 justify-center flex-row mt-4 mx-6"},G={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},I={class:"font-semibold text-gray-600"},J=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),W={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},X={class:"font-semibold text-gray-600"},Y=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),Z={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ee={lass:"font-semibold text-gray-600"},se=e("hr",{class:"absolute sm:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),te={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},ae={lass:"font-semibold text-gray-600"},ne=e("hr",{class:"absolute lg:block hidden w-px h-5 border border-primary-100 right-0"},null,-1),oe={class:"lg:col-span-1 sm:col-span-2 col-span-4 flex justify-center relative"},le={lass:"font-semibold text-gray-600"},re={class:"grid grid-cols-1 flex items-center justify-center my-4 mx-2"},ie=e("h2",{class:"px-5 py-3 bg-primary-50 rounded font-bold text-center"},"Produits",-1),ce={key:0,class:"grid 2xl:grid-cols-3 lg:grid-cols-4 w-full p-5 h-90 bg-gray-50"},de={class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},pe={class:"xl:col-span-4 lg:col-span-4 sm:col-span-2 xsm:col-span-4 col-span-4 flex items-center justify-center"},me={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},_e=["src","alt"],ue={key:1},ge=e("span",null,"Pas de photo pour ce produit !",-1),xe=[ge],he={class:"xl:col-span-8 lg:col-span-8 sm:col-span-10 xsm:col-span-8 col-span-8 flex flex-col xl:text-lg text-sm"},fe={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},ye={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},be={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},ve={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},ke={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Te={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},je={class:"grid grid-cols-4 bg-primary-50 rounded px-4 py-2 mb-4"},we={class:"lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center"},Pe=e("label",{for:"paymentCard",class:"ml-2 text-lg font-medium text-gray-900"},"Paiement par CB",-1),Ce={class:"lg:my-0 my-2 lg:col-span-2 col-span-4 flex items-center justify-center"},Ve=e("label",{for:"paymentVirement",class:"ml-2 text-lg font-medium text-gray-900"},"Paiement par Virement Bancaire",-1),Fe={class:"flex justify-center mb-5"},He=["disabled"],Be={layout:(d,s)=>d(h,()=>child),layout:h},qe=Object.assign(Be,{__name:"Validation",props:["client","panier","produits"],setup(d){const s=d;var m=f(w().props.value.auth.user[0].client),k=["Panier","Adresse Livraison / Facturation","Finaliser commande"];const _=(o,n)=>o.toFixed(n);var p=f(0),u=()=>{v.post("/cart/adresses/validation/order",{paymentType:p.value}).then(o=>{o.status==200?document.location.href="/shippings/order/clients/"+o.data.num_commande:Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre commande, veuillez ressayer !"})})},T=o=>(Math.round(o*100)/100).toFixed(2),g=o=>{var n=o;return m.value.taux_remise>0&&(n=n-n*(m.value.taux_remise/100)),T(n)},x=(o,n)=>{o.target.checked?(p.value=n,n==2&&v.post("/cart/payment/cb")):p.value=0};return(o,n)=>(l(),r(b,null,[y(i(C),{title:"Validation - Panier"}),e("section",F,[e("div",H,[e("div",B,[y(V,{etape:3,nbEtape:3,listeEtape:i(k)},null,8,["listeEtape"])]),e("div",E,[M,e("div",A,[e("div",N,[e("div",q,[z,e("span",null,t(s.client.nom_adresse)+",",1),e("span",null,t(s.client.adresse1)+",",1),s.client.adresse2!=""&&s.client.adresse2!=null?(l(),r("span",U,t(s.client.adresse2)+",",1)):c("",!0),s.client.adresse3!=""&&s.client.adresse3!=null?(l(),r("span",K,t(s.client.adresse3)+",",1)):c("",!0),e("span",null,t(s.client.code_postal+", "+s.client.ville)+",",1),e("span",null,t(s.client.pays),1)]),e("div",L,[Q,e("span",null,t(s.client.nom_adresse_facturation)+",",1),e("span",null,t(s.client.adresse1_facturation)+",",1),s.client.adresse2_facturation!=""&&s.client.adresse2_facturation!=null?(l(),r("span",S,t(s.client.adresse2_facturation)+",",1)):c("",!0),s.client.adresse3_facturation!=""&&s.client.adresse3_facturation!=null?(l(),r("span",$,t(s.client.adresse3_facturation)+",",1)):c("",!0),e("span",null,t(s.client.code_postal_facturation+", "+s.client.ville_facturation)+",",1),e("span",null,t(s.client.pays_facturation),1)])]),e("div",D,[O,e("div",R,[e("div",G,[e("span",I,"Quantiter : "+t(s.panier.produits_total)+" pcs",1),J]),e("div",W,[e("span",X,"M\xB2 : "+t(s.panier.total_m2)+" m\xB2",1),Y]),e("div",Z,[e("span",ee,"Prix HT : "+t(s.panier.total_HT)+" \u20AC",1),se]),e("div",te,[e("span",ae,"Prix TVA : "+t(s.panier.total_taxe)+" \u20AC",1),ne]),e("div",oe,[e("span",le,"Prix TTC : "+t(s.panier.total_ttc)+" \u20AC",1)])])]),e("div",re,[ie,d.produits!=null?(l(),r("div",ce,[(l(!0),r(b,null,P(s.produits.panier,(a,j)=>(l(),r("div",{key:j,class:"2xl:col-span-1 lg:col-span-2 col-span-4 w-full px-2"},[e("div",de,[e("div",pe,[a.photo!=null?(l(),r("div",me,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+a.photo.img_produit,alt:a.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,_e)])):(l(),r("div",ue,xe))]),e("div",he,[e("span",fe,"SKU : "+t(a.code_sku),1),e("span",ye,"Taille : "+t(a.dimension.largeur+"x"+a.dimension.longueur),1),e("span",be,"Prix du M\xB2 : "+t(i(g)(a.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",ve,"M\xB2 : "+t(_(a.dimension.largeur/100*(a.dimension.longueur/100)*a.panier.quantiter,2))+" m\xB2",1),e("span",ke,"Quantiter : "+t(a.panier.quantiter),1),e("span",Te,"Prix HT : "+t(_(a.dimension.largeur/100*(a.dimension.longueur/100)*a.panier.quantiter*i(g)(a.gamme.prix_vente_ht_m2),2))+" \u20AC",1)])])]))),128))])):c("",!0)]),e("form",je,[e("div",we,[e("input",{onClick:n[0]||(n[0]=a=>i(x)(a,2)),id:"paymentCard",name:"paymentType",type:"radio",value:"2",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),Pe]),e("div",Ce,[e("input",{onClick:n[1]||(n[1]=a=>i(x)(a,1)),id:"paymentVirement",name:"paymentType",type:"radio",value:"1",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),Ve])]),e("div",Fe,[e("button",{disabled:i(p)==0,onClick:n[2]||(n[2]=(...a)=>i(u)&&i(u)(...a)),type:"button",class:"p-2 border border-primary-300 rounded bg-primary-50 hover:bg-primary-100 transition duration-300 disabled:cursor-not-allowed disabled:bg-primary-200"},"Finaliser la commande",8,He)])])])])])],64))}});export{qe as default};