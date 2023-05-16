import{_ as g,I as b}from"./AuthenticatedLayout.99ea9990.js";import{R as v,L as y}from"./MenuRight.74a4882e.js";import{A as w,I as j,W as k,o as l,a as i,d as o,u as n,f as e,t as r,e as a,F as d,H as V,J as C,K as P}from"./app.88b9bac4.js";import"./_plugin-vue_export-helper.cdc0426e.js";const z={class:"container mx-auto mt-5"},A={class:"w-full flex flex-col items-center justify-center py-5 px-4"},D={class:"font-bold lg:text-2xl sm:text-xl text-lg text-gray-800 text-center"},E=e("span",{class:"font-bold lg:text-xl sm:text-lg text-sm text-gray-400 text-center"}," D\xE9couvrez nos collections ",-1),H={class:""},N=e("h2",{class:"font-bold lg:text-xl sm:text-lg text-sm lg:!px-10 !px-0"},"Nos nouvelles collections",-1),B={class:"swiper-button-prev-custom absolute justify-center items-center top-0 bottom-0 right-0 z-40 cursor-pointer lg:flex hidden"},L={class:"swiper-button-next-custom absolute justify-center items-center top-0 bottom-0 left-0 z-40 cursor-pointer lg:flex hidden"},S=e("div",{class:"swiper-pagination-custom lg:hidden flex items-center justify-center py-2"},null,-1),I=["href"],$={class:"relative group"},F={class:"flex items-stretch justify-center w-full !h-52"},O={key:0,class:"relative w-full"},R=["src","alt"],J={key:1,class:"text-3xl w-full flex items-stretch justify-center bg-gray-300"},K=e("div",{class:"absolute bottom-0 z-30 w-full h-full overflow-hidden"},[e("div",{class:"absolute bottom-0 max-h-0 group-hover:max-h-full h-full w-full overflow-hidden group-hover:p-1 transition-full duration-500 bg-primary-100 text-center flex flex-col items-center justify-center bg-opacity-80 text-white"},[e("span",{class:"px-4 py-2 rounded border border-primary-300 bg-primary-100 text-primary-300 font-bold"},"D\xE9couvrir la collection")])],-1),M={class:"bg-white px-4 py-2 w-full"},W={class:"font-bold lg:text-lg text-sm"},q={class:"font-bold text-gray-400"},G=e("hr",{class:"border border-primary-300 lg:!mx-10 !mx-0 my-5"},null,-1),Q=e("h2",{class:"font-bold lg:text-xl sm:text-lg text-sm lg:!px-10 !px-0"},"Meilleures ventes",-1),T={class:"swiper-button-prev-custom absolute justify-center items-center top-0 bottom-0 right-0 z-40 cursor-pointer lg:flex hidden"},U={class:"swiper-button-next-custom absolute justify-center items-center top-0 bottom-0 left-0 z-40 cursor-pointer lg:flex hidden"},X=e("div",{class:"swiper-pagination-custom lg:hidden flex items-center justify-center py-2"},null,-1),Y=["href"],Z={class:"relative group"},ee={class:"flex items-stretch justify-center w-full !h-52"},te={key:0,class:"relative w-full"},se=["src","alt"],le={key:1,class:"text-3xl w-full flex items-stretch justify-center bg-gray-300"},oe=e("div",{class:"absolute bottom-0 z-30 w-full h-full overflow-hidden"},[e("div",{class:"absolute bottom-0 max-h-0 group-hover:max-h-full h-full w-full overflow-hidden group-hover:p-1 transition-full duration-500 bg-primary-100 text-center flex flex-col items-center justify-center bg-opacity-80 text-white"},[e("span",{class:"px-4 py-2 rounded border border-primary-300 bg-primary-100 text-primary-300 font-bold"},"D\xE9couvrir la collection")])],-1),ie={class:"bg-white px-4 py-2 w-full"},re={class:"font-bold lg:text-lg text-sm flex flex-col justify-center text-center"},ne=e("span",null,"Collection",-1),ae={class:"font-bold text-gray-400 flex flex-col justify-center text-center"},ce=e("span",null,"Prix au m\xB2 : ",-1),ue={layout:(c,u)=>c(g,()=>child),layout:g},xe=Object.assign(ue,{__name:"Home_old",props:["bandeau","coupDeCoeur","news","best","hey","lost"],setup(c){const u=c;w(j().props.value.auth.user[0].client);var _=w(j().props.value.session.typeVente),m=_.value==1?"/order_entrepot/gamme/":"/dropshipping/gamme/";const f=s=>HtmlEntities.decode(s.toLowerCase());return(s,pe)=>{const x=k("swiper-slide"),h=k("swiper");return l(),i(d,null,[o(n(V),{title:"Accueil"}),e("section",z,[e("div",A,[e("h1",D,r(s.$page.props.auth.user[0].client.nom_societe)+" - "+r(s.$t("accueil.titre_principal"))+" - "+r(n(_)==1?"Commandes entrep\xF4t":"Dropshipping"),1),E]),e("div",H,[N,o(h,{modules:[s.Navigation,s.Pagination,s.Scrollbar,s.A11y],"slides-per-view":3,"space-between":40,breakpoints:{1280:{slidesPerView:3},640:{slidesPerView:2},0:{slidesPerView:1}},pagination:{clickable:!0,el:".swiper-pagination-custom",bulletActiveClass:"opacity-full",bulletClass:"swiper-pagination-bullet mx-2 !bg-primary-300",type:"bullets"},scrollbar:{draggable:!0},navigation:{nextEl:".swiper-button-prev-custom",prevEl:".swiper-button-next-custom",disabledClass:"lg:hidden"},class:"lg:!px-10 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative"},{default:a(()=>[e("div",B,[o(v,{class:"!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100"})]),e("div",L,[o(y,{class:"!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100"})]),S,(l(!0),i(d,null,C(n(u).latestCollection,(t,p)=>(l(),P(x,{class:"lg:px-2",key:p},{default:a(()=>[e("a",{href:n(m)+f(t.nom_gamme),class:"group h-full flex flex-col relative border border-primary-200 hover:scale-105 transition-all duration-300"},[e("div",$,[e("div",F,[t.img_gamme!=null?(l(),i("div",O,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/gamme/"+t.img_gamme,alt:t.nom_gamme,class:"z-20 rounded relative w-full h-full object-cover"},null,8,R)])):(l(),i("div",J,[o(b)]))]),K]),e("div",M,[e("h3",W," Collection "+r(t.nom_gamme),1),e("span",q,"Prix au m\xB2 : "+r(t.prix_vente_ht_m2_remise?t.prix_vente_ht_m2_remise:t.prix_vente_ht_m2)+" \u20AC",1)])],8,I)]),_:2},1024))),128))]),_:1},8,["modules","pagination","navigation"])]),G,e("div",null,[Q,o(h,{modules:[s.Navigation,s.Pagination,s.Scrollbar,s.A11y],"slides-per-view":6,"space-between":40,breakpoints:{1536:{slidesPerView:6},1280:{slidesPerView:5},1024:{slidesPerView:4},640:{slidesPerView:3},460:{slidesPerView:2},0:{slidesPerView:1}},pagination:{clickable:!0,el:".swiper-pagination-custom",bulletActiveClass:"opacity-full",bulletClass:"swiper-pagination-bullet mx-2 !bg-primary-300",type:"bullets"},scrollbar:{draggable:!0},navigation:{nextEl:".swiper-button-prev-custom",prevEl:".swiper-button-next-custom",disabledClass:"lg:hidden"},class:"lg:!px-10 !px-0 lg:!py-2 lg:!pt-4 !py-2 !relative"},{default:a(()=>[e("div",T,[o(v,{class:"!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100"})]),e("div",U,[o(y,{class:"!h-6 !w-12 text-5xl flex items-center justify-center text-primary-100"})]),X,(l(!0),i(d,null,C(n(u).bestSeller,(t,p)=>(l(),P(x,{class:"lg:px-2",key:p},{default:a(()=>[e("a",{href:n(m)+f(t.nom_gamme),class:"h-full flex flex-col relative border border-primary-200 hover:scale-105 transition-all duration-300"},[e("div",Z,[e("div",ee,[t.img_gamme!=null?(l(),i("div",te,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/gamme/"+t.img_gamme,alt:t.nom_gamme,class:"z-20 rounded relative w-full h-full object-cover"},null,8,se)])):(l(),i("div",le,[o(b)]))]),oe]),e("div",ie,[e("h3",re,[ne,e("span",null,r(t.nom_gamme),1)]),e("span",ae,[ce,e("span",null,r(t.prix_vente_ht_m2_remise?t.prix_vente_ht_m2_remise:t.prix_vente_ht_m2)+" \u20AC",1)])])],8,Y)]),_:2},1024))),128))]),_:1},8,["modules","pagination","navigation"])])])],64)}}});export{xe as default};
