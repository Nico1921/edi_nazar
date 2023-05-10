import{o,a,f as t,h as n,t as s,K as p,e as u,d as r,u as i,L as _,k as c}from"./app.f7578ef3.js";import{r as l}from"./ArrowRightCircleIcon.bc5e99b2.js";const x={class:"bg-white border border-primary-100 rounded border-2 border-primary-200 py-2 my-2"},b=t("h2",{class:"font-bold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-2"},"R\xE9capitulatif de la commande",-1),g={class:"grid grid-cols-12 px-3 py-2 justify-center items-center"},f={class:"2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"},m=t("span",{class:"font-semibold text-lg"},"Quantit\xE9 Total :",-1),h={class:"2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"},y=t("span",{class:"font-semibold text-lg"},"M\xB2 Total : ",-1),v={class:"2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"},k=t("span",{class:"font-semibold text-lg"},"Montant HT :",-1),w={class:"2xl:col-span-3 lg:col-span-6 col-span-12 text-sm text-center"},T=t("span",{class:"font-semibold text-lg"},"* Transport HT :",-1),B={class:"2xl:col-span-4 lg:col-span-6 col-span-12 text-sm text-center"},L=t("span",{class:"font-semibold text-lg"},"Total HT :",-1),S={class:"2xl:col-span-4 lg:col-span-6 col-span-12 text-sm text-center"},j=t("span",{class:"font-semibold text-lg"},"Total TVA : ",-1),V={class:"2xl:col-span-4 lg:col-span-6 col-span-12 text-sm text-center"},H=t("span",{class:"font-semibold text-lg"},"Total TTC :",-1),E={class:"flex items-center justify-center"},N={key:0},P={key:0,class:"flex items-center justify-center my-3"},C={key:1,class:"flex items-center justify-center my-3"},M={key:0,type:"submit",class:"btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},R={key:2,class:"flex items-center justify-center my-3"},A={type:"button",class:"btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300",disabled:""},D={key:1},K={class:"flex items-center justify-center my-3"},O={type:"button",class:"btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300",disabled:""},G={__name:"ResumeOrderVertical",props:["panier","linkEtapeSuivant","titreLink","isButtonSubmit","disabled"],setup(d){const e=d;return(Q,q)=>(o(),a("div",x,[b,t("div",g,[t("span",f,[m,n(" "+s(e.panier!=null&&e.panier.produits_total!=null?e.panier.produits_total:"0")+" pcs",1)]),t("span",h,[y,n(" "+s(e.panier!=null&&e.panier.total_m2!=null?e.panier.total_m2:"0")+" m\xB2",1)]),t("span",v,[k,n(" "+s(e.panier!=null&&e.panier.montant_ht!=null?e.panier.montant_ht:"0")+" \u20AC",1)]),t("span",w,[T,n(" "+s(e.panier!=null&&e.panier.prix_transport!=null?e.panier.prix_transport:"0")+" \u20AC",1)]),t("span",B,[L,n(" "+s(e.panier!=null&&e.panier.total_HT!=null?e.panier.total_HT:"0")+" \u20AC",1)]),t("span",S,[j,n(s(e.panier!=null&&e.panier.total_taxe!=null?e.panier.total_taxe:"0")+" \u20AC",1)]),t("span",V,[H,n(" "+s(e.panier!=null&&e.panier.total_ttc!=null?e.panier.total_ttc:"0")+" \u20AC",1)])]),t("div",E,[e.titreLink!=""&&e.titreLink!=null?(o(),a("div",N,[e.linkEtapeSuivant!=null&&!e.disabled&&e.panier!=null&&!d.isButtonSubmit&&e.panier.produits_total>0?(o(),a("div",P,[e.panier.total_ttc!=null?(o(),p(i(_),{key:0,href:e.linkEtapeSuivant,class:"btnProcess py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},{default:u(()=>[n(s(e.titreLink)+" ",1),r(i(l),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})]),_:1},8,["href"])):c("",!0)])):e.panier!=null&&d.isButtonSubmit&&!e.disabled?(o(),a("div",C,[e.panier.total_ttc!=null?(o(),a("button",M,[n(s(e.titreLink)+" ",1),r(i(l),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})])):c("",!0)])):(o(),a("div",R,[t("button",A,[n(s(e.titreLink)+" ",1),r(i(l),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})])]))])):(o(),a("div",D,[t("div",K,[t("button",O,[n(s(e.titreLink)+" ",1),r(i(l),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})])])]))])]))}};export{G as _};
