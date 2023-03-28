import{I as j,D as B,_ as L}from"./AuthenticatedLayout.a4af934e.js";import{o as a,a as o,f as t,z as x,P as p,B as E,u as i,F as C,K as S,d as m,t as h,k as y,b as P,R as V,Q as F,H}from"./app.31a87575.js";import{_ as U}from"./EtapeOrder.aca9f9a6.js";import{_ as z,a as M}from"./ResumeOrderVertical.366a6098.js";import{_ as A}from"./InputNumber.2bcddc53.js";import{r as N}from"./ExclamationCircleIcon.2df2372d.js";import"./LangueChoice.e846ebb0.js";function I(v,f){return a(),o("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[t("path",{"fill-rule":"evenodd",d:"M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z","clip-rule":"evenodd"})])}const Q={key:0,class:"w-full h-90"},O={class:"sm:col-span-2 xsm:col-span-3 col-span-4 flex items-center justify-center"},K={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},R=["src","alt"],G={key:1,class:"text-3xl m-2 lg:h-[150px] sm:h-[130px] h-full w-full flex items-stretch justify-center bg-gray-300"},J={class:"sm:col-span-10 xsm:col-span-9 col-span-8 flex flex-col xl:text-lg text-sm"},W={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},X={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Y={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Z={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},D={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},ee={class:"grid grid-cols-8"},te={class:"xl:col-span-5 col-span-4 w-full h-8 bg-gray-300 flex items-center justify-center rounded"},ie={key:0,class:"editQteForm w-full h-full"},se=["value"],ne=["value"],re=["value"],ae=["value"],le=["value"],oe={class:"xl:col-span-3 col-span-4 sm:mx-4 mx-2"},de=["onClick"],ce={key:1,class:"flex items-center justify-center h-full"},ue=t("span",null,"Votre panier est vide !",-1),_e=[ue],pe={__name:"CartEntrepot",props:["produits","panier"],setup(v){const f=v;var l=x(f.produits),c=x(p().props.value.auth.user[0].client);const u=(_,r)=>_.toFixed(r),b=(_,r)=>{var e=void 0;return _.forEach(n=>{n.classList!=null&&n.classList.length>0&&n.classList.contains(r)&&(e=n)}),e};var $=_=>(Math.round(_*100)/100).toFixed(2),g=_=>{var r=_;return c.value.taux_remise>0&&(r=r-r*(c.value.taux_remise/100)),$(r)},T=(_,r)=>{_.preventDefault();var e=b(_.path,"editQteForm");if(e!=null){var n=new FormData(e);P({idProduit:n.get("id_produit"),quantiter:n.get("qte"),id_panier_edi_list:n.get("id_panier_edi_list"),id_panier_edi:n.get("id_panier_edi"),id_client_edi:n.get("id_client_edi")}).post(route("cart/products/edit"),{preserveScroll:!0,preserveState:!0,onSuccess:s=>{s.props.session.status?(l.value[n.get("key_tab")].panier.id_panier_edi_list=s.props.session.id_panier_edi_list,l.value[n.get("key_tab")].isInPanier=!0,l.value[n.get("key_tab")].panier.quantiter=n.get("qte"),Toast.fire({icon:"success",title:"La quantiter du produit "+r+" \xE0 bien \xE9t\xE9 modifier"})):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la modification de la quantiter du produit."})}})}},q=(_,r,e)=>{Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer cette article du panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(n=>{n.isConfirmed&&P({id_panier_edi_list:_,id_panier_edi:r}).post(route("cart/products/delete"),{preserveScroll:!0,onSuccess:s=>{s.props.session.status?Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer du panier"}):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la supression du produit du panier"})}})})};return E(()=>{l.value=p().props.value.Panier.panier.panier}),(_,r)=>i(l)!=null?(a(),o("div",Q,[(a(!0),o(C,null,S(i(l),(e,n)=>(a(),o("div",{key:n,class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},[t("div",O,[e.photo!=null?(a(),o("div",K,[t("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+e.photo.img_produit,alt:e.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,R)])):(a(),o("div",G,[m(j)]))]),t("div",J,[t("span",W,"SKU : "+h(e.code_sku),1),t("span",X,"Taille : "+h(e.dimension.largeur+"x"+e.dimension.longueur),1),t("span",Y,"Prix du M\xB2 : "+h(i(g)(e.gamme.prix_vente_ht_m2))+" \u20AC HT",1),t("span",Z,"M\xB2 : "+h(u(e.dimension.largeur/100*(e.dimension.longueur/100)*e.panier.quantiter,2))+" m\xB2",1),t("span",D,"Prix HT : "+h(u(e.dimension.largeur/100*(e.dimension.longueur/100)*e.panier.quantiter*i(g)(e.gamme.prix_vente_ht_m2),2))+" \u20AC",1),t("div",ee,[t("div",te,[e.stats_produit.stock_restant>0?(a(),o("form",ie,[m(A,{onChange:d=>i(T)(d,e.design.nom_design+e.dimension.largeur+"x"+e.dimension.longueur),name:"qte",max:e.stats_produit.stock_restant,value:e.panier.quantiter>0?e.panier.quantiter:1,class:"h-full"},null,8,["onChange","max","value"]),t("input",{type:"hidden",name:"id_produit",value:e.id_produit},null,8,se),t("input",{type:"hidden",name:"id_panier_edi_list",value:e.panier.id_panier_edi_list!=null?e.panier.id_panier_edi_list:0},null,8,ne),t("input",{type:"hidden",name:"key_tab",value:n},null,8,re),t("input",{type:"hidden",name:"id_panier_edi",value:i(f).panier.id_panier_edi!=null?i(f).panier.id_panier_edi:0},null,8,ae),t("input",{type:"hidden",name:"id_client_edi",value:e.panier.id_client_edi!=null?e.panier.id_client_edi:0},null,8,le)])):y("",!0)]),t("div",oe,[t("button",{type:"button",onClick:d=>i(q)(e.panier.id_panier_edi_list!=null?e.panier.id_panier_edi_list:0,i(f).panier.id_panier_edi!=null?i(f).panier.id_panier_edi:0,n),class:"w-full bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full"},[m(B,{class:"text-white"})],8,de)])])])]))),128))])):(a(),o("div",ce,_e))}},me={key:0,class:"w-full h-90"},fe={class:"flex items-center justify-center"},he={class:"font-bold text-center text-xl py-1"},ve=["onClick"],xe={class:"sm:col-span-2 xsm:col-span-3 col-span-4 flex items-center justify-center"},ge={key:0,class:"lg:h-[150px] sm:h-[130px] h-full w-full px-2"},ye=["src","alt"],be={key:1,class:"text-3xl m-2 lg:h-[150px] sm:h-[130px] h-full w-full flex items-stretch justify-center bg-gray-300"},ke={class:"sm:col-span-10 xsm:col-span-9 col-span-8 flex flex-col xl:text-lg text-sm"},we={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},$e={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Ce={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Pe={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},Te={class:"text-gray-600 sm:text-sm text-[0.700rem] font-bold"},qe={class:"grid grid-cols-8"},Be={class:"xl:col-span-5 col-span-4 w-full h-8 bg-gray-300 flex items-center justify-center rounded"},Se={key:0,class:"editQteForm w-full h-full"},Ee=["value"],Le=["value"],Fe=["value"],je=["value"],Ae=["value"],Ve={class:"xl:col-span-3 col-span-4 sm:mx-4 mx-2"},He=["onClick"],Ue={key:1,class:"text-center py-5"},ze=t("span",{class:"text-lg"},"Le panier de se client est vide !",-1),Me=[ze],Ne={key:1,class:"flex items-center justify-center h-full"},Ie=t("span",null,"Votre panier est vide !",-1),Qe=[Ie],Oe={__name:"CartDropshipping",props:["panier"],setup(v){var l=x(v.panier),c=x(p().props.value.auth.user[0].client);const u=(r,e)=>r.toFixed(e),b=(r,e)=>{var n=void 0;return r.forEach(d=>{d.classList!=null&&d.classList.length>0&&d.classList.contains(e)&&(n=d)}),n};var $=r=>(Math.round(r*100)/100).toFixed(2),g=r=>{var e=r;return c.value.taux_remise>0&&(e=e-e*(c.value.taux_remise/100)),$(e)},T=(r,e,n)=>{r.preventDefault();var d=b(r.path,"editQteForm");if(d!=null){var s=new FormData(d);P({idProduit:s.get("id_produit"),quantiter:s.get("qte"),id_panier_edi_list:s.get("id_panier_edi_list"),id_panier_edi:s.get("id_panier_edi"),id_client_edi:s.get("id_client_edi")}).post(route("dropshipping/cart/products/edit"),{preserveScroll:!0,preserveState:!0,onSuccess:w=>{w.props.session.status?(console.log(l.value.clients[n]),l.value.clients[n].produits[s.get("key_tab")].id_panier_edi_list=w.props.session.id_panier_edi_list,l.value.clients[n].produits[s.get("key_tab")].isInPanier=!0,l.value.clients[n].produits[s.get("key_tab")].quantiter=s.get("qte"),Toast.fire({icon:"success",title:"La quantiter du produit "+e+" \xE0 bien \xE9t\xE9 modifier"})):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la modification de la quantiter du produit."})}})}},q=(r,e,n)=>{Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer cette article du panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(d=>{d.isConfirmed&&P({id_panier_edi_list:r,id_panier_edi:e}).post(route("dropshipping/cart/products/delete"),{preserveScroll:!0,onSuccess:k=>{k.props.session.status?Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer du panier"}):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la supression du produit du panier"})}})})},_=(r,e,n)=>{r.preventDefault(),Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer la commande client "+n+" ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(d=>{d.isConfirmed&&V.Inertia.post("/dropshipping/cart/client/delete",{id_client_edi:e,id_panier_edi:l.value.id_panier_edi},{onSuccess:s=>{s.props.session.status==!0?Toast.fire({icon:"success",title:"La commande client "+n+" \xE0 bien \xE9t\xE9 suprimmer !"}):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la supression de la commande client"+n+", veuillez ressayer !"})}})})};return E(()=>{l.value=p().props.value.PanierDrop.panier}),(r,e)=>i(l).clients!=null?(a(),o("div",me,[(a(!0),o(C,null,S(i(l).clients,(n,d)=>(a(),o("div",{key:d,class:"w-full lg:p-4 sm:p-3 p-2 my-2 bg-gray-100 rounded"},[t("div",fe,[t("h2",he,"Commande : "+h(n.client.ref_externe),1),t("button",{type:"button",onClick:s=>i(_)(s,n.client.id_client_edi!=null?n.client.id_client_edi:0,n.client.ref_externe),class:"mx-2 w-10 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full"},[m(B,{class:"text-white"})],8,ve)]),n.nbProduit>0?(a(!0),o(C,{key:0},S(n.produits,(s,k)=>(a(),o("div",{key:k,class:"grid grid-cols-12 py-4"},[t("div",xe,[s.photo!=null?(a(),o("div",ge,[t("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+s.photo.img_produit,alt:s.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,ye)])):(a(),o("div",be,[m(j)]))]),t("div",ke,[t("span",we,"SKU : "+h(s.code_sku),1),t("span",$e,"Taille : "+h(s.dimension.largeur+"x"+s.dimension.longueur),1),t("span",Ce,"Prix du M\xB2 : "+h(i(g)(s.gamme.prix_vente_ht_m2))+" \u20AC HT",1),t("span",Pe,"M\xB2 : "+h(u(s.dimension.largeur/100*(s.dimension.longueur/100)*s.panier.quantiter,2))+" m\xB2",1),t("span",Te,"Prix HT : "+h(u(s.dimension.largeur/100*(s.dimension.longueur/100)*s.panier.quantiter*i(g)(s.gamme.prix_vente_ht_m2),2))+" \u20AC",1),t("div",qe,[t("div",Be,[s.stats_produit.stock_restant>0?(a(),o("form",Se,[m(A,{onChange:w=>i(T)(w,s.design.nom_design+s.dimension.largeur+"x"+s.dimension.longueur,d),name:"qte",max:s.stats_produit.stock_restant,value:s.quantiter>0?s.quantiter:1,class:"h-full"},null,8,["onChange","max","value"]),t("input",{type:"hidden",name:"id_produit",value:s.id_produit},null,8,Ee),t("input",{type:"hidden",name:"id_panier_edi_list",value:s.id_panier_edi_list!=null?s.id_panier_edi_list:0},null,8,Le),t("input",{type:"hidden",name:"key_tab",value:k},null,8,Fe),t("input",{type:"hidden",name:"id_panier_edi",value:i(l).id_panier_edi!=null?i(l).id_panier_edi:0},null,8,je),t("input",{type:"hidden",name:"id_client_edi",value:n.client.id_client_edi!=null?n.client.id_client_edi:0},null,8,Ae)])):y("",!0)]),t("div",Ve,[t("button",{type:"button",onClick:w=>i(q)(s.panier.id_panier_edi_list!=null?s.panier.id_panier_edi_list:0,i(l).id_panier_edi!=null?i(l).id_panier_edi:0,r.key),class:"w-full bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full"},[m(B,{class:"text-white"})],8,He)])])])]))),128)):(a(),o("div",Ue,Me))]))),128))])):(a(),o("div",Ne,Qe))}},Ke={class:"container mx-auto mt-5"},Re=t("h1",{class:"font-semibold text-lg lg:text-2xl sm:text-xl text-gray-800 text-center py-2"},"Panier",-1),Ge={class:"grid grid-cols-4"},Je={class:"xl:col-span-1 col-span-4"},We={class:"xl:col-span-2 lg:col-span-3 col-span-4 flex flex-col items-start mt-2"},Xe={key:0,class:"w-full bg-red-200 px-4 py-2 rounded flex items-center"},Ye={class:"pl-2 text-red-600"},Ze={key:1,class:"w-full bg-yellow-200 px-4 py-2 rounded flex items-center"},De=t("span",{class:"pl-2 text-yellow-600"},"Pour continuer, veuillez ajouter au minimum un produit pour chaque commande.",-1),et={class:"lg:hidden block col-span-4"},tt={class:"lg:block hidden col-span-1 ml-5"},it={layout:(v,f)=>v(L,()=>child),layout:L},ct=Object.assign(it,{__name:"Cart",props:["panier","produits"],setup(v){const f=v;console.log(p().props.value.session);var l=x(p().props.value.Panier.panier.panier),c=x(p().props.value.PanierDrop),u=x(p().props.value.session.typeVente),b=["Panier","Adresse Livraison / Facturation","Finaliser commande"];return E(()=>{l.value=p().props.value.Panier.panier.panier,c.value=p().props.value.PanierDrop,u.value=p().props.value.session.typeVente}),($,g)=>(a(),o(C,null,[m(i(H),{title:"Panier"}),t("section",Ke,[Re,t("div",Ge,[t("div",Je,[m(U,{etape:1,nbEtape:3,listeEtape:i(b)},null,8,["listeEtape"])]),t("div",We,[i(p)().props.value.session.messageError!=null?(a(),o("div",Xe,[m(i(I),{class:"h-8 w-8 text-red-600"}),t("span",Ye,h(i(p)().props.value.session.messageError),1)])):y("",!0),!i(c).panier.panier_valid&&i(u)==2?(a(),o("div",Ze,[m(i(N),{class:"h-8 w-8 text-yellow-600"}),De])):y("",!0),i(u)==1?(a(),F(pe,{key:2,produits:i(l),panier:f.panier},null,8,["produits","panier"])):y("",!0),i(u)==2?(a(),F(Oe,{key:3,panier:i(c)},null,8,["panier"])):y("",!0)]),t("div",et,[m(z,{disabled:i(u)==2&&i(c).panier!=null?!i(c).panier.panier_valid:!1,linkEtapeSuivant:i(u)==1?"/cart/adresses":"/dropshipping/cart/adresses",titreLink:"Valider la commande",panier:i(u)==1?f.panier:i(c).panier.panierActuel!=null?i(c).panier.panierActuel:void 0,isButtonSubmit:!1},null,8,["disabled","linkEtapeSuivant","panier"])]),t("div",tt,[m(M,{disabled:i(u)==2&&i(c).panier!=null?!i(c).panier.panier_valid:!1,linkEtapeSuivant:i(u)==1?"/cart/adresses":"/dropshipping/cart/adresses",titreLink:"Valider la commande",panier:i(u)==1?f.panier:i(c).panier.panierActuel!=null?i(c).panier.panierActuel:void 0,isButtonSubmit:!1},null,8,["disabled","linkEtapeSuivant","panier"])])])])],64))}});export{ct as default};
