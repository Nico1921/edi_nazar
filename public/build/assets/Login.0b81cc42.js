import{c as _,w as p,v as b,u as o,o as h,a as f,i as x,b as w,d as a,e as u,F as k,H as y,f as e,g as m,t as i,n as v,L as $,h as T,j as B}from"./app.6f12f04b.js";import{_ as z,p as L}from"./GuestLayout.a8e55a77.js";import{i as S,f as C,l as M}from"./Linkedin.5cb86d23.js";import{_ as g}from"./InputError.413a770f.js";import"./LangueChoice.869b46ff.js";const N=["value"],U={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(d,{emit:c}){const s=d,n=_({get(){return s.checked},set(t){c("update:checked",t)}});return(t,l)=>p((h(),f("input",{type:"checkbox",value:d.value,"onUpdate:modelValue":l[0]||(l[0]=r=>x(n)?n.value=r:null),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,8,N)),[[b,o(n)]])}},V=["onSubmit"],F={class:"grid justify-center"},D=["src"],j={class:"pb-2 pt-4"},P=["placeholder"],R={class:"pb-2 pt-4"},H=["placeholder"],I={class:"block mt-4"},O={class:"flex items-center"},q={class:"ml-2 text-sm text-gray-600"},A={class:"px-4 pb-2 pt-4"},E=["disabled"],G={class:"px-4 text-center flex flex-col justify-center lg:hidden text-[28px]"},J={class:"w-full py-4"},K={class:"w-full flex items-center"},Q=e("hr",{class:"w-full"},null,-1),W={class:"px-2 text-xl"},X=e("hr",{class:"w-full"},null,-1),Y={class:"w-full"},Z={class:"w-full pt-2"},ee={href:"https://www.pinterest.fr/nazarrugsfrance/",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Pinterest"},se={href:"https://www.instagram.com/nazar_rugs/",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Instagram"},te={href:"https://www.facebook.com/Nazarrugs-102036118298025",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Facebook"},oe={href:"https://fr.linkedin.com/company/nazar-rugs",class:"px-2",rel:"noopener",target:"_blank","aria-label":"Linkedin"},de={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(d){const c=new URL("/build/assets/Nazar Logo.42bad03b.svg",self.location).href,s=w({email:"",password:"",remember:!1}),n=()=>{s.post(route("login"),{onFinish:()=>s.reset("password")})};return(t,l)=>(h(),f(k,null,[a(o(y),{title:t.$t("login.title")},null,8,["title"]),a(z,{TextTitre:t.$t("login.text-titre"),SousTitre:t.$t("login.text-sous-titre"),TextBouttonTitre:t.$t("login.text-btn-titre"),hrefBtnTitre:"register"},{default:u(()=>[e("form",{onSubmit:B(n,["prevent"]),class:"sm:w-2/3 w-11/12 px-4 py-5 lg:px-0 mx-auto bg-primary-50 rounded"},[e("h1",F,[e("img",{alt:"Logo Nazar",src:o(c),width:"300",height:"300",class:"sm:w-[300px] sm:h-[300px] w-[200px] h-[200px]"},null,8,D)]),e("div",j,[p(e("input",{type:"text",name:"email",id:"email",placeholder:t.$t("login.labelIdentifiant"),class:"block w-full sm:p-4 p-2 text-lg rounded-sm bg-primary-100","onUpdate:modelValue":l[0]||(l[0]=r=>o(s).email=r),required:"",autofocus:"",autocomplete:"username"},null,8,P),[[m,o(s).email]]),a(g,{class:"mt-2",message:o(s).errors.email},null,8,["message"])]),e("div",R,[p(e("input",{class:"block w-full sm:p-4 p-2 text-lg rounded-sm bg-primary-100","onUpdate:modelValue":l[1]||(l[1]=r=>o(s).password=r),type:"password",name:"password",id:"password",placeholder:t.$t("login.labelMotDePasse")},null,8,H),[[m,o(s).password]]),a(g,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),e("div",I,[e("label",O,[a(U,{name:"remember",checked:o(s).remember,"onUpdate:checked":l[2]||(l[2]=r=>o(s).remember=r)},null,8,["checked"]),e("span",q,i(t.$t("login.seSouvenirDeMoi")),1)])]),e("div",A,[e("button",{class:v([{"opacity-25":o(s).processing},"block w-full p-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none"]),disabled:o(s).processing},i(t.$t("login.btnConnexion")),11,E)]),e("div",G,[e("div",J,[e("div",K,[Q,e("span",W,i(t.$t("Or")),1),X])]),e("div",Y,[a(o($),{href:t.route("register"),class:"block w-full text-center px-5 py-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none"},{default:u(()=>[T(i(t.$t("login.btnMobileOr")),1)]),_:1},8,["href"])]),e("div",Z,[e("a",ee,[a(L)]),e("a",se,[a(S)]),e("a",te,[a(C)]),e("a",oe,[a(M)])])])],40,V)]),_:1},8,["TextTitre","SousTitre","TextBouttonTitre"])],64))}};export{de as default};
