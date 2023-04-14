import{o as a,a as u,f as e,A as v,I as J,b as A,B as K,C as W,d as o,u as t,t as p,h as b,F as k,J as S,e as m,H as X,n as Y,K as N,k as C,j as Z,w as j,g as P,N as ee}from"./app.c03a5653.js";import{r as te,E as se,C as ie}from"./CartPlus.39493d8a.js";import{_ as $,I as re}from"./AuthenticatedLayout.3ca3455e.js";import{_ as oe}from"./Tooltip.f67c098f.js";import{r as ne,_ as ae}from"./Breadcrumbs.ed8b8bec.js";import{_ as B}from"./InputError.5b07ce6f.js";import{r as le}from"./ListBulletIcon.46c4dd48.js";import{r as de}from"./ArrowRightCircleIcon.638d6210.js";import{f as z,o as y}from"./transition.50880223.js";import{N as E,_ as M,U}from"./dialog.5f892bd1.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./micro-task.fe338338.js";import"./description.4a1684d3.js";function L(h,d){return a(),u("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M2.515 10.674a1.875 1.875 0 000 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 003-3V6.75a3 3 0 00-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374zM12.53 9.22a.75.75 0 10-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 101.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L15.31 12l1.72-1.72a.75.75 0 10-1.06-1.06l-1.72 1.72-1.72-1.72z","clip-rule":"evenodd"})])}const ue={class:"container mx-auto"},ce={class:"relative container mx-auto grid grid-cols-12 mb-4"},pe={class:"col-span-2 flex items-end"},me={href:"/order_entrepot/gamme",class:"relative inline-block group"},fe=e("span",{class:"inline-block border-b border-black pl-5 group-hover:text-primary-300 group-hover:border-primary-300 transition duration-300"},"Retourner aux gammes",-1),_e={class:"flex items-center justify-center col-span-7"},ve={class:"text-6xl font-bold"},xe={class:"col-span-3 rounded bg-primary-white border border-primary-100 text-center flex flex-col text-primary-300"},ge={class:"capitalize"},be={class:"sm:w-auto w-full py-2 flex items-center justify-center"},he=e("a",{href:"/cart",class:"py-2 px-4 ml-2 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},"Voir mon panier",-1),ye={class:"flex flex-col"},we={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},ke={class:"inline-block min-w-full py-2 sm:px-6 lg:px-8"},Ce={class:"min-w-full overflow-hidden border border-primary-200 p-4"},je={class:"text-left text-sm font-light"},Pe={class:"px-4 py-4"},Be={class:"whitespace-nowrap px-4 py-4"},Ie={class:"h-24 w-full mb-2"},qe={key:0,class:"cursor-pointer relative overflow-hidden w-full h-full flex justify-center"},Te={class:"absolute flex items-center justify-center w-full h-full"},Ve=["onClick","src","alt"],Ae={key:1,class:"text-3xl h-full w-full flex items-center justify-center bg-gray-300"},Se={class:"text-center w-full"},Ne={class:"font-bold pt-2"},$e={class:"w-full h-full flex flex-col items-center justify-between"},ze={class:"w-full font-bold text-center"},Ee={class:"flex items-center justify-center"},Me={key:0,class:"hover:scale-110 transition duration-300"},Ue=["onClick"],Le={key:1,class:"text-xl text-white items-center justify-center"},Fe={key:1,class:"bg-red-700 w-[35px] h-[35px] block rounded-full flex items-center justify-center"},Oe={key:0},He={key:1},Re={class:"text-center w-full"},De={class:"font-bold"},Ge=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),Qe={class:"fixed inset-0 overflow-y-auto"},Je={class:"flex min-h-full items-center justify-center p-4 text-center"},Ke=e("span",{id:"nomVisuelImage"},null,-1),We=e("div",{class:"mt-2 h-[40rem] w-full"},[e("img",{id:"visuelImage",class:"w-full h-full object-cover"})],-1),Xe=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),Ye={class:"fixed inset-0 overflow-y-auto"},Ze={class:"flex min-h-full items-center justify-center p-4 text-center"},et={class:"mt-2 flex justify-center items-center"},tt={class:"text-sm text-gray-500 w-full"},st=e("label",{class:"lg:text-lg text-sm",for:"ref"}," Quantiter : ",-1),it=["max"],rt={key:0,class:"w-full mt-7 ml-5"},ot={class:"mt-4 flex justify-center"},nt={type:"submit",class:"py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},at={layout:(h,d)=>h($,()=>child),layout:$},wt=Object.assign(at,{__name:"Gamme",props:["products","gamme","designpanier"],setup(h){const d=h;var F=[{title:"Accueil",link:"/",icon:ne,active:!1},{title:"Commande Entrep\xF4t",link:"/order_entrepot/gamme",icon:le,active:!1},{title:"Gamme",link:"/order_entrepot/gamme",icon:"",active:!1},{title:d.gamme.nom_gamme,link:"/order_entrepot/gamme/"+d.gamme.nom_gamme,icon:"",active:!0}];const w=v(!1),x=v(!1);v(d.products.data),v(d.products);var f=v(d.designpanier),I=v(J().props.value.auth.user[0].client),_=v(!1),r=A({idProduit:null,quantiter:1,id_panier_edi_list:null,key_tab_1:0,key_tab_2:0}),O=(l,s,i,c)=>{x.value=l,_.value=s,r.idProduit=s.id_produit,r.key_tab_1=i,r.key_tab_2=c,r.quantiter=s.panier.quantiter>0?s.panier.quantiter:1,r.id_panier_edi_list=s.panier.id_panier_edi_list!=null?s.panier.id_panier_edi_list:0};function q(){w.value=!1}function H(l,s,i){w.value=!0;var c=s+" "+i;document.getElementById("visuelImage").setAttribute("src","https://gestion.tapis-nazar.fr/img/produit/"+l),document.getElementById("visuelImage").setAttribute("alt",c),document.getElementById("nomVisuelImage").textContent=c}var R=(l,s)=>{l.preventDefault();var i=r.key_tab_1,c=r.key_tab_2;r.quantiter>0?r.post(route("order_entrepot/panier/add"),{preserveScroll:!0,preserveState:!0,onSuccess:n=>{n.props.session.status?(f.value[i].produits[c].panier.id_panier_edi_list=n.props.session.id_panier_edi_list,f.value[i].produits[c].isInPanier=!0,f.value[i].produits[c].panier.quantiter=r.quantiter,x.value=!1,Toast.fire({icon:"success",title:s?"La quantiter pour ce produit \xE0 bien \xE9t\xE9 modifier":"Le produit \xE0 bien ajouter au panier"})):Toast.fire({icon:"error",title:n.props.session.message})}}):T(r.id_panier_edi_list,i,c)},T=(l,s,i)=>{Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer cette article du panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(c=>{c.isConfirmed&&A({id_panier_edi_list:l}).post(route("order_entrepot/panier/delete"),{preserveScroll:!0,onSuccess:g=>{g.props.session.status?(Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer du panier"}),f.value[s].produits[i].isInPanier=!1,f.value[s].produits[i].panier.quantiter=0,f.value[s].produits[i].panier.id_panier_edi_list=0,x.value=!1):Toast.fire({icon:"error",title:g.props.session.message})}})})},V=()=>{Swal.fire({title:"Attention",text:"\xCAtes-vous sur de vider votre panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(l=>{l.isConfirmed&&ee.Inertia.post("/cart/empty",{},{preserveScroll:!0,onSuccess:s=>{s.props.session.status?Toast.fire({icon:"success",title:"Le panier a bien \xE9t\xE9 vider !"}):Toast.fire({icon:"error",title:"Une erreur est survenue, pour vider votre panier, vous pouvez aussi vous d\xE9connecter et vous reconnecter."})}})})},D=l=>(Math.round(l*100)/100).toFixed(2),G=l=>{var s=l;return I.value.taux_remise>0&&(s=s-s*(I.value.taux_remise/100)),D(s)},Q=l=>new Intl.NumberFormat("fr-FR",{style:"currency",currency:"EUR"}).format(l);return K(()=>{}),W(()=>{}),(l,s)=>(a(),u(k,null,[o(t(X),{title:"Products"}),e("section",ue,[o(ae,{links:t(F)},null,8,["links"]),e("section",ce,[e("div",pe,[e("a",me,[o(t(te),{class:"h-4 w-4 absolute left-0 bottom-1/4 top-1/4 text-black group-hover:text-primary-300 transition duration-300"}),fe])]),e("div",_e,[e("h1",ve,p(d.gamme.nom_gamme),1)]),e("div",xe,[e("span",null,"Tapis "+p(d.gamme.type_tapis==0?"int\xE9rieur":d.gamme.type_tapis==1?"ext\xE9rieur":"int\xE9rieur / ext\xE9rieur"),1),e("span",null,"Poils "+p(d.gamme.type_poils==1?"court":"long")+" - "+p(d.gamme.uv_proof==1?"R\xE9sistants aux UV":"Non R\xE9sistants aux UV"),1),e("span",ge,p(d.gamme.nom_special),1),e("span",null,"Prix HT m\xB2 : "+p(t(G)(d.gamme.prix_vente_ht_m2))+" \u20AC",1),e("div",be,[e("button",{type:"button",onClick:s[0]||(s[0]=(...i)=>t(V)&&t(V)(...i)),class:"sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[o(t(L),{class:"w-5 h-5 mr-2"}),b("Vider mon panier")]),he])])]),e("div",ye,[e("div",we,[e("div",ke,[e("div",Ce,[(a(!0),u(k,null,S(t(f),(i,c)=>(a(),u("div",{class:"border-b border-primary-200 min-w-full",key:c},[e("table",je,[e("tbody",null,[e("tr",Pe,[e("td",Be,[e("div",Ie,[i.img_produit!=null?(a(),u("div",qe,[e("div",Te,[o(se,{class:"text-lg text-black"})]),e("img",{onClick:n=>H(i.img_produit,d.gamme.nom_gamme,i.nom_design),src:"https://gestion.tapis-nazar.fr/img/produit/"+i.img_produit,alt:i.code_sku,class:"z-20 relative hover:opacity-50 transition duration-300 w-full h-full object-contain"},null,8,Ve)])):(a(),u("div",Ae,[o(re)]))]),e("div",Se,[e("span",Ne,p(i.nom_design),1)])]),(a(!0),u(k,null,S(i.produits,(n,g)=>(a(),u("td",{key:g,class:"whitespace-nowrap px-4 py-4 h-24 table-cell align-middle"},[e("div",$e,[e("div",ze,p(n.largeur)+"x"+p(n.longueur),1),e("div",Ee,[o(oe,null,{header:m(()=>[n.stock_restant>0?(a(),u("div",Me,[e("button",{onClick:lt=>t(O)(!0,n,c,g),class:Y([n.stock_restant>10?"bg-green-700":n.stock_restant>0?"bg-orange-400 ":"bg-red-700","w-[35px] h-[35px] block rounded-full flex items-center justify-center"])},[n.isInPanier?(a(),u("span",Le,p(n.panier.quantiter),1)):(a(),N(ie,{key:0,class:"text-xl text-white items-center justify-center"}))],10,Ue)])):(a(),u("span",Fe))]),body:m(()=>[n.stock_restant>0?(a(),u("span",Oe,p(n.isInPanier?"Modifier quantiter":"Ajouter au")+" panier",1)):(a(),u("span",He," Rupture de stock "))]),_:2},1024)]),e("div",Re,[e("span",De,p(t(Q)(n.prixProduit))+" HT",1)])])]))),128))])])])]))),128))])])])])]),o(t(z),{show:w.value,as:"template",unmount:!1},{default:m(()=>[o(t(E),{as:"div",onClose:q,class:"relative z-30",unmount:!1},{default:m(()=>[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0",unmount:!1},{default:m(()=>[Ge]),_:1}),e("div",Qe,[e("div",Je,[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95",unmount:!1},{default:m(()=>[o(t(M),{class:"w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all",unmount:!1},{default:m(()=>[o(t(U),{unmount:!1,as:"h3",class:"text-lg font-medium leading-6 text-gray-900"},{default:m(()=>[b(" Visuel image "),Ke]),_:1}),We,e("div",{class:"flex flex-row-reverse"},[e("button",{type:"button",class:"mt-4 inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300",onClick:q},"Fermer")])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"]),o(t(z),{appear:"",show:x.value,as:"template",unmount:!1},{default:m(()=>[o(t(E),{as:"div",class:"relative z-50"},{default:m(()=>[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0",unmount:!1},{default:m(()=>[Xe]),_:1}),e("div",Ye,[e("div",Ze,[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95",unmount:!1},{default:m(()=>[o(t(M),{class:"w-full border-[5px] border-primary-200 max-w-2xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"},{default:m(()=>[t(_)!=!1?(a(),N(t(U),{key:0,as:"h3",class:"lg:text-lg text-sm text-center font-medium leading-6 text-gray-900"},{default:m(()=>[b(p(t(r).id_panier_edi_list!=null&&t(r).id_panier_edi_list!=0?"Modifier Quantiter":"Ajouter ")+" produit "+p(t(_).sku),1)]),_:1})):C("",!0),t(_)!=!1?(a(),u("form",{key:1,onSubmit:s[6]||(s[6]=Z(i=>t(R)(i,t(r).id_panier_edi_list!=null&&t(r).id_panier_edi_list!=0),["prevent"]))},[j(e("input",{type:"hidden",name:"id_produit",id:"id_produit","onUpdate:modelValue":s[1]||(s[1]=i=>t(r).idProduit=i)},null,512),[[P,t(r).idProduit]]),j(e("input",{type:"hidden",name:"id_panier_edi_list",id:"id_panier_edi_list","onUpdate:modelValue":s[2]||(s[2]=i=>t(r).id_panier_edi_list=i)},null,512),[[P,t(r).id_panier_edi_list]]),e("div",et,[e("div",tt,[st,j(e("input",{"onUpdate:modelValue":s[3]||(s[3]=i=>t(r).quantiter=i),class:"w-full lg:text-lg text-sm transition duration-300 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",id:"quantiter",type:"number",min:"0",max:t(_).stock_restant,name:"quantiter",placeholder:"Saisissez la quantiter pour la commande"},null,8,it),[[P,t(r).quantiter]]),o(B,{class:"mt-2",message:t(r).errors.quantiter},null,8,["message"]),o(B,{class:"mt-2",message:t(r).errors.idProduit},null,8,["message"]),o(B,{class:"mt-2",message:t(r).errors.id_panier_edi_list},null,8,["message"])]),t(_).isInPanier?(a(),u("div",rt,[e("button",{type:"button",onClick:s[4]||(s[4]=i=>t(T)(t(_).panier.id_panier_edi_list,t(r).key_tab_1,t(r).key_tab_2)),class:"w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[o(t(L),{class:"w-5 h-5 mr-2"}),b("Suprimmer le produit du panier ")])])):C("",!0)]),e("div",ot,[e("button",{onClick:s[5]||(s[5]=i=>{x.value=!1}),type:"button",class:"mx-10 inline-flex justify-center rounded-md border border-transparent hover:border-red-100 px-4 py-2 text-sm font-medium text-red-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300"}," Annuler "),e("button",nt,[b(" Valider "),o(t(de),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})])])],32)):C("",!0)]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"])],64))}});export{wt as default};
