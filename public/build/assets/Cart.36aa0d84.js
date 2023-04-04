import{I as V,D as H,_ as j}from"./AuthenticatedLayout.b11428e9.js";import{o as r,a,f as e,A as y,I as g,C as q,u as t,J as E,k as v,F as L,K as T,d as h,t as f,b as B,N as F,h as z,H as N}from"./app.ac693634.js";import{_ as U}from"./EtapeOrder.6b136e47.js";import{_ as I,a as Q}from"./ResumeOrderVertical.d690eb35.js";import{_ as M}from"./InputNumber.b2718f11.js";import{r as O}from"./ExclamationCircleIcon.cf924324.js";import"./flag-icons.min.3dbbb609.js";function K(x,u){return r(),a("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z","clip-rule":"evenodd"})])}function S(x,u){return r(),a("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z","clip-rule":"evenodd"})])}const R={key:0,class:"w-full bg-red-200 px-4 py-2 rounded flex items-center"},Z={key:1,class:"pl-2 text-red-600"},J={key:1,class:"sm:my-4 rounded-lg border shadow-lg p-10 w-full h-90"},D={class:"sm:col-span-2 xsm:col-span-3 col-span-4 flex items-center justify-center"},G={key:0,class:"h-full w-full lg:max-h-52 max-h-42 px-2"},W=["src","alt"],X={key:1,class:"text-3xl m-2 lg:h-[150px] sm:h-[130px] h-full w-full flex items-stretch justify-center bg-gray-300"},Y={class:"sm:col-span-10 xsm:col-span-9 col-span-8 flex flex-col xl:text-lg text-sm"},ee={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},te={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},ie={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},se={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},ne={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},re={class:"grid grid-cols-8 lg:w-1/2"},ae={class:"xl:col-span-5 col-span-4 w-full h-8 bg-gray-300 flex items-center justify-center rounded"},le={key:0,class:"editQteForm w-full h-full"},oe=["value"],de=["value"],ce=["value"],ue=["value"],pe=["value"],_e={class:"xl:col-span-3 col-span-4 sm:mx-4 mx-2"},me=["onClick"],he={key:2,class:"sm:my-4 flex items-center justify-center w-full h-full"},fe=e("div",{class:"rounded-lg border p-8 sm:m-0 m-4 shadow-lg flex flex-col items-center justify-center w-full h-full"},[e("span",{class:"material-design-icon cart-remove-icon !w-24 !h-24 text-gray-400",role:"img"},[e("svg",{class:"material-design-icon__svg !w-24 !h-24",width:"24",height:"24",viewBox:"0 0 24 24"},[e("path",{d:"M14.12,8.53L12,6.41L9.88,8.54L8.46,7.12L10.59,5L8.47,2.88L9.88,1.47L12,3.59L14.12,1.46L15.54,2.88L13.41,5L15.53,7.12L14.12,8.53M7,18A2,2 0 0,1 9,20A2,2 0 0,1 7,22A2,2 0 0,1 5,20A2,2 0 0,1 7,18M17,18A2,2 0 0,1 19,20A2,2 0 0,1 17,22A2,2 0 0,1 15,20A2,2 0 0,1 17,18M7.17,14.75A0.25,0.25 0 0,0 7.42,15H19V17H7A2,2 0 0,1 5,15C5,14.65 5.09,14.32 5.25,14.04L6.6,11.59L3,4H1V2H4.27L5.21,4L6.16,6L8.4,10.73L8.53,11H15.55L18.31,6L19.41,4H19.42L21.16,4.96L17.3,11.97C16.96,12.59 16.3,13 15.55,13H8.1L7.2,14.63L7.17,14.75Z"})])]),e("h2",{class:"mt-6 text-3xl font-medium text-gray-900"},"Votre panier est vide"),e("p",{class:"mt-4 text-gray-500 text-center"},"Vous n'avez pas encore ajout\xE9 d'articles \xE0 votre panier."),e("a",{href:"/order_entrepot/gamme",class:"bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded mt-6 sm:w-auto animate-bounce transition-all duration-300"}," Ajouter au panier ")],-1),ge=[fe],ve={__name:"CartEntrepot",props:["produits","panier"],setup(x){const u=x;var o=y(u.produits),p=y(g().props.value.auth.user[0].client);const d=(_,m)=>_.toFixed(m),b=(_,m)=>{var i=void 0;return _.forEach(n=>{n.classList!=null&&n.classList.length>0&&n.classList.contains(m)&&(i=n)}),i};var k=_=>(Math.round(_*100)/100).toFixed(2),w=_=>{var m=_;return p.value.taux_remise>0&&(m=m-m*(p.value.taux_remise/100)),k(m)},$=(_,m)=>{_.preventDefault();var i=b(_.path,"editQteForm");if(i!=null){var n=new FormData(i);B({idProduit:n.get("id_produit"),quantiter:n.get("qte"),id_panier_edi_list:n.get("id_panier_edi_list"),id_panier_edi:n.get("id_panier_edi"),id_client_edi:n.get("id_client_edi")}).post(route("cart/products/edit"),{preserveScroll:!0,preserveState:!0,onSuccess:c=>{c.props.session.status?(o.value[n.get("key_tab")].panier.id_panier_edi_list=c.props.session.id_panier_edi_list,o.value[n.get("key_tab")].isInPanier=!0,o.value[n.get("key_tab")].panier.quantiter=n.get("qte"),Toast.fire({icon:"success",title:"La quantiter du produit "+m+" \xE0 bien \xE9t\xE9 modifier"})):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la modification de la quantiter du produit."})}})}},P=(_,m,i)=>{Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer cette article du panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(n=>{n.isConfirmed&&B({id_panier_edi_list:_,id_panier_edi:m}).post(route("cart/products/delete"),{preserveScroll:!0,onSuccess:c=>{c.props.session.status?Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer du panier"}):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la supression du produit du panier"})}})})};return q(()=>{o.value=g().props.value.Panier.panier.panier}),console.log(u.panier),(_,m)=>(r(),a(L,null,[t(u).panier.is_validate?(r(),a("div",R,[t(u).panier.is_validate?(r(),E(t(S),{key:0,class:"h-8 w-8 text-red-600"})):v("",!0),t(u).panier.is_validate?(r(),a("span",Z,"Votre panier a d\xE9j\xE0 \xE9t\xE9 valider, vous pouvez aller dans Exp\xE9ditions pour voir les d\xE9tails de votre commande.")):v("",!0)])):v("",!0),t(o)!=null?(r(),a("div",J,[(r(!0),a(L,null,T(t(o),(i,n)=>(r(),a("div",{key:n,class:"w-full lg:p-4 sm:p-3 p-2 grid bg-gray-100 rounded grid-cols-12 my-2"},[e("div",D,[i.photo!=null?(r(),a("div",G,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+i.photo.img_produit,alt:i.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,W)])):(r(),a("div",X,[h(V)]))]),e("div",Y,[e("span",ee,"SKU : "+f(i.code_sku),1),e("span",te,"Taille : "+f(i.dimension.largeur+"x"+i.dimension.longueur),1),e("span",ie,"Prix du M\xB2 : "+f(t(w)(i.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",se,"M\xB2 : "+f(d(i.dimension.largeur/100*(i.dimension.longueur/100)*i.panier.quantiter,2))+" m\xB2",1),e("span",ne,"Prix HT : "+f(d(i.dimension.largeur/100*(i.dimension.longueur/100)*i.panier.quantiter*t(w)(i.gamme.prix_vente_ht_m2),2))+" \u20AC",1),e("div",re,[e("div",ae,[i.stats_produit.stock_restant>0?(r(),a("form",le,[h(M,{onChange:l=>t($)(l,i.design.nom_design+i.dimension.largeur+"x"+i.dimension.longueur),name:"qte",max:i.stats_produit.stock_restant,value:i.panier.quantiter>0?i.panier.quantiter:1,class:"h-full"},null,8,["onChange","max","value"]),e("input",{type:"hidden",name:"id_produit",value:i.id_produit},null,8,oe),e("input",{type:"hidden",name:"id_panier_edi_list",value:i.panier.id_panier_edi_list!=null?i.panier.id_panier_edi_list:0},null,8,de),e("input",{type:"hidden",name:"key_tab",value:n},null,8,ce),e("input",{type:"hidden",name:"id_panier_edi",value:t(u).panier.id_panier_edi!=null?t(u).panier.id_panier_edi:0},null,8,ue),e("input",{type:"hidden",name:"id_client_edi",value:i.panier.id_client_edi!=null?i.panier.id_client_edi:0},null,8,pe)])):v("",!0)]),e("div",_e,[e("button",{type:"button",onClick:l=>t(P)(i.panier.id_panier_edi_list!=null?i.panier.id_panier_edi_list:0,t(u).panier.id_panier_edi!=null?t(u).panier.id_panier_edi:0,n),class:"w-full bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full"},[h(H,{class:"text-white"})],8,me)])])])]))),128))])):(r(),a("div",he,ge))],64))}},xe={key:0,class:"w-full bg-red-200 px-4 py-2 rounded flex items-center my-2"},ye={key:1,class:"pl-2 text-red-600"},be={key:1,class:"sm:my-4 rounded-lg border shadow-lg p-10 w-full h-90"},we={class:"flex items-center justify-center"},Le={class:"font-bold text-center text-xl py-1"},ke=["onClick"],$e={class:"sm:col-span-2 xsm:col-span-3 col-span-4 flex items-center justify-center"},Ce={key:0,class:"h-full w-full lg:max-h-52 max-h-42 px-2"},Ae=["src","alt"],Pe={key:1,class:"text-3xl m-2 lg:h-[150px] sm:h-[130px] h-full w-full flex items-stretch justify-center bg-gray-300"},Ee={class:"sm:col-span-10 xsm:col-span-9 col-span-8 flex flex-col xl:text-lg text-sm"},Be={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},He={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},Te={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},qe={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},Se={class:"text-gray-600 sm:text-lg text-[0.700rem] font-bold"},je={class:"grid grid-cols-8 lg:w-1/2"},Ve={class:"xl:col-span-5 col-span-4 w-full h-8 bg-gray-300 flex items-center justify-center rounded"},Me={key:0,class:"editQteForm w-full h-full"},Fe=["value"],ze=["value"],Ne=["value"],Ue=["value"],Ie=["value"],Qe={class:"xl:col-span-3 col-span-4 sm:mx-4 mx-2"},Oe=["onClick"],Ke={key:1,class:"text-center py-5"},Re=e("span",{class:"text-lg"},"Le panier de se client est vide !",-1),Ze=[Re],Je={key:2,class:"sm:my-4 flex items-center justify-center w-full h-full"},De=e("div",{class:"rounded-lg border p-8 sm:m-0 m-4 shadow-lg flex flex-col items-center justify-center w-full h-full"},[e("span",{class:"material-design-icon cart-remove-icon !w-24 !h-24 text-gray-400",role:"img"},[e("svg",{class:"material-design-icon__svg !w-24 !h-24",width:"24",height:"24",viewBox:"0 0 24 24"},[e("path",{d:"M14.12,8.53L12,6.41L9.88,8.54L8.46,7.12L10.59,5L8.47,2.88L9.88,1.47L12,3.59L14.12,1.46L15.54,2.88L13.41,5L15.53,7.12L14.12,8.53M7,18A2,2 0 0,1 9,20A2,2 0 0,1 7,22A2,2 0 0,1 5,20A2,2 0 0,1 7,18M17,18A2,2 0 0,1 19,20A2,2 0 0,1 17,22A2,2 0 0,1 15,20A2,2 0 0,1 17,18M7.17,14.75A0.25,0.25 0 0,0 7.42,15H19V17H7A2,2 0 0,1 5,15C5,14.65 5.09,14.32 5.25,14.04L6.6,11.59L3,4H1V2H4.27L5.21,4L6.16,6L8.4,10.73L8.53,11H15.55L18.31,6L19.41,4H19.42L21.16,4.96L17.3,11.97C16.96,12.59 16.3,13 15.55,13H8.1L7.2,14.63L7.17,14.75Z"})])]),e("h2",{class:"mt-6 text-3xl font-medium text-gray-900"},"Votre panier est vide"),e("p",{class:"mt-4 text-gray-500 text-center"},"Vous n'avez pas encore ajout\xE9 d'articles \xE0 votre panier."),e("a",{href:"/dropshipping/gamme",class:"bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded mt-6 sm:w-auto animate-bounce transition-all duration-300"}," Ajouter au panier ")],-1),Ge=[De],We={__name:"CartDropshipping",props:["panier"],setup(x){var o=y(x.panier),p=y(g().props.value.auth.user[0].client),d=o.value.panier.panierActuel!=null?o.value.panier.panierActuel.is_validate:void 0;const b=(i,n)=>i.toFixed(n),k=(i,n)=>{var l=void 0;return i.forEach(c=>{c.classList!=null&&c.classList.length>0&&c.classList.contains(n)&&(l=c)}),l};var w=i=>(Math.round(i*100)/100).toFixed(2),$=i=>{var n=i;return p.value.taux_remise>0&&(n=n-n*(p.value.taux_remise/100)),w(n)},P=(i,n,l)=>{i.preventDefault();var c=k(i.path,"editQteForm");if(c!=null){var s=new FormData(c);B({idProduit:s.get("id_produit"),quantiter:s.get("qte"),id_panier_edi_list:s.get("id_panier_edi_list"),id_panier_edi:s.get("id_panier_edi"),id_client_edi:s.get("id_client_edi")}).post(route("dropshipping/cart/products/edit"),{preserveScroll:!0,preserveState:!0,onSuccess:A=>{A.props.session.status?(console.log(o.value.clients[l]),o.value.clients[l].produits[s.get("key_tab")].id_panier_edi_list=A.props.session.id_panier_edi_list,o.value.clients[l].produits[s.get("key_tab")].isInPanier=!0,o.value.clients[l].produits[s.get("key_tab")].quantiter=s.get("qte"),Toast.fire({icon:"success",title:"La quantiter du produit "+n+" \xE0 bien \xE9t\xE9 modifier"})):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la modification de la quantiter du produit."})}})}},_=(i,n,l)=>{Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer cette article du panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(c=>{c.isConfirmed&&B({id_panier_edi_list:i,id_panier_edi:n}).post(route("dropshipping/cart/products/delete"),{preserveScroll:!0,onSuccess:C=>{C.props.session.status?Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer du panier"}):Toast.fire({icon:"error",title:"Une erreur c'est produit lors de la supression du produit du panier"})}})})},m=(i,n,l)=>{i.preventDefault(),Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer la commande client "+l+" ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(c=>{c.isConfirmed&&F.Inertia.post("/dropshipping/cart/client/delete",{id_client_edi:n,id_panier_edi:o.value.id_panier_edi},{onSuccess:s=>{s.props.session.status==!0?Toast.fire({icon:"success",title:"La commande client "+l+" \xE0 bien \xE9t\xE9 suprimmer !"}):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la supression de la commande client"+l+", veuillez ressayer !"})}})})};return q(()=>{o.value=g().props.value.PanierDrop.panier}),console.log(d),(i,n)=>(r(),a(L,null,[t(d)!=null&&t(d)?(r(),a("div",xe,[t(d)?(r(),E(t(S),{key:0,class:"h-8 w-8 text-red-600"})):v("",!0),t(d)?(r(),a("span",ye,"Votre panier a d\xE9j\xE0 \xE9t\xE9 valider, vous pouvez aller dans Exp\xE9ditions pour voir les d\xE9tails de votre commande.")):v("",!0)])):v("",!0),t(o).clients!=null?(r(),a("div",be,[(r(!0),a(L,null,T(t(o).clients,(l,c)=>(r(),a("div",{key:c,class:"w-full lg:p-4 sm:p-3 p-2 my-2 bg-gray-100 rounded"},[e("div",we,[e("h2",Le,"Commande : "+f(l.client.ref_externe),1),e("button",{type:"button",onClick:s=>t(m)(s,l.client.id_client_edi!=null?l.client.id_client_edi:0,l.client.ref_externe),class:"mx-2 w-10 bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full"},[h(H,{class:"text-white"})],8,ke)]),l.nbProduit>0?(r(!0),a(L,{key:0},T(l.produits,(s,C)=>(r(),a("div",{key:C,class:"grid grid-cols-12 py-4"},[e("div",$e,[s.photo!=null?(r(),a("div",Ce,[e("img",{src:"https://gestion.tapis-nazar.fr/img/produit/"+s.photo.img_produit,alt:s.code_sku,class:"w-full h-full object-cover rounded-xl"},null,8,Ae)])):(r(),a("div",Pe,[h(V)]))]),e("div",Ee,[e("span",Be,"SKU : "+f(s.code_sku),1),e("span",He,"Taille : "+f(s.dimension.largeur+"x"+s.dimension.longueur),1),e("span",Te,"Prix du M\xB2 : "+f(t($)(s.gamme.prix_vente_ht_m2))+" \u20AC HT",1),e("span",qe,"M\xB2 : "+f(b(s.dimension.largeur/100*(s.dimension.longueur/100)*s.panier.quantiter,2))+" m\xB2",1),e("span",Se,"Prix HT : "+f(b(s.dimension.largeur/100*(s.dimension.longueur/100)*s.panier.quantiter*t($)(s.gamme.prix_vente_ht_m2),2))+" \u20AC",1),e("div",je,[e("div",Ve,[s.stats_produit.stock_restant>0?(r(),a("form",Me,[h(M,{onChange:A=>t(P)(A,s.design.nom_design+s.dimension.largeur+"x"+s.dimension.longueur,c),name:"qte",max:s.stats_produit.stock_restant,value:s.quantiter>0?s.quantiter:1,class:"h-full"},null,8,["onChange","max","value"]),e("input",{type:"hidden",name:"id_produit",value:s.id_produit},null,8,Fe),e("input",{type:"hidden",name:"id_panier_edi_list",value:s.id_panier_edi_list!=null?s.id_panier_edi_list:0},null,8,ze),e("input",{type:"hidden",name:"key_tab",value:C},null,8,Ne),e("input",{type:"hidden",name:"id_panier_edi",value:t(o).id_panier_edi!=null?t(o).id_panier_edi:0},null,8,Ue),e("input",{type:"hidden",name:"id_client_edi",value:l.client.id_client_edi!=null?l.client.id_client_edi:0},null,8,Ie)])):v("",!0)]),e("div",Qe,[e("button",{type:"button",onClick:A=>t(_)(s.panier.id_panier_edi_list!=null?s.panier.id_panier_edi_list:0,t(o).id_panier_edi!=null?t(o).id_panier_edi:0,i.key),class:"w-full bg-red-500 text-white rounded hover:bg-red-300 transition duration-300 h-full"},[h(H,{class:"text-white"})],8,Oe)])])])]))),128)):(r(),a("div",Ke,Ze))]))),128))])):(r(),a("div",Je,Ge))],64))}},Xe={class:"container mx-auto mt-5"},Ye={class:"grid grid-cols-4"},et={class:"col-span-4"},tt={class:"col-span-4 grid grid-cols-4 xl:mx-16"},it={class:"lg:col-span-3 col-span-4 flex flex-col items-start mt-2"},st={key:0,class:"w-full bg-red-200 px-4 py-2 rounded flex items-center"},nt={class:"pl-2 text-red-600"},rt={key:1,class:"w-full bg-yellow-200 px-4 py-2 my-2 rounded flex items-center"},at=e("span",{class:"pl-2 text-yellow-600"},"Pour continuer, veuillez ajouter au minimum un produit pour chaque commande.",-1),lt={class:"relative grid grid-cols-12 w-full"},ot=["href"],dt={class:"col-span-12 w-full font-semibold text-lg lg:text-2xl sm:text-xl text-gray-800 text-center py-2 ml-12"},ct={class:"lg:hidden block col-span-4"},ut={class:"lg:block hidden col-span-1 ml-5"},pt={layout:(x,u)=>x(j,()=>child),layout:j},yt=Object.assign(pt,{__name:"Cart",props:["panier","produits"],setup(x){const u=x;var o=y(g().props.value.Panier.panier.panier),p=y(g().props.value.PanierDrop),d=y(g().props.value.session.typeVente),b=["Panier","Adresse Livraison / Facturation","Finaliser commande"],k=["/cart","/cart/adresses","/cart/validation"],w=["/dropshipping/cart","/dropshipping/cart/adresses","/dropshipping/cart/validation"];return q(()=>{o.value=g().props.value.Panier.panier.panier,p.value=g().props.value.PanierDrop,d.value=g().props.value.session.typeVente}),($,P)=>(r(),a(L,null,[h(t(N),{title:"Panier - "+(t(d)==1?"Commande Entrep\xF4t":"Dropshipping")},null,8,["title"]),e("section",Xe,[e("div",Ye,[e("div",et,[h(U,{hrefEtape:t(d)==1?t(k):t(w),etape:1,nbEtape:3,listeEtape:t(b)},null,8,["hrefEtape","listeEtape"])]),e("div",tt,[e("div",it,[t(g)().props.value.session.messageError!=null?(r(),a("div",st,[h(t(S),{class:"h-8 w-8 text-red-600"}),e("span",nt,f(t(g)().props.value.session.messageError),1)])):v("",!0),!t(p).panier.panier_valid&&t(d)==2?(r(),a("div",rt,[h(t(O),{class:"h-8 w-8 text-yellow-600"}),at])):v("",!0),e("div",lt,[e("a",{href:t(d)==1?"/order_entrepot/gamme":"/dropshipping/gamme",class:"lg:absolute left-0 top-1/4 bottom-1/4 transition duration-300 flex items-center lg:col-span-4 col-span-12 lg:text-lg text-sm lg:w-4/12 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1 rounded-full"},[h(t(K),{class:"w-5 h-4 inline-block mr-2",fill:"none",stroke:"currentColor"}),z(" Poursuivre mes achats ")],8,ot),e("h1",dt,"Panier - "+f(t(d)==1?"Commande Entrep\xF4t":"Dropshipping"),1)]),t(d)==1?(r(),E(ve,{key:2,produits:t(o),panier:u.panier},null,8,["produits","panier"])):v("",!0),t(d)==2?(r(),E(We,{key:3,panier:t(p)},null,8,["panier"])):v("",!0)]),e("div",ct,[h(I,{disabled:t(d)==2&&t(p).panier!=null?!t(p).panier.panier_valid:!1,linkEtapeSuivant:t(d)==1?"/cart/adresses":"/dropshipping/cart/adresses",titreLink:"Valider la commande",panier:t(d)==1?u.panier:t(p).panier.panierActuel!=null?t(p).panier.panierActuel:void 0,isButtonSubmit:!1},null,8,["disabled","linkEtapeSuivant","panier"])]),e("div",ut,[h(Q,{disabled:t(d)==2&&t(p).panier!=null?!t(p).panier.panier_valid:!1,linkEtapeSuivant:t(d)==1?"/cart/adresses":"/dropshipping/cart/adresses",titreLink:"Valider la commande",panier:t(d)==1?u.panier:t(p).panier.panierActuel!=null?t(p).panier.panierActuel:void 0,isButtonSubmit:!1},null,8,["disabled","linkEtapeSuivant","panier"])])])])])],64))}});export{yt as default};