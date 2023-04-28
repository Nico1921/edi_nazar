import{o as l,a as d,f as e,A as v,I as D,b as T,B as G,C as Q,d as o,u as t,t as c,h,F as k,J as A,e as p,H as J,n as K,K as S,k as C,j as W,w as j,g as P,N as X}from"./app.56690421.js";import{r as Y,E as Z,d as ee,C as te}from"./index.3662f5f7.js";import{_ as $,I as se}from"./AuthenticatedLayout.43c8ac25.js";import{_ as ie}from"./Tooltip.6e283aac.js";import{r as re,_ as oe}from"./Breadcrumbs.e9db807c.js";import{_ as B}from"./InputError.2c05f44b.js";import{r as ne}from"./ListBulletIcon.e8f8418e.js";import{r as ae}from"./ArrowRightCircleIcon.6f53f724.js";import{f as z,o as y}from"./transition.a573e59d.js";import{N,_ as E,U as M}from"./dialog.724de039.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./micro-task.fe338338.js";import"./description.b80106e5.js";function U(b,n){return l(),d("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[e("path",{"fill-rule":"evenodd",d:"M2.515 10.674a1.875 1.875 0 000 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 003-3V6.75a3 3 0 00-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374zM12.53 9.22a.75.75 0 10-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 101.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L15.31 12l1.72-1.72a.75.75 0 10-1.06-1.06l-1.72 1.72-1.72-1.72z","clip-rule":"evenodd"})])}const le={class:"container mx-auto"},de={class:"relative container mx-auto grid grid-cols-12 mb-4"},ue={class:"col-span-2 flex items-end"},ce={href:"/order_entrepot/gamme",class:"relative inline-block group"},pe=e("span",{class:"inline-block border-b border-black pl-5 group-hover:text-primary-300 group-hover:border-primary-300 transition duration-300"},"Retourner aux gammes",-1),me={class:"flex items-center justify-center col-span-7"},_e={class:"text-6xl font-bold"},fe={class:"col-span-3 rounded bg-primary-white border border-primary-100 text-center flex flex-col text-primary-300"},ve={class:"capitalize"},xe={class:"sm:w-auto w-full py-2 flex items-center justify-center"},ge=e("a",{href:"/cart",class:"py-2 px-4 ml-2 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},"Voir mon panier",-1),he={class:"flex flex-col"},be={class:"overflow-x-auto sm:-mx-6 lg:-mx-8"},ye={class:"inline-block min-w-full py-2 sm:px-6 lg:px-8"},we={class:"min-w-full overflow-hidden border border-primary-200 p-4"},ke={class:"text-left text-sm font-light"},Ce={class:"px-4 py-4"},je={class:"whitespace-nowrap px-4 py-4 w-[190px] overflow-x-hidden"},Pe={class:"h-24 w-full mb-2"},Be={key:0,class:"cursor-pointer relative overflow-hidden w-full h-full flex justify-center"},Ie={class:"absolute flex items-center justify-center w-full h-full"},qe=["onClick","src","alt"],Ve={key:1,class:"text-3xl h-full w-full flex items-center justify-center bg-gray-300"},Te={class:"text-center w-full"},Ae={class:"font-bold pt-2"},Se={class:"w-full h-full flex flex-col items-center justify-between"},$e={class:"w-full font-bold text-center"},ze={class:"flex items-center justify-center"},Ne={key:0,class:"hover:scale-110 transition duration-300"},Ee=["onClick"],Me={key:1,class:"text-xl text-white items-center justify-center"},Ue={key:1,class:"bg-red-700 w-[35px] h-[35px] block rounded-full flex items-center justify-center"},Le={key:0},Oe={key:1},Fe={class:"text-center w-full"},Re={class:"font-bold"},He=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),De={class:"fixed inset-0 overflow-y-auto"},Ge={class:"flex min-h-full items-center justify-center p-4 text-center"},Qe=e("span",{id:"nomVisuelImage"},null,-1),Je=e("div",{class:"mt-2 h-[40rem] w-full"},[e("img",{id:"visuelImage",class:"w-full h-full object-cover"})],-1),Ke=e("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1),We={class:"fixed inset-0 overflow-y-auto"},Xe={class:"flex min-h-full items-center justify-center p-4 text-center"},Ye={class:"mt-2 flex justify-center items-center"},Ze={class:"text-sm text-gray-500 w-full"},et=e("label",{class:"lg:text-lg text-sm",for:"ref"}," Quantiter : ",-1),tt=["max"],st={key:0,class:"w-full mt-7 ml-5"},it={class:"mt-4 flex justify-center"},rt={type:"submit",class:"py-2 px-4 flex group border border-green-300 rounded bg-green-900 bg-opacity-75 text-white hover:bg-opacity-90 transition duration-300 disabled:cursor-not-allowed disabled:bg-green-300"},ot={layout:(b,n)=>b($,()=>child),layout:$},bt=Object.assign(ot,{__name:"Gamme",props:["products","gamme","designpanier"],setup(b){const n=b;var L=[{title:"Accueil",link:"/",icon:re,active:!1},{title:"Commande Entrep\xF4t",link:"/order_entrepot/gamme",icon:ne,active:!1},{title:"Gamme",link:"/order_entrepot/gamme",icon:"",active:!1},{title:n.gamme.nom_gamme,link:"/order_entrepot/gamme/"+n.gamme.nom_gamme,icon:"",active:!0}];const w=v(!1),x=v(!1);v(n.products.data),v(n.products);var _=v(n.designpanier);console.log(n.designpanier),v(D().props.value.auth.user[0].client);var f=v(!1),r=T({idProduit:null,quantiter:1,id_panier_edi_list:null,key_tab_1:0,key_tab_2:0}),O=(m,i,s,u)=>{x.value=m,f.value=i,r.idProduit=i.id_produit,r.key_tab_1=s,r.key_tab_2=u,r.quantiter=i.panier.quantiter>0?i.panier.quantiter:1,r.id_panier_edi_list=i.panier.id_panier_edi_list!=null?i.panier.id_panier_edi_list:0};function I(){w.value=!1}function F(m,i,s){w.value=!0;var u=i+" "+s;document.getElementById("visuelImage").setAttribute("src","https://gestion.tapis-nazar.fr/img/produit/"+m),document.getElementById("visuelImage").setAttribute("alt",u),document.getElementById("nomVisuelImage").textContent=u}var R=(m,i)=>{m.preventDefault();var s=r.key_tab_1,u=r.key_tab_2;r.quantiter>0?r.post(route("order_entrepot/panier/add"),{preserveScroll:!0,preserveState:!0,onSuccess:a=>{a.props.session.status?(_.value[s].produits[u].panier.id_panier_edi_list=a.props.session.id_panier_edi_list,_.value[s].produits[u].isInPanier=!0,_.value[s].produits[u].panier.quantiter=r.quantiter,x.value=!1,Toast.fire({icon:"success",title:i?"La quantiter pour ce produit \xE0 bien \xE9t\xE9 modifier":"Le produit \xE0 bien ajouter au panier"})):Toast.fire({icon:"error",title:a.props.session.message})}}):q(r.id_panier_edi_list,s,u)},q=(m,i,s)=>{Swal.fire({title:"Attention",text:"Etes-vous sur de supprimer cette article du panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(u=>{u.isConfirmed&&T({id_panier_edi_list:m}).post(route("order_entrepot/panier/delete"),{preserveScroll:!0,onSuccess:g=>{g.props.session.status?(Toast.fire({icon:"success",title:"Le produit \xE0 bien \xE9t\xE9 supprimer du panier"}),_.value[i].produits[s].isInPanier=!1,_.value[i].produits[s].panier.quantiter=0,_.value[i].produits[s].panier.id_panier_edi_list=0,x.value=!1):Toast.fire({icon:"error",title:g.props.session.message})}})})},V=()=>{Swal.fire({title:"Attention",text:"\xCAtes-vous sur de vider votre panier ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",cancelButtonText:"Non",confirmButtonText:"Oui"}).then(m=>{m.isConfirmed&&X.Inertia.post("/cart/empty",{},{preserveScroll:!0,onSuccess:i=>{i.props.session.status?Toast.fire({icon:"success",title:"Le panier a bien \xE9t\xE9 vider !"}):Toast.fire({icon:"error",title:"Une erreur est survenue, pour vider votre panier, vous pouvez aussi vous d\xE9connecter et vous reconnecter."})}})})},H=m=>new Intl.NumberFormat("fr-FR",{style:"currency",currency:"EUR"}).format(m);return G(()=>{}),Q(()=>{}),(m,i)=>(l(),d(k,null,[o(t(J),{title:"Products"}),e("section",le,[o(oe,{links:t(L)},null,8,["links"]),e("section",de,[e("div",ue,[e("a",ce,[o(t(Y),{class:"h-4 w-4 absolute left-0 bottom-1/4 top-1/4 text-black group-hover:text-primary-300 transition duration-300"}),pe])]),e("div",me,[e("h1",_e,c(n.gamme.nom_gamme),1)]),e("div",fe,[e("span",null,"Tapis "+c(n.gamme.type_tapis==0?"int\xE9rieur":n.gamme.type_tapis==1?"ext\xE9rieur":"int\xE9rieur / ext\xE9rieur"),1),e("span",null,"Poils "+c(n.gamme.type_poils==1?"court":"long")+" - "+c(n.gamme.uv_proof==1?"R\xE9sistants aux UV":"Non R\xE9sistants aux UV"),1),e("span",ve,c(n.gamme.nom_special),1),e("span",null,"Prix HT m\xB2 : "+c(n.gamme.prix_vente_ht_m2_remise?n.gamme.prix_vente_ht_m2_remise:n.gamme.prix_vente_ht_m2)+" \u20AC",1),e("div",xe,[e("button",{type:"button",onClick:i[0]||(i[0]=(...s)=>t(V)&&t(V)(...s)),class:"sm:w-auto w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[o(t(U),{class:"w-5 h-5 mr-2"}),h("Vider mon panier")]),ge])])]),e("div",he,[e("div",be,[e("div",ye,[e("div",we,[(l(!0),d(k,null,A(t(_),(s,u)=>(l(),d("div",{class:"border-b border-primary-200 min-w-full",key:u},[e("table",ke,[e("tbody",null,[e("tr",Ce,[e("td",je,[e("div",Pe,[s.img_produit!=null?(l(),d("div",Be,[e("div",Ie,[o(Z,{class:"text-lg text-black"})]),e("img",{onClick:a=>F(s.img_produit,n.gamme.nom_gamme,s.nom_design),src:"https://gestion.tapis-nazar.fr/img/produit/"+t(ee)(s.img_produit),alt:s.code_sku,class:"z-20 relative hover:opacity-50 transition duration-300 h-full object-contain"},null,8,qe)])):(l(),d("div",Ve,[o(se)]))]),e("div",Te,[e("span",Ae,c(s.nom_design),1)])]),(l(!0),d(k,null,A(s.produits,(a,g)=>(l(),d("td",{key:g,class:"whitespace-nowrap px-4 py-4 h-24 table-cell align-middle"},[e("div",Se,[e("div",$e,c(a.largeur)+"x"+c(a.longueur),1),e("div",ze,[o(ie,null,{header:p(()=>[a.stock_restant>0?(l(),d("div",Ne,[e("button",{onClick:nt=>t(O)(!0,a,u,g),class:K([a.stock_restant>10?"bg-green-700":a.stock_restant>0?"bg-orange-400 ":"bg-red-700","w-[35px] h-[35px] block rounded-full flex items-center justify-center"])},[a.isInPanier?(l(),d("span",Me,c(a.panier.quantiter),1)):(l(),S(te,{key:0,class:"text-xl text-white items-center justify-center"}))],10,Ee)])):(l(),d("span",Ue))]),body:p(()=>[a.stock_restant>0?(l(),d("span",Le,c(a.isInPanier?"Modifier quantiter":"Ajouter au")+" panier",1)):(l(),d("span",Oe," Rupture de stock "))]),_:2},1024)]),e("div",Fe,[e("span",Re,c(t(H)(a.prixProduit))+" HT",1)])])]))),128))])])])]))),128))])])])])]),o(t(z),{show:w.value,as:"template",unmount:!1},{default:p(()=>[o(t(N),{as:"div",onClose:I,class:"relative z-30",unmount:!1},{default:p(()=>[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0",unmount:!1},{default:p(()=>[He]),_:1}),e("div",De,[e("div",Ge,[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95",unmount:!1},{default:p(()=>[o(t(E),{class:"w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all",unmount:!1},{default:p(()=>[o(t(M),{unmount:!1,as:"h3",class:"text-lg font-medium leading-6 text-gray-900"},{default:p(()=>[h(" Visuel image "),Qe]),_:1}),Je,e("div",{class:"flex flex-row-reverse"},[e("button",{type:"button",class:"mt-4 inline-flex justify-center rounded-md border border-transparent bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300",onClick:I},"Fermer")])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"]),o(t(z),{appear:"",show:x.value,as:"template",unmount:!1},{default:p(()=>[o(t(N),{as:"div",class:"relative z-50"},{default:p(()=>[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0",unmount:!1},{default:p(()=>[Ke]),_:1}),e("div",We,[e("div",Xe,[o(t(y),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95",unmount:!1},{default:p(()=>[o(t(E),{class:"w-full border-[5px] border-primary-200 max-w-2xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"},{default:p(()=>[t(f)!=!1?(l(),S(t(M),{key:0,as:"h3",class:"lg:text-lg text-sm text-center font-medium leading-6 text-gray-900"},{default:p(()=>[h(c(t(r).id_panier_edi_list!=null&&t(r).id_panier_edi_list!=0?"Modifier Quantiter":"Ajouter ")+" produit "+c(t(f).sku),1)]),_:1})):C("",!0),t(f)!=!1?(l(),d("form",{key:1,onSubmit:i[6]||(i[6]=W(s=>t(R)(s,t(r).id_panier_edi_list!=null&&t(r).id_panier_edi_list!=0),["prevent"]))},[j(e("input",{type:"hidden",name:"id_produit",id:"id_produit","onUpdate:modelValue":i[1]||(i[1]=s=>t(r).idProduit=s)},null,512),[[P,t(r).idProduit]]),j(e("input",{type:"hidden",name:"id_panier_edi_list",id:"id_panier_edi_list","onUpdate:modelValue":i[2]||(i[2]=s=>t(r).id_panier_edi_list=s)},null,512),[[P,t(r).id_panier_edi_list]]),e("div",Ye,[e("div",Ze,[et,j(e("input",{"onUpdate:modelValue":i[3]||(i[3]=s=>t(r).quantiter=s),class:"w-full lg:text-lg text-sm transition duration-300 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",id:"quantiter",type:"number",min:"0",max:t(f).stock_restant,name:"quantiter",placeholder:"Saisissez la quantiter pour la commande"},null,8,tt),[[P,t(r).quantiter]]),o(B,{class:"mt-2",message:t(r).errors.quantiter},null,8,["message"]),o(B,{class:"mt-2",message:t(r).errors.idProduit},null,8,["message"]),o(B,{class:"mt-2",message:t(r).errors.id_panier_edi_list},null,8,["message"])]),t(f).isInPanier?(l(),d("div",st,[e("button",{type:"button",onClick:i[4]||(i[4]=s=>t(q)(t(f).panier.id_panier_edi_list,t(r).key_tab_1,t(r).key_tab_2)),class:"w-full px-5 py-2 flex items-center justify-center rounded bg-red-600 text-red-200 hover:bg-red-500 hover:text-red-800 transition duration-300"},[o(t(U),{class:"w-5 h-5 mr-2"}),h("Suprimmer le produit du panier ")])])):C("",!0)]),e("div",it,[e("button",{onClick:i[5]||(i[5]=s=>{x.value=!1}),type:"button",class:"mx-10 inline-flex justify-center rounded-md border border-transparent hover:border-red-100 px-4 py-2 text-sm font-medium text-red-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 transition duration-300"}," Annuler "),e("button",rt,[h(" Valider "),o(t(ae),{class:"h-6 w-6 ml-1 group-hover:translate-x-1 group-disabled:translate-x-0 transition-all duration-300",viewBox:"0 0 24 24",fill:"none"})])])],32)):C("",!0)]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"])],64))}});export{bt as default};
