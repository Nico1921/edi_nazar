import{o as r,a as i,f as e,A as T,c as P,b as J,B as S,d as l,u as s,t as E,n as b,j,h as a,w as p,g as m,e as v,k as x,F as A,H,i as U,J as N,K as D,S as R,U as $}from"./app.5dbde3b7.js";import{u as I}from"./Account.d011db97.js";import{C as _,F as G,U as K}from"./Flag.f4ef06dc.js";import{E as O}from"./MicrosoftExcel.a0bd7061.js";import{C as Q}from"./Check.e658a431.js";import{_ as q,C as W}from"./AuthenticatedLayout.9da89ee6.js";import{M as X,P as Y}from"./Email.f2d9ac6b.js";import{_ as Z}from"./ModalImportMKP.4f8dfc58.js";import{_ as c}from"./InputError.6aa4371a.js";import{A as ee,B as se,L as te,j as le,H as oe}from"./combobox.572818fb.js";import{f as ne}from"./transition.5342825c.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./dialog.3ecc1242.js";import"./micro-task.fe338338.js";import"./description.732eea12.js";import"./use-controllable.18e08164.js";function ae(h,g){return r(),i("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"})])}function re(h,g){return r(),i("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor","aria-hidden":"true"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"})])}const ie={class:"container mx-auto mt-5"},ce={class:"relative py-5"},de={key:0,class:"flex flex-col justify-center"},pe=e("h1",{class:"text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300"},"Ajouter commande pour un client",-1),me={class:"text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300"},ue={key:1},ge=e("h1",{class:"text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300"},"Cr\xE9ation d'une commande pour un client",-1),_e=[ge],fe={class:"grid grid-cols-4"},xe={class:"flex flex-col items-center justify-center"},he=e("h2",{class:"text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1"},"J'ai une commande",-1),ye=e("span",{class:"text-center sm:text-lg text-sm"},"remplissez manuellement les informations ci-dessous",-1),be=["onSubmit"],ve={class:"bg-primary-50 px-4 py-4 col-span-2 grid grid-cols-2"},we={class:"text-lg font-semibold col-span-2"},ke={class:"col-span-2 grid grid-cols-6 py-4 mx-2"},Te={class:"col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12"},Ie={class:"2xl:col-span-5 sm:col-span-4 col-span-5"},Ce={for:"prenom_client",class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"},Be={class:"inline-flex left-3 items-center justify-items-center justify-center"},Ve={class:"2xl:col-span-7 sm:col-span-8 col-span-7"},Ee={class:"col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12"},je={class:"2xl:col-span-4 sm:col-span-4 col-span-5"},Ae={for:"nom_client",class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"},Ue={class:"inline-flex left-3 items-center justify-items-center justify-center h-3/4"},qe={class:"2xl:col-span-8 sm:col-span-8 col-span-7"},Me={class:"col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12"},Fe={class:"2xl:col-span-5 sm:col-span-4 col-span-5"},Le={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"mail_client"},ze={class:"pr-2"},Pe={class:"2xl:col-span-7 sm:col-span-8 col-span-7"},Je={class:"col-span-6 2xl:col-span-3 flex text-lg pb-2 grid grid-cols-12"},Se={class:"2xl:col-span-6 sm:col-span-4 col-span-6"},He={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"tel_client"},Ne={class:"mr-2"},De={class:"2xl:col-span-6 sm:col-span-8 col-span-6"},Re={class:"col-span-2 text-lg font-semibold"},$e={class:"col-span-2 grid grid-cols-6 py-4 mx-2"},Ge={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},Ke={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},Oe={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"nom_adresse_client"},Qe={class:"pr-2"},We={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},Xe={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},Ye={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},Ze={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"adresse_client"},es={class:"pr-2"},ss={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},ts={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},ls={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},os={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"complement_adresse_client"},ns={class:"pr-2"},as={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},rs={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},is={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},cs={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"information_adresse_client"},ds={class:"pr-2"},ps={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},ms={class:"col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2"},us={class:"2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7"},gs={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"cp_client"},_s={class:"pr-2"},fs={class:"2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5"},xs={class:"col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2"},hs={class:"2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7"},ys={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"ville_client"},bs={class:"pr-2"},vs={class:"2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5"},ws={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},ks={class:"sm:col-span-3 col-span-4"},Ts={for:"ville_client",class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"},Is={class:"inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"},Cs={class:"sm:col-span-9 col-span-8"},Bs={class:"relative"},Vs={class:"relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"},Es={key:0,class:"relative cursor-default select-none py-2 px-4 text-gray-700"},js=e("div",{class:"flex items-center justify-center relative col-span-2 py-1 text-lg text-center w-full py-5"},[e("button",{type:"submit",class:"py-2 px-4 rounded-lg text-gray-500 bg-primary-50 hover:bg-primary-100 transition duration-300"},"Je valide ma commande manuel")],-1),As={key:0,class:"absolute h-96 left-2/4 right-2/4 top-2/4 bottom-2/4 lg:flex hidden items-center justify-center"},Us=e("hr",{class:"block w-1 h-96 border"},null,-1),qs=[Us],Ms={key:1,class:"lg:col-span-2 col-span-4 xl:ml-6"},Fs={class:"flex flex-col items-center justify-center"},Ls=e("h2",{class:"text-center xl:text-3xl lg:text-2xl sm:text-xl text-lg text-primary-300 py-1"},"J'ai plusieurs commandes",-1),zs=e("span",{class:"text-center sm:text-lg text-sm"},"remplissez la template puis importez la",-1),Ps=["onSubmit"],Js={class:"bg-primary-50 flex flex-col p-4"},Ss={class:"text-primary-500 py-5"},Hs=["href"],Ns={class:"text-primary-500 py-5"},Ds=["href"],Rs={class:"text-primary-500 py-5 w-full flex"},$s={class:"grid grid-cols-4 pl-2"},Gs={class:"block cursor-pointer text-white underline hover:text-gray-200 transition duration-300",for:"file_import_clients"},Ks={class:"hidden",id:"file_name_span_client"},Os=e("span",{id:"file_name_client"},null,-1),Qs={class:"flex items-center justify-center relative col-span-2 py-1 text-lg text-center w-full py-5"},Ws={key:0,type:"submit",class:"py-2 px-4 rounded-lg text-gray-500 bg-primary-50 hover:bg-primary-100 transition duration-300"},Xs={key:1,disabled:"",type:"submit",class:"py-2 px-4 rounded-lg disabled:text-gray-200 disabled:bg-primary-50 transition duration-300"},Ys=e("div",{id:"modalImport"},null,-1),Zs=e("div",{id:"productClientView"},null,-1),et={layout:(h,g)=>h(q,()=>child),layout:q},xt=Object.assign(et,{__name:"Clients",props:["panier"],setup(h){const g=h,M=new URL("/build/assets/Template_Vierge_Drop.477843c2.xlsx",self.location).href,F=new URL("/build/assets/Template_Model_Drop.05dd7258.xlsx",self.location).href,k=["Allemagne","Autriche","Belgique","Bulgarie","Chypre","Croatie","Danemark","Espagne","Estonie","Finlande","France","Gr\xE8ce","Hongrie","Irlande","Italie","Lettonie","Lituanie","Luxembourg","Malte","Pays-Bas","Pologne","Portugal","R\xE9publique tch\xE8que","Roumanie","Slovaquie","Slov\xE9nie","Su\xE8de"];let u=T(""),C=P(()=>u.value===""?k:k.filter(d=>d.toLowerCase().replace(/\s+/g,"").includes(u.value.toLowerCase().replace(/\s+/g,"")))),f=T(!1);var B=d=>{d.target.value==""?(document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),f.value=!1):(document.getElementById("file_name_client").innerText=d.target.files[0].name,document.getElementById("file_name_span_client").classList.remove("hidden"),f.value=!0)},V=()=>{document.getElementById("file_import_clients").value=null,document.getElementById("file_name_client").innerText="",document.getElementById("file_name_span_client").classList.add("hidden"),f.value=!1};const o=J({nom:"",prenom:"",email:"",tel:"",nom_adresse:"",adresse1:"",adresse2:"",adresse3:"",code_postal:"",ville:"",pays:T(k[10])}),L=()=>{o.post(route("orders/clients"),{onSuccess:d=>{d.props.statusPanier==!0?document.location.href="/orders/clients/products":d.props.statusPanier==!1&&Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la cr\xE9ation du client, veuillez ressayer !"})}})},z=()=>{var d=new FormData(document.getElementById("fileClientImport"));R.post("/orders/clients/import",d).then(n=>{if(console.log(n),n.status){document.getElementById("modalImport")!=null&&document.getElementById("modalImport").__vue_app__!=null&&document.getElementById("modalImport").__vue_app__.unmount();var t=n.data,y=$(Z,{isOpen:!0,importMKP:t.importCommandes,reussi:t.valider,erreur:t.erreur,qteFinal:t.qteFinal,m2Final:t.m2Final,prixHT_TT:t.prixHT_TT,prixTVA_TT:t.prixTVA_TT,prixTTC_TT:t.prixTTC_TT,stockInvalide:t.stockInvalide});y.mount(document.getElementById("modalImport"))}else Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'importation de votre fichier, veuillez v\xE9rifier que votre fichier correspond bien \xE0 l'exemple fournis puis ressayer !"})})};return S(()=>{document.getElementById("modalImport")!=null&&document.getElementById("modalImport").__vue_app__!=null&&document.getElementById("modalImport").__vue_app__.unmount()}),(d,n)=>(r(),i(A,null,[l(s(H),{title:"Orders Clients"}),e("section",ie,[e("div",ce,[g.panier!=null?(r(),i("div",de,[pe,e("span",me,"Ajout \xE0 la commande "+E(g.panier.num_commande),1)])):(r(),i("div",ue,_e))]),e("div",fe,[e("div",{class:b(g.panier==null?"lg:col-span-2 xl:mr-6 col-span-4":"col-span-4")},[e("div",xe,[l(s(re),{class:"xl:h-52 lg:h-36 sm:h-32 h-24 w-full stroke-1"}),he,ye]),e("form",{onSubmit:j(L,["prevent"]),class:"grid grid-cols-2 p-4",id:"form_client"},[e("div",ve,[e("h3",we,[l(I),a(" G\xE9n\xE9ral : ")]),e("div",ke,[e("div",Te,[e("div",Ie,[e("label",Ce,[e("span",Be,[l(I)]),a(" Pr\xE9nom :")])]),e("div",Ve,[p(e("input",{type:"text",id:"prenom_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"prenom",required:"",autofocus:"",autocomplete:"given-name","onUpdate:modelValue":n[0]||(n[0]=t=>s(o).prenom=t)},null,512),[[m,s(o).prenom]]),l(c,{class:"mt-2",message:s(o).errors.prenom},null,8,["message"])])]),e("div",Ee,[e("div",je,[e("label",Ae,[e("span",Ue,[l(I)]),a(" Nom :")])]),e("div",qe,[p(e("input",{type:"text",id:"nom_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"nom",required:"",autofocus:"",autocomplete:"family-name","onUpdate:modelValue":n[1]||(n[1]=t=>s(o).nom=t)},null,512),[[m,s(o).nom]]),l(c,{class:"mt-2",message:s(o).errors.nom},null,8,["message"])])]),e("div",Me,[e("div",Fe,[e("label",Le,[e("span",ze,[l(X)]),a(" E-Mail :")])]),e("div",Pe,[p(e("input",{type:"text",id:"mail_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"email",required:"",autofocus:"",autocomplete:"email","onUpdate:modelValue":n[2]||(n[2]=t=>s(o).email=t)},null,512),[[m,s(o).email]]),l(c,{class:"mt-2",message:s(o).errors.email},null,8,["message"])])]),e("div",Je,[e("div",Se,[e("label",He,[e("span",Ne,[l(Y)]),a(" T\xE9l\xE9phone :")])]),e("div",De,[p(e("input",{type:"text",id:"tel_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"tel",required:"",autofocus:"",autocomplete:"tel","onUpdate:modelValue":n[3]||(n[3]=t=>s(o).tel=t)},null,512),[[m,s(o).tel]]),l(c,{class:"mt-2",message:s(o).errors.tel},null,8,["message"])])])]),e("h3",Re,[l(_),a(" Adresse de livraison : ")]),e("div",$e,[e("div",Ge,[e("div",Ke,[e("label",Oe,[e("span",Qe,[l(_)]),a(" Nom adresse :")])]),e("div",We,[p(e("input",{type:"text",id:"nom_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"nom_adresse",required:"",autofocus:"","onUpdate:modelValue":n[4]||(n[4]=t=>s(o).nom_adresse=t)},null,512),[[m,s(o).nom_adresse]]),l(c,{class:"mt-2",message:s(o).errors.nom_adresse},null,8,["message"])])]),e("div",Xe,[e("div",Ye,[e("label",Ze,[e("span",es,[l(_)]),a(" Adresse 1 :")])]),e("div",ss,[p(e("input",{type:"text",id:"adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse1",required:"",autofocus:"",autocomplete:"address-line1","onUpdate:modelValue":n[5]||(n[5]=t=>s(o).adresse1=t)},null,512),[[m,s(o).adresse1]]),l(c,{class:"mt-2",message:s(o).errors.adresse1},null,8,["message"])])]),e("div",ts,[e("div",ls,[e("label",os,[e("span",ns,[l(_)]),a(" Adresse 2 :")])]),e("div",as,[p(e("input",{type:"text",id:"complement_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse2",autofocus:"",autocomplete:"address-line2","onUpdate:modelValue":n[6]||(n[6]=t=>s(o).adresse2=t)},null,512),[[m,s(o).adresse2]]),l(c,{class:"mt-2",message:s(o).errors.adresse2},null,8,["message"])])]),e("div",rs,[e("div",is,[e("label",cs,[e("span",ds,[l(_)]),a(" Adresse 3 :")])]),e("div",ps,[p(e("input",{type:"text",id:"information_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse3",autofocus:"",autocomplete:"address-line3","onUpdate:modelValue":n[7]||(n[7]=t=>s(o).adresse3=t)},null,512),[[m,s(o).adresse3]]),l(c,{class:"mt-2",message:s(o).errors.adresse3},null,8,["message"])])]),e("div",ms,[e("div",us,[e("label",gs,[e("span",_s,[l(_)]),a(" Code postal :")])]),e("div",fs,[p(e("input",{type:"text",id:"cp_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"code_postal",required:"",autofocus:"",autocomplete:"postal-code","onUpdate:modelValue":n[8]||(n[8]=t=>s(o).code_postal=t)},null,512),[[m,s(o).code_postal]]),l(c,{class:"mt-2",message:s(o).errors.code_postal},null,8,["message"])])]),e("div",xs,[e("div",hs,[e("label",ys,[e("span",bs,[l(_)]),a(" Ville :")])]),e("div",vs,[p(e("input",{type:"text",id:"ville_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"ville",required:"",autofocus:"",autocomplete:"city","onUpdate:modelValue":n[9]||(n[9]=t=>s(o).ville=t)},null,512),[[m,s(o).ville]]),l(c,{class:"mt-2",message:s(o).errors.ville},null,8,["message"])])]),e("div",ws,[e("div",ks,[e("label",Ts,[e("span",Is,[l(G)]),a(" Pays :")])]),e("div",Cs,[l(s(ee),{modelValue:s(o).pays,"onUpdate:modelValue":n[12]||(n[12]=t=>s(o).pays=t)},{default:v(()=>[e("div",Bs,[e("div",Vs,[l(s(se),{class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",displayValue:t=>t,onChange:n[10]||(n[10]=t=>U(u)?u.value=t.target.value:u=t.target.value),name:"pays",required:"",autofocus:""},null,8,["displayValue"]),l(s(te),{class:"absolute inset-y-0 right-0 flex items-center pr-2"},{default:v(()=>[l(K,{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]),_:1})]),l(s(ne),{leave:"transition ease-in duration-100",leaveFrom:"opacity-100",leaveTo:"opacity-0",onAfterLeave:n[11]||(n[11]=t=>U(u)?u.value="":u="")},{default:v(()=>[l(s(le),{class:"absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"},{default:v(()=>[s(C).length===0&&s(u)!==""?(r(),i("div",Es," Nothing found. ")):x("",!0),(r(!0),i(A,null,N(s(C),t=>(r(),D(s(oe),{as:"template",key:t,value:t},{default:v(({selected:y,active:w})=>[e("li",{class:b(["relative cursor-default select-none py-2 pl-10 pr-4",{"bg-teal-600 text-white":w,"text-gray-900":!w}])},[e("span",{class:b(["block truncate",{"font-medium":y,"font-normal":!y}])},E(t),3),y?(r(),i("span",{key:0,class:b(["absolute inset-y-0 left-0 flex items-center pl-3",{"text-white":w,"text-teal-600":!w}])},[l(Q,{class:"h-5 w-5","aria-hidden":"true"})],2)):x("",!0)],2)]),_:2},1032,["value"]))),128))]),_:1})]),_:1})])]),_:1},8,["modelValue"]),l(c,{class:"mt-2",message:s(o).errors.pays},null,8,["message"])])])])]),js],40,be)],2),g.panier==null?(r(),i("div",As,qs)):x("",!0),g.panier==null?(r(),i("div",Ms,[e("div",Fs,[l(s(ae),{class:"xl:h-52 lg:h-36 sm:h-32 h-24 w-full stroke-1"}),Ls,zs]),e("form",{id:"fileClientImport",onSubmit:j(z,["prevent"]),class:"p-4 flex flex-col"},[e("div",Js,[e("span",Ss,[a("Je t\xE9l\xE9charge le mod\xE8le d'exemple : "),e("a",{href:s(F),class:"mt-1 text-sm text-white underline hover:text-gray-200 transition duration-300"},"T\xE9l\xE9charger l'exemple",8,Hs)]),e("span",Ns,[a("Je t\xE9l\xE9charge la template vierge : "),e("a",{href:s(M),class:"mt-1 text-sm text-white underline hover:text-gray-200 transition duration-300"},"T\xE9l\xE9charger la template",8,Ds)]),e("span",Rs,[a(" J'importe mon fichier ici : "),e("div",$s,[e("div",{class:b((s(f),"relative col-span-4"))},[e("label",Gs,[a("J'importe mon fichier au format .xls ou .xlsx "),l(O)]),e("span",Ks,[e("button",{type:"button",onClick:n[13]||(n[13]=(...t)=>s(V)&&s(V)(...t))},[l(W)]),Os]),e("input",{onChange:n[14]||(n[14]=(...t)=>s(B)&&s(B)(...t)),type:"file",class:"hidden",id:"file_import_clients",accept:"application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",name:"fileImport"},null,32)],2)])])]),e("div",Qs,[s(f)?(r(),i("button",Ws,"Je valide ma commande par fichier")):x("",!0),s(f)?x("",!0):(r(),i("button",Xs,"Je valide ma commande par fichier"))])],40,Ps)])):x("",!0)])]),Ys,Zs],64))}});export{xt as default};
