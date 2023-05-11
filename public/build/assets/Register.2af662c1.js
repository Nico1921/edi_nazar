import{o as p,a as u,f as e,t as a,k,m as T,b as E,I as C,A as K,d as l,u as t,e as h,F as q,H as A,h as x,w as d,g as m,n as B,L,j as N,a6 as $}from"./app.5a12a6b8.js";import{u as U}from"./Account.982bb096.js";import{d as S}from"./Domain.62ff3ad3.js";import{_ as z,p as F}from"./GuestLayout.591a359e.js";import{i as M,f as P,l as j}from"./Linkedin.a0efaac8.js";import{_ as D}from"./_plugin-vue_export-helper.cdc0426e.js";import{_ as n}from"./InputError.e008e16c.js";import{T as H}from"./floating-vue.es.1287448b.js";const O={name:"HelpCircleOutlineIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},J=["aria-hidden","aria-label"],R=["fill","width","height"],Z={d:"M11,18H13V16H11V18M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,6A4,4 0 0,0 8,10H10A2,2 0 0,1 12,8A2,2 0 0,1 14,10C14,12 11,11.75 11,15H13C13,12.75 16,12.5 16,10A4,4 0 0,0 12,6Z"},G={key:0};function Q(v,b,s,c,_,w){return p(),u("span",T(v.$attrs,{"aria-hidden":!s.title,"aria-label":s.title,class:"material-design-icon help-circle-outline-icon",role:"img",onClick:b[0]||(b[0]=y=>v.$emit("click",y))}),[(p(),u("svg",{fill:s.fillColor,class:"material-design-icon__svg",width:s.size,height:s.size,viewBox:"0 0 24 24"},[e("path",Z,[s.title?(p(),u("title",G,a(s.title),1)):k("",!0)])],8,R))],16,J)}const W=D(O,[["render",Q]]),X=["onSubmit"],Y={class:"grid justify-center"},ee=["src"],te={key:0,class:"grid grid-cols-1"},se={class:"p-3 rounded-lg shadow text-left text-black grid grid-cols-1"},re={class:"text-3xl"},ie={class:"grid grid-cols-2 items-center p-1"},oe={for:"nom",class:"w-auto"},le={class:"grid grid-cols-2 items-center p-1"},ae={for:"prenom"},ne={class:"grid grid-cols-2 items-center p-1"},de={for:"email"},me={class:"grid grid-cols-2 items-center p-1"},ce={for:"email_confirmation"},pe={class:"grid grid-cols-2 items-center p-1"},ue={for:"tel"},ge={enctype:"multipart/form-data",class:"grid grid-cols-2 items-center p-1"},fe={class:"col-span-1 flex"},be=e("span",{class:"w-52 block"},"Il s\u2019agit d\u2019une proc\xE9dure afin de s\u2019assurer de l\u2019identit\xE9 de la personne faisant la demande d\u2019inscription, dans le but d\u2019\xE9viter toutes tentatives de fraudes. Cette derni\xE8re sera supprim\xE9e une fois votre inscription valid\xE9e.",-1),_e=e("label",{class:"pl-1",for:"fileIdentiter"}," Pi\xE8ce identiter du dirigeant :",-1),ye=e("label",{id:"labelIdentiter",class:"cursor-pointer text-center p-1 text-lg text-gray-700 border-[1px] border-primary-300 rounded-sm bg-primary-100",for:"fileIdentiter"},"Importer ma pi\xE8ce",-1),he=e("span",{id:"uploadIdentiter",class:"hidden text-green-700"},"Importer avec succ\xE9es",-1),xe=e("span",{id:"uploadErrorIdentiter",class:"hidden text-red-600"},null,-1),ve={class:"p-3 rounded-lg shadow text-left text-black grid grid-cols-1"},ke={class:"text-3xl"},we={class:"grid grid-cols-2 items-center p-1"},Ie={for:"nom_societe",class:"w-auto"},Ve={class:"grid grid-cols-2 items-center p-1"},$e={for:"numTVA"},Te={class:"grid grid-cols-2 items-center p-1"},Ee={for:"adresse"},Ce={class:"grid grid-cols-2 items-center p-1"},Ke={for:"cp"},qe={class:"grid grid-cols-2 items-center p-1"},Ae={for:"ville"},Be={class:"grid grid-cols-2 items-center p-1"},Le={for:"pays"},Ne=e("label",{for:"fileKbis"},"Kbis entreprise -3 mois :",-1),Ue=e("label",{id:"labelKbis",class:"cursor-pointer text-center p-1 text-lg text-gray-700 border-[1px] border-primary-300 rounded-sm bg-primary-100",for:"fileKbis"},"Importer mon Kbis",-1),Se=e("span",{id:"uploadKbis",class:"hidden text-green-700"},"Importer avec succ\xE9es",-1),ze=e("span",{id:"uploadErrorKbis",class:"hidden text-red-600"},null,-1),Fe={class:"flex items-center my-2 mx-1"},Me=e("label",{for:"checkPolitique",class:"ml-2 text-lg font-medium text-gray-900"},[x("J'accepte la "),e("a",{href:"/politique-confidentialite",class:"text-gray-400 underline hover:text-[1.15rem] cursor-pointer transition-all duration-300"},"politique de confidentialit\xE9")],-1),Pe={key:0,class:"px-4 pb-2 pt-4"},je=["disabled"],De={key:1,class:"px-4 pb-2 pt-4"},He={type:"button",class:"cursor-not-allowed block w-full p-2 text-lg rounded-full bg-primary-100 text-primary-200 focus:outline-none"},Oe={key:1,class:"p-2 rounded-lg shadow grid grid-cols-1"},Je={key:0,class:"whitespace-pre-line"},Re={class:"text-[30px]"},Ze={key:1},Ge={class:"px-4 text-center flex flex-col justify-center lg:hidden text-[28px]"},Qe={class:"w-full py-4"},We={class:"w-full flex items-center"},Xe=e("hr",{class:"w-full"},null,-1),Ye={class:"px-2 text-xl"},et=e("hr",{class:"w-full"},null,-1),tt={class:"w-full"},st={class:"w-full py-3"},rt={href:"https://www.pinterest.fr/nazarrugsfrance/",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Pinterest"},it={href:"https://www.instagram.com/nazar_rugs/",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Instagram"},ot={href:"https://www.facebook.com/Nazarrugs-102036118298025",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Facebook"},lt={href:"https://fr.linkedin.com/company/nazar-rugs",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Linkedin"},ft={__name:"Register",setup(v){const b=new URL("/build/assets/Nazar Logo.42bad03b.svg",self.location).href,s=E({nom:"",prenom:"",email:"",email_confirmation:"",tel:"",nom_societe:"",numTVA:"",adresse:"",cp:"",ville:"",pays:"",nameFileKbis:"",nameFileIdentiter:""}),c=C().props.value;var _=K(!1);const w=()=>{s.post(route("register"),{onSuccess:i=>{c.sendMessage=!0,c.messageValidation=$("register.messageValidation")},onError:i=>{s.errors.length&&(c.sendMessage=!1,c.messageValidation=$("register.messageValidationError"))}})};var y=i=>{i.preventDefault();let r=i.target;const o={headers:{"content-type":"multipart/form-data"}};let f=new FormData;f.append("fileKbis",r.files[0]),axios.post("/uploadKbis",f,o).then(function(g){s.nameFileKbis=g.data.fileName,document.getElementById("labelKbis").classList.add("hidden"),document.getElementById("uploadErrorKbis").classList.add("hidden"),document.getElementById("uploadKbis").classList.remove("hidden")}).catch(function(g){document.getElementById("uploadErrorKbis").textContent=g.response.data.message,document.getElementById("uploadErrorKbis").classList.remove("hidden"),r.value=""})},I=i=>{i.preventDefault();let r=i.target;const o={headers:{"content-type":"multipart/form-data"}};let f=new FormData;f.append("fileIdentiter",r.files[0]),axios.post("/uploadIdentiter",f,o).then(function(g){s.nameFileIdentiter=g.data.fileName,document.getElementById("labelIdentiter").classList.add("hidden"),document.getElementById("uploadErrorIdentiter").classList.add("hidden"),document.getElementById("uploadIdentiter").classList.remove("hidden")}).catch(function(g){document.getElementById("uploadErrorIdentiter").textContent=g.response.data.message,document.getElementById("uploadErrorIdentiter").classList.remove("hidden"),r.value=""})},V=i=>{i.target.checked?_.value=!0:_.value=!1};return(i,r)=>(p(),u(q,null,[l(t(A),{title:i.$t("register.title")},null,8,["title"]),l(z,{TextTitre:i.$t("register.text-titre"),SousTitre:i.$t("register.text-sous-titre"),TextBouttonTitre:i.$t("register.text-btn-titre"),hrefBtnTitre:"login"},{default:h(()=>[e("form",{class:"xl:w-2/3 lg:w-full sm:w-2/3 px-4 lg:px-0 mx-auto bg-primary-50 rounded",onSubmit:N(w,["prevent"])},[e("h1",Y,[e("img",{alt:"Logo Nazar",src:t(b),width:"150",height:"150"},null,8,ee)]),typeof t(c).sendMessage>"u"?(p(),u("div",te,[e("div",se,[e("h2",re,[l(U),x(" "+a(i.$t("register.labelDiv1")),1)]),e("div",ie,[e("label",oe,a(i.$t("register.labelNom"))+" :",1),d(e("input",{class:"block w-full p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[0]||(r[0]=o=>t(s).nom=o),type:"text",name:"nom",id:"nom",required:"",autofocus:"",autocomplete:"family-name"},null,512),[[m,t(s).nom]]),l(n,{class:"mt-2",message:t(s).errors.nom},null,8,["message"])]),e("div",le,[e("label",ae,a(i.$t("register.labelPrenom"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[1]||(r[1]=o=>t(s).prenom=o),type:"text",name:"prenom",id:"prenom",required:"",autofocus:"",autocomplete:"given-name"},null,512),[[m,t(s).prenom]]),l(n,{class:"mt-2",message:t(s).errors.prenom},null,8,["message"])]),e("div",ne,[e("label",de,a(i.$t("register.labelEmail"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[2]||(r[2]=o=>t(s).email=o),type:"email",name:"email",id:"email",required:"",autofocus:"",autocomplete:"email"},null,512),[[m,t(s).email]]),l(n,{class:"mt-2",message:t(s).errors.email},null,8,["message"])]),e("div",me,[e("label",ce,a(i.$t("register.labelEmailConfirm"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[3]||(r[3]=o=>t(s).email_confirmation=o),type:"email",name:"email_confirmation",id:"email_confirmation",required:"",autofocus:"",autocomplete:"email"},null,512),[[m,t(s).email_confirmation]]),l(n,{class:"mt-2",message:t(s).errors.email_confirmation},null,8,["message"])]),e("div",pe,[e("label",ue,a(i.$t("register.labelTel"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[4]||(r[4]=o=>t(s).tel=o),type:"tel",name:"tel",id:"tel",required:"",autofocus:"",autocomplete:"tel"},null,512),[[m,t(s).tel]]),l(n,{class:"mt-2",message:t(s).errors.tel},null,8,["message"])]),e("form",ge,[e("div",fe,[l(t(H),{placement:"left",triggers:["hover","focus","click"]},{popper:h(()=>[be]),default:h(()=>[l(W)]),_:1}),_e]),ye,he,xe,e("input",{accept:".jpg,.jpeg,.png,.pdf",onChange:r[5]||(r[5]=(...o)=>t(I)&&t(I)(...o)),class:"hidden",type:"file",name:"fileIdentiter",id:"fileIdentiter",required:""},null,32),l(n,{class:"mt-2",message:t(s).errors.nameFileIdentiter},null,8,["message"])])]),e("div",ve,[e("h2",ke,[l(S),x(" "+a(i.$t("register.labelDiv2")),1)]),e("div",we,[e("label",Ie,a(i.$t("register.labelNomSociete"))+" :",1),d(e("input",{class:"block w-full p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[6]||(r[6]=o=>t(s).nom_societe=o),type:"text",name:"nom_societe",id:"nom_societe",required:"",autofocus:"",autocomplete:"organization"},null,512),[[m,t(s).nom_societe]]),l(n,{class:"mt-2",message:t(s).errors.nom_societe},null,8,["message"])]),e("div",Ve,[e("label",$e,a(i.$t("register.labelNumTVA"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[7]||(r[7]=o=>t(s).numTVA=o),type:"text",name:"numTVA",id:"numTVA",required:"",autofocus:""},null,512),[[m,t(s).numTVA]]),l(n,{class:"mt-2",message:t(s).errors.numTVA},null,8,["message"])]),e("div",Te,[e("label",Ee,a(i.$t("register.labelAdresse"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[8]||(r[8]=o=>t(s).adresse=o),type:"text",name:"adresse",id:"adresse",required:"",autofocus:"",autocomplete:"street-address"},null,512),[[m,t(s).adresse]]),l(n,{class:"mt-2",message:t(s).errors.adresse},null,8,["message"])]),e("div",Ce,[e("label",Ke,a(i.$t("register.labelCP"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[9]||(r[9]=o=>t(s).cp=o),type:"text",name:"cp",id:"cp",required:"",autofocus:"",autocomplete:"postal-code"},null,512),[[m,t(s).cp]]),l(n,{class:"mt-2",message:t(s).errors.cp},null,8,["message"])]),e("div",qe,[e("label",Ae,a(i.$t("register.labelVille"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[10]||(r[10]=o=>t(s).ville=o),type:"text",name:"ville",id:"ville",required:"",autofocus:"",autocomplete:"city"},null,512),[[m,t(s).ville]]),l(n,{class:"mt-2",message:t(s).errors.ville},null,8,["message"])]),e("div",Be,[e("label",Le,a(i.$t("register.labelPays"))+" :",1),d(e("input",{class:"block p-1 text-lg rounded-sm bg-primary-100 border-[1px] border-primary-300 text-gray-700","onUpdate:modelValue":r[11]||(r[11]=o=>t(s).pays=o),type:"text",name:"pays",id:"pays",required:"",autofocus:"",autocomplete:"country-name"},null,512),[[m,t(s).pays]]),l(n,{class:"mt-2",message:t(s).errors.pays},null,8,["message"])]),e("form",{onSubmit:r[13]||(r[13]=(...o)=>i.formSubmit&&i.formSubmit(...o)),enctype:"multipart/form-data",class:"grid grid-cols-2 items-center p-1"},[Ne,Ue,Se,ze,e("input",{accept:".jpg,.jpeg,.png,.pdf",onChange:r[12]||(r[12]=(...o)=>t(y)&&t(y)(...o)),class:"hidden",type:"file",name:"fileKbis",id:"fileKbis",required:""},null,32),l(n,{class:"mt-2",message:t(s).errors.fileKbis},null,8,["message"])],32)]),e("div",Fe,[e("input",{onClick:r[14]||(r[14]=(...o)=>t(V)&&t(V)(...o)),id:"checkPolitique",type:"checkbox",value:"1",class:"w-4 h-4 text-primary-200 bg-gray-100 border-gray-300 rounded focus:ring-primary-200 focus:ring-2 bg-primary-100"}),Me]),t(_)?(p(),u("div",Pe,[e("button",{class:B([{"opacity-25":t(s).processing},"block w-full p-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-100 focus:outline-none"]),disabled:t(s).processing},a(i.$t("register.btnInscription")),11,je)])):(p(),u("div",De,[e("button",He,a(i.$t("register.btnInscription")),1)]))])):k("",!0),typeof t(c).sendMessage<"u"?(p(),u("div",Oe,[t(c).sendMessage?(p(),u("div",Je,[e("h2",Re,a(i.$t("register.titleValidation")),1),e("span",null,a(t(c).messageValidation),1)])):(p(),u("div",Ze,[e("h2",null,a(i.$t("register.titleValidationError")),1),e("span",null,a(t(c).messageValidation),1)]))])):k("",!0),e("div",Ge,[e("div",Qe,[e("div",We,[Xe,e("span",Ye,a(i.$t("Or")),1),et])]),e("div",tt,[l(t(L),{href:i.route("login"),class:"block w-full text-center px-5 py-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-100 focus:outline-none"},{default:h(()=>[x("Je me connecte")]),_:1},8,["href"])]),e("div",st,[e("a",rt,[l(F)]),e("a",it,[l(M)]),e("a",ot,[l(P)]),e("a",lt,[l(j)])])])],40,X)]),_:1},8,["TextTitre","SousTitre","TextBouttonTitre"])],64))}};export{ft as default};
