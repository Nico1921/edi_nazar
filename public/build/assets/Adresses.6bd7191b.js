import{A as w,c as G,b as J,o as g,a as b,d as a,u as s,f as e,j as F,h as i,w as c,g as p,e as m,n as x,k,F as q,H as K,i as A,K as E,J as L,t as S}from"./app.2bb16b84.js";import{C as u,F as B,U as P}from"./Flag.5fd3b260.js";import{C as j}from"./Check.85b0466a.js";import{M as O,P as Q}from"./Email.5a48e32f.js";import{_ as M}from"./AuthenticatedLayout.396adb97.js";import{_ as d}from"./InputError.bb321238.js";import{_ as W,a as X}from"./ResumeOrderVertical.149881c4.js";import{_ as Y}from"./EtapeOrder.973c3212.js";import{A as N,B as z,L as H,j as T,H as $}from"./combobox.73ba0ceb.js";import{l as Z}from"./switch.e38eff68.js";import{f as D}from"./transition.0978bcd7.js";import"./flag-icons.min.3dbbb609.js";import"./use-controllable.500ac3ca.js";import"./label.96e0afe8.js";import"./description.281ffebb.js";const ee={class:"container mx-auto mt-5"},se=e("h1",{class:"text-center text-3xl text-primary-300"},"Adresse de livraison / Facturation de la commande",-1),te={class:"col-span-4"},ae={class:"col-span-4 grid grid-cols-4 xl:mx-16"},le={class:"lg:col-span-3 col-span-4 xl:ml-0 lg:ml-16 lg:mx-0 sm:mx-12"},oe={class:"bg-primary-50 rounded mb-5"},ne=e("h2",{class:"text-center text-3xl text-primary-300 py-1 bg-primary-100 rounded-t-lg w-full"},"Information g\xE9n\xE9rale",-1),re={class:"grid grid-cols-6 gap-4 p-5 mx-5",id:"form_client"},ie={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},de={class:"sm:col-span-4 col-span-5"},ce={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"mail_client"},pe={class:"pr-2"},ue={class:"sm:col-span-8 col-span-7"},me={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},ge={class:"sm:col-span-4 col-span-6"},fe={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"tel_client"},_e={class:"mr-2"},be={class:"sm:col-span-8 col-span-6"},xe={class:"bg-primary-50 rounded my-5"},ye=e("h2",{class:"text-center text-3xl text-primary-300 py-1 bg-primary-100 rounded-t-lg w-full"},"Saisir l'adresse de livraison",-1),he={class:"grid grid-cols-6 gap-4 p-5 mx-5",id:"form_client"},ve={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},we={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},ke={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"nom_adresse_client"},Ve={class:"pr-2"},Ae={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},Ue={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},qe={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},Ce={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"adresse_client"},Fe={class:"pr-2"},Ee={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},Le={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},Se={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},Be={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"complement_adresse_client"},Pe={class:"pr-2"},je={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},Me={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},Ne={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},ze={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"information_adresse_client"},He={class:"pr-2"},Te={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},$e={class:"col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2"},De={class:"2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7"},Ie={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"cp_client"},Re={class:"pr-2"},Ge={class:"2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5"},Je={class:"col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2"},Ke={class:"2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7"},Oe={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"ville_client"},Qe={class:"pr-2"},We={class:"2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5"},Xe={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},Ye={class:"sm:col-span-3 col-span-4"},Ze={for:"ville_client",class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"},es={class:"inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"},ss={class:"sm:col-span-9 col-span-8"},ts={class:"relative"},as={class:"relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"},ls={key:0,class:"relative cursor-default select-none py-2 px-4 text-gray-700"},os={class:"col-span-6 z-10 relative py-1 pl-4 pr-4 text-lg rounded bg-primary-100 w-full text-primary-400 flex flex-row items-center"},ns=e("label",{for:"sameAdresseFact",class:"sm:w-11/12 w-10/12"},"Utiliser cette adresse comme adresse de facturation",-1),rs={class:"sm:w-1/12 w-2/12 flex justify-center"},is=e("span",{class:"sr-only"},"M\xEAme adresse de facturation",-1),ds={key:0,class:"bg-primary-50 rounded my-5"},cs=e("h2",{class:"text-center text-3xl text-primary-300 py-1 bg-primary-100 rounded-t-lg w-full"},"Saisir l'adresse de facturation",-1),ps={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},us={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},ms={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"nom_adresse_client"},gs={class:"pr-2"},fs={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},_s={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},bs={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},xs={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"adresse_client"},ys={class:"pr-2"},hs={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},vs={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},ws={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},ks={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"complement_adresse_client"},Vs={class:"pr-2"},As={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},Us={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},qs={class:"2xl:col-span-3 lg:col-span-5 sm:col-span-4 col-span-7"},Cs={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"information_adresse_client"},Fs={class:"pr-2"},Es={class:"2xl:col-span-9 lg:col-span-7 sm:col-span-8 col-span-5"},Ls={class:"col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2"},Ss={class:"2xl:col-span-6 lg:col-span-5 sm:col-span-4 col-span-7"},Bs={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-2",for:"cp_client"},Ps={class:"pr-1"},js={class:"2xl:col-span-6 lg:col-span-7 sm:col-span-8 col-span-5"},Ms={class:"col-span-6 2xl:col-span-3 grid grid-cols-12 flex text-lg pb-2"},Ns={class:"2xl:col-span-5 lg:col-span-3 sm:col-span-4 col-span-7"},zs={class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4",for:"ville_client"},Hs={class:"pr-2"},Ts={class:"2xl:col-span-7 lg:col-span-9 sm:col-span-8 col-span-5"},$s={class:"col-span-6 flex text-lg pb-2 grid grid-cols-12"},Ds={class:"sm:col-span-3 col-span-4"},Is={for:"ville_client",class:"block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"},Rs={class:"inline-flex left-3 items-center justify-items-center justify-center h-3/4 top-1"},Gs={class:"sm:col-span-9 col-span-8"},Js={class:"relative"},Ks={class:"relative w-full cursor-default overflow-hidden rounded-lg bg-transparent text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"},Os={key:0,class:"relative cursor-default select-none py-2 px-4 text-gray-700"},Qs={class:"lg:hidden block col-span-4"},Ws={class:"lg:block hidden col-span-1 ml-5"},Xs={layout:(U,n)=>U(M,()=>child),layout:M},mt=Object.assign(Xs,{__name:"Adresses",props:["panier","client"],setup(U){const n=U,_=["Allemagne","Autriche","Belgique","Bulgarie","Chypre","Croatie","Danemark","Espagne","Estonie","Finlande","France","Gr\xE8ce","Hongrie","Irlande","Italie","Lettonie","Lituanie","Luxembourg","Malte","Pays-Bas","Pologne","Portugal","R\xE9publique tch\xE8que","Roumanie","Slovaquie","Slov\xE9nie","Su\xE8de"];var I=["Panier","Adresse Livraison / Facturation","Finaliser commande"],R=["/cart","/cart/adresses","/cart/validation"];let r=w(""),V=G(()=>r.value===""?_:_.filter(y=>y.toLowerCase().replace(/\s+/g,"").includes(r.value.toLowerCase().replace(/\s+/g,""))));const v=w(!0),l=J({email:n.client.email!=null?n.client.email:"",tel:n.client.tel!=null?n.client.tel:"",nom_adresse:n.client.nom_adresse!=null?n.client.nom_adresse:"",adresse1:n.client.adresse1!=null?n.client.adresse1:"",adresse2:n.client.adresse2!=null?n.client.adresse2:"",adresse3:n.client.adresse3!=null?n.client.adresse3:"",code_postal:n.client.code_postal!=null?n.client.code_postal:"",ville:n.client.ville!=null?n.client.ville:"",pays:w(_[n.client.pays!=null?_.indexOf(n.client.pays)?_.indexOf(n.client.pays):10:""]),sameAdresseFact:w(v),nom_adresse_facturation:n.client.nom_adresse_facturation!=null?n.client.nom_adresse_facturation:"",adresse1_facturation:n.client.adresse1_facturation!=null?n.client.adresse1_facturation:"",adresse2_facturation:n.client.adresse2_facturation!=null?n.client.adresse2_facturation:"",adresse3_facturation:n.client.adresse3_facturation!=null?n.client.adresse3_facturation:"",code_postal_facturation:n.client.code_postal_facturation!=null?n.client.code_postal_facturation:"",ville_facturation:n.client.ville_facturation!=null?n.client.ville_facturation:"",pays_facturation:w(_[n.client.pays_facturation!=null?_.indexOf(n.client.pays_facturation)?_.indexOf(n.client.pays_facturation):10:""])});var C=()=>{console.log(l.data()),l.post(route("cart/adresses"),{onSuccess:y=>{y.props.session.status==!0?document.location.href="/cart/validation":y.props.session.status==!1&&Toast.fire({icon:"error",title:"Une erreur s'est produite lors de l'enregistrement de votre adresse, veuillez ressayer !"})}})};return(y,o)=>(g(),b(q,null,[a(s(K),{title:"Adresse de livraison / facturation - Panier"}),e("section",ee,[se,e("form",{onSubmit:o[22]||(o[22]=F((...t)=>s(C)&&s(C)(...t),["prevent"])),class:"grid grid-cols-4"},[e("div",te,[a(Y,{hrefEtape:s(R),etape:2,nbEtape:3,listeEtape:s(I)},null,8,["hrefEtape","listeEtape"])]),e("div",ae,[e("div",le,[e("div",oe,[ne,e("div",re,[e("div",ie,[e("div",de,[e("label",ce,[e("span",pe,[a(O)]),i(" E-Mail :")])]),e("div",ue,[c(e("input",{type:"text",id:"mail_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"email",required:"",autofocus:"",autocomplete:"email","onUpdate:modelValue":o[0]||(o[0]=t=>s(l).email=t)},null,512),[[p,s(l).email]]),a(d,{class:"mt-2",message:s(l).errors.email},null,8,["message"])])]),e("div",me,[e("div",ge,[e("label",fe,[e("span",_e,[a(Q)]),i(" T\xE9l\xE9phone :")])]),e("div",be,[c(e("input",{type:"text",id:"tel_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"tel",required:"",autofocus:"",autocomplete:"tel","onUpdate:modelValue":o[1]||(o[1]=t=>s(l).tel=t)},null,512),[[p,s(l).tel]]),a(d,{class:"mt-2",message:s(l).errors.tel},null,8,["message"])])])])]),e("div",xe,[ye,e("div",he,[e("div",ve,[e("div",we,[e("label",ke,[e("span",Ve,[a(u)]),i(" Nom adresse :")])]),e("div",Ae,[c(e("input",{type:"text",id:"nom_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"nom_adresse",required:"",autofocus:"","onUpdate:modelValue":o[2]||(o[2]=t=>s(l).nom_adresse=t)},null,512),[[p,s(l).nom_adresse]]),a(d,{class:"mt-2",message:s(l).errors.nom_adresse},null,8,["message"])])]),e("div",Ue,[e("div",qe,[e("label",Ce,[e("span",Fe,[a(u)]),i(" Adresse 1 :")])]),e("div",Ee,[c(e("input",{type:"text",id:"adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse1",required:"",autofocus:"",autocomplete:"address-line1","onUpdate:modelValue":o[3]||(o[3]=t=>s(l).adresse1=t)},null,512),[[p,s(l).adresse1]]),a(d,{class:"mt-2",message:s(l).errors.adresse1},null,8,["message"])])]),e("div",Le,[e("div",Se,[e("label",Be,[e("span",Pe,[a(u)]),i(" Adresse 2 :")])]),e("div",je,[c(e("input",{type:"text",id:"complement_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse2",autofocus:"",autocomplete:"address-line2","onUpdate:modelValue":o[4]||(o[4]=t=>s(l).adresse2=t)},null,512),[[p,s(l).adresse2]]),a(d,{class:"mt-2",message:s(l).errors.adresse2},null,8,["message"])])]),e("div",Me,[e("div",Ne,[e("label",ze,[e("span",He,[a(u)]),i(" Adresse 3 :")])]),e("div",Te,[c(e("input",{type:"text",id:"information_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse3",autofocus:"",autocomplete:"address-line3","onUpdate:modelValue":o[5]||(o[5]=t=>s(l).adresse3=t)},null,512),[[p,s(l).adresse3]]),a(d,{class:"mt-2",message:s(l).errors.adresse3},null,8,["message"])])]),e("div",$e,[e("div",De,[e("label",Ie,[e("span",Re,[a(u)]),i(" Code postal :")])]),e("div",Ge,[c(e("input",{type:"text",id:"cp_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"code_postal",required:"",autofocus:"",autocomplete:"postal-code","onUpdate:modelValue":o[6]||(o[6]=t=>s(l).code_postal=t)},null,512),[[p,s(l).code_postal]]),a(d,{class:"mt-2",message:s(l).errors.code_postal},null,8,["message"])])]),e("div",Je,[e("div",Ke,[e("label",Oe,[e("span",Qe,[a(u)]),i(" Ville :")])]),e("div",We,[c(e("input",{type:"text",id:"ville_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"ville",required:"",autofocus:"",autocomplete:"city","onUpdate:modelValue":o[7]||(o[7]=t=>s(l).ville=t)},null,512),[[p,s(l).ville]]),a(d,{class:"mt-2",message:s(l).errors.ville},null,8,["message"])])]),e("div",Xe,[e("div",Ye,[e("label",Ze,[e("span",es,[a(B)]),i(" Pays :")])]),e("div",ss,[a(s(N),{modelValue:s(l).pays,"onUpdate:modelValue":o[10]||(o[10]=t=>s(l).pays=t)},{default:m(()=>[e("div",ts,[e("div",as,[a(s(z),{class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",displayValue:t=>t,onChange:o[8]||(o[8]=t=>A(r)?r.value=t.target.value:r=t.target.value),name:"pays",required:"",autofocus:""},null,8,["displayValue"]),a(s(H),{class:"absolute inset-y-0 right-0 flex items-center pr-2"},{default:m(()=>[a(P,{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]),_:1})]),a(s(D),{leave:"transition ease-in duration-100",leaveFrom:"opacity-100",leaveTo:"opacity-0",onAfterLeave:o[9]||(o[9]=t=>A(r)?r.value="":r="")},{default:m(()=>[a(s(T),{class:"absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"},{default:m(()=>[s(V).length===0&&s(r)!==""?(g(),b("div",ls," Nothing found. ")):k("",!0),(g(!0),b(q,null,E(s(V),t=>(g(),L(s($),{as:"template",key:t,value:t},{default:m(({selected:h,active:f})=>[e("li",{class:x(["relative cursor-default select-none py-2 pl-10 pr-4",{"bg-teal-600 text-white":f,"text-gray-900":!f}])},[e("span",{class:x(["block truncate",{"font-medium":h,"font-normal":!h}])},S(t),3),h?(g(),b("span",{key:0,class:x(["absolute inset-y-0 left-0 flex items-center pl-3",{"text-white":f,"text-teal-600":!f}])},[a(j,{class:"h-5 w-5","aria-hidden":"true"})],2)):k("",!0)],2)]),_:2},1032,["value"]))),128))]),_:1})]),_:1})])]),_:1},8,["modelValue"]),a(d,{class:"mt-2",message:s(l).errors.pays},null,8,["message"])])]),e("div",os,[ns,e("div",rs,[a(s(Z),{id:"sameAdresseFact",modelValue:v.value,"onUpdate:modelValue":o[11]||(o[11]=t=>v.value=t),class:x([v.value?"bg-blue-600":"bg-gray-200","relative inline-flex h-6 w-11 items-center rounded-full"])},{default:m(()=>[is,e("span",{class:x([v.value?"translate-x-6":"translate-x-1","inline-block h-4 w-4 transform rounded-full bg-white transition"])},null,2)]),_:1},8,["modelValue","class"])])])])]),v.value?k("",!0):(g(),b("div",ds,[cs,e("div",{onSubmit:o[21]||(o[21]=F((...t)=>y.submit&&y.submit(...t),["prevent"])),class:"grid grid-cols-1 gap-4 p-5 mx-5",id:"form_client"},[e("div",ps,[e("div",us,[e("label",ms,[e("span",gs,[a(u)]),i(" Nom adresse :")])]),e("div",fs,[c(e("input",{type:"text",id:"nom_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"nom_adresse",required:"",autofocus:"","onUpdate:modelValue":o[12]||(o[12]=t=>s(l).nom_adresse_facturation=t)},null,512),[[p,s(l).nom_adresse_facturation]]),a(d,{class:"mt-2",message:s(l).errors.nom_adresse_facturation},null,8,["message"])])]),e("div",_s,[e("div",bs,[e("label",xs,[e("span",ys,[a(u)]),i(" Adresse 1 :")])]),e("div",hs,[c(e("input",{type:"text",id:"adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse1",required:"",autofocus:"",autocomplete:"address-line1","onUpdate:modelValue":o[13]||(o[13]=t=>s(l).adresse1_facturation=t)},null,512),[[p,s(l).adresse1_facturation]]),a(d,{class:"mt-2",message:s(l).errors.adresse1_facturation},null,8,["message"])])]),e("div",vs,[e("div",ws,[e("label",ks,[e("span",Vs,[a(u)]),i(" Adresse 2 :")])]),e("div",As,[c(e("input",{type:"text",id:"complement_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse2",autofocus:"",autocomplete:"address-line2","onUpdate:modelValue":o[14]||(o[14]=t=>s(l).adresse2_facturation=t)},null,512),[[p,s(l).adresse2_facturation]]),a(d,{class:"mt-2",message:s(l).errors.adresse2_facturation},null,8,["message"])])]),e("div",Us,[e("div",qs,[e("label",Cs,[e("span",Fs,[a(u)]),i(" Adresse 3 :")])]),e("div",Es,[c(e("input",{type:"text",id:"information_adresse_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"adresse3",autofocus:"",autocomplete:"address-line3","onUpdate:modelValue":o[15]||(o[15]=t=>s(l).adresse3_facturation=t)},null,512),[[p,s(l).adresse3_facturation]]),a(d,{class:"mt-2",message:s(l).errors.adresse3_facturation},null,8,["message"])])]),e("div",Ls,[e("div",Ss,[e("label",Bs,[e("span",Ps,[a(u)]),i(" Code postal :")])]),e("div",js,[c(e("input",{type:"text",id:"cp_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"code_postal",required:"",autofocus:"",autocomplete:"postal-code","onUpdate:modelValue":o[16]||(o[16]=t=>s(l).code_postal_facturation=t)},null,512),[[p,s(l).code_postal_facturation]]),a(d,{class:"mt-2",message:s(l).errors.code_postal_facturation},null,8,["message"])])]),e("div",Ms,[e("div",Ns,[e("label",zs,[e("span",Hs,[a(u)]),i(" Ville :")])]),e("div",Ts,[c(e("input",{type:"text",id:"ville_client",class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",name:"ville",required:"",autofocus:"",autocomplete:"city","onUpdate:modelValue":o[17]||(o[17]=t=>s(l).ville_facturation=t)},null,512),[[p,s(l).ville_facturation]]),a(d,{class:"mt-2",message:s(l).errors.ville_facturation},null,8,["message"])])]),e("div",$s,[e("div",Ds,[e("label",Is,[e("span",Rs,[a(B)]),i(" Pays :")])]),e("div",Gs,[a(s(N),{modelValue:s(l).pays_facturation,"onUpdate:modelValue":o[20]||(o[20]=t=>s(l).pays_facturation=t)},{default:m(()=>[e("div",Js,[e("div",Ks,[a(s(z),{class:"bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-sm leading-5 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-primary-200 focus:ring-0",displayValue:t=>t,onChange:o[18]||(o[18]=t=>A(r)?r.value=t.target.value:r=t.target.value),name:"pays",required:"",autofocus:""},null,8,["displayValue"]),a(s(H),{class:"absolute inset-y-0 right-0 flex items-center pr-2"},{default:m(()=>[a(P,{class:"h-5 w-5 text-gray-400","aria-hidden":"true"})]),_:1})]),a(s(D),{leave:"transition ease-in duration-100",leaveFrom:"opacity-100",leaveTo:"opacity-0",onAfterLeave:o[19]||(o[19]=t=>A(r)?r.value="":r="")},{default:m(()=>[a(s(T),{class:"absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-gray-200 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"},{default:m(()=>[s(V).length===0&&s(r)!==""?(g(),b("div",Os," Nothing found. ")):k("",!0),(g(!0),b(q,null,E(s(V),t=>(g(),L(s($),{as:"template",key:t,value:t},{default:m(({selected:h,active:f})=>[e("li",{class:x(["relative cursor-default select-none py-2 pl-10 pr-4",{"bg-teal-600 text-white":f,"text-gray-900":!f}])},[e("span",{class:x(["block truncate",{"font-medium":h,"font-normal":!h}])},S(t),3),h?(g(),b("span",{key:0,class:x(["absolute inset-y-0 left-0 flex items-center pl-3",{"text-white":f,"text-teal-600":!f}])},[a(j,{class:"h-5 w-5","aria-hidden":"true"})],2)):k("",!0)],2)]),_:2},1032,["value"]))),128))]),_:1})]),_:1})])]),_:1},8,["modelValue"]),a(d,{class:"mt-2",message:s(l).errors.pays},null,8,["message"])])])],32)]))]),e("div",Qs,[a(W,{linkEtapeSuivant:"/cart/validation",titreLink:"Valider mon adresse",panier:n.panier,isButtonSubmit:!0},null,8,["panier"])]),e("div",Ws,[a(X,{linkEtapeSuivant:"/cart/validation",titreLink:"Valider mon adresse",panier:n.panier,isButtonSubmit:!0},null,8,["panier"])])])],32)])],64))}});export{mt as default};
