import{o as r,a as n,f as s,t as c,k as _,m as j,A as I,I as q,b as H,d as a,u as e,h as d,j as T,w as y,g as v,F as ee,H as se}from"./app.56690421.js";import{u as te}from"./Account.ccba2113.js";import{_ as S}from"./_plugin-vue_export-helper.cdc0426e.js";import{d as oe}from"./Domain.8b654051.js";import{E as A}from"./Pencil.3bdb224e.js";import{_ as F,C as $}from"./AuthenticatedLayout.43c8ac25.js";import{M as Q,P as le}from"./Email.99fa6ede.js";import{i as W,f as O,l as R}from"./Linkedin.e36c74fb.js";import{_ as x}from"./InputError.2c05f44b.js";import{_ as ie,r as ae}from"./Breadcrumbs.e9db807c.js";function re(m,p){return r(),n("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor","aria-hidden":"true"},[s("path",{"fill-rule":"evenodd",d:"M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z","clip-rule":"evenodd"})])}const ne={name:"AccountLockIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},ce=["aria-hidden","aria-label"],de=["fill","width","height"],ue={d:"M6 8C6 5.79 7.79 4 10 4S14 5.79 14 8 12.21 12 10 12 6 10.21 6 8M12 18.2C12 17.24 12.5 16.34 13.2 15.74V15.5C13.2 15.11 13.27 14.74 13.38 14.38C12.35 14.14 11.21 14 10 14C5.58 14 2 15.79 2 18V20H12V18.2M22 18.3V21.8C22 22.4 21.4 23 20.7 23H15.2C14.6 23 14 22.4 14 21.7V18.2C14 17.6 14.6 17 15.2 17V15.5C15.2 14.1 16.6 13 18 13C19.4 13 20.8 14.1 20.8 15.5V17C21.4 17 22 17.6 22 18.3M19.5 15.5C19.5 14.7 18.8 14.2 18 14.2C17.2 14.2 16.5 14.7 16.5 15.5V17H19.5V15.5Z"},me={key:0};function pe(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon account-lock-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",ue,[t.title?(r(),n("title",me,c(t.title),1)):_("",!0)])],8,de))],16,ce)}const fe=S(ne,[["render",pe]]),_e={name:"AccountDetailsIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},ge=["aria-hidden","aria-label"],be=["fill","width","height"],he={d:"M11 9C11 10.66 9.66 12 8 12C6.34 12 5 10.66 5 9C5 7.34 6.34 6 8 6C9.66 6 11 7.34 11 9M14 20H2V18C2 15.79 4.69 14 8 14C11.31 14 14 15.79 14 18M22 12V14H13V12M22 8V10H13V8M22 4V6H13V4Z"},xe={key:0};function ye(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon account-details-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",he,[t.title?(r(),n("title",xe,c(t.title),1)):_("",!0)])],8,be))],16,ge)}const ve=S(_e,[["render",ye]]),we={name:"LockIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},Ce=["aria-hidden","aria-label"],ke=["fill","width","height"],Me={d:"M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z"},ze={key:0};function Ve(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon lock-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",Me,[t.title?(r(),n("title",ze,c(t.title),1)):_("",!0)])],8,ke))],16,Ce)}const J=S(we,[["render",Ve]]),je={name:"AccountKeyIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},Se=["aria-hidden","aria-label"],Ne=["fill","width","height"],Ie={d:"M11 10V12H9V14H7V12H5.8C5.4 13.2 4.3 14 3 14C1.3 14 0 12.7 0 11S1.3 8 3 8C4.3 8 5.4 8.8 5.8 10H11M3 10C2.4 10 2 10.4 2 11S2.4 12 3 12 4 11.6 4 11 3.6 10 3 10M16 14C18.7 14 24 15.3 24 18V20H8V18C8 15.3 13.3 14 16 14M16 12C13.8 12 12 10.2 12 8S13.8 4 16 4 20 5.8 20 8 18.2 12 16 12Z"},Ae={key:0};function He(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon account-key-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",Ie,[t.title?(r(),n("title",Ae,c(t.title),1)):_("",!0)])],8,Ne))],16,Se)}const Le=S(je,[["render",He]]),Te={name:"SearchWebIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},$e=["aria-hidden","aria-label"],De=["fill","width","height"],Ue={d:"M15.5,14L20.5,19L19,20.5L14,15.5V14.71L13.73,14.43C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.43,13.73L14.71,14H15.5M9.5,4.5L8.95,4.53C8.71,5.05 8.34,5.93 8.07,7H10.93C10.66,5.93 10.29,5.05 10.05,4.53C9.87,4.5 9.69,4.5 9.5,4.5M13.83,7C13.24,5.97 12.29,5.17 11.15,4.78C11.39,5.31 11.7,6.08 11.93,7H13.83M5.17,7H7.07C7.3,6.08 7.61,5.31 7.85,4.78C6.71,5.17 5.76,5.97 5.17,7M4.5,9.5C4.5,10 4.58,10.53 4.73,11H6.87L6.75,9.5L6.87,8H4.73C4.58,8.47 4.5,9 4.5,9.5M14.27,11C14.42,10.53 14.5,10 14.5,9.5C14.5,9 14.42,8.47 14.27,8H12.13C12.21,8.5 12.25,9 12.25,9.5C12.25,10 12.21,10.5 12.13,11H14.27M7.87,8L7.75,9.5L7.87,11H11.13C11.21,10.5 11.25,10 11.25,9.5C11.25,9 11.21,8.5 11.13,8H7.87M9.5,14.5C9.68,14.5 9.86,14.5 10.03,14.47C10.28,13.95 10.66,13.07 10.93,12H8.07C8.34,13.07 8.72,13.95 8.97,14.47L9.5,14.5M13.83,12H11.93C11.7,12.92 11.39,13.69 11.15,14.22C12.29,13.83 13.24,13.03 13.83,12M5.17,12C5.76,13.03 6.71,13.83 7.85,14.22C7.61,13.69 7.3,12.92 7.07,12H5.17Z"},Pe={key:0};function Ee(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon search-web-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",Ue,[t.title?(r(),n("title",Pe,c(t.title),1)):_("",!0)])],8,De))],16,$e)}const Ye=S(Te,[["render",Ee]]),Be={name:"WebIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},Ze=["aria-hidden","aria-label"],Ge=["fill","width","height"],qe={d:"M16.36,14C16.44,13.34 16.5,12.68 16.5,12C16.5,11.32 16.44,10.66 16.36,10H19.74C19.9,10.64 20,11.31 20,12C20,12.69 19.9,13.36 19.74,14M14.59,19.56C15.19,18.45 15.65,17.25 15.97,16H18.92C17.96,17.65 16.43,18.93 14.59,19.56M14.34,14H9.66C9.56,13.34 9.5,12.68 9.5,12C9.5,11.32 9.56,10.65 9.66,10H14.34C14.43,10.65 14.5,11.32 14.5,12C14.5,12.68 14.43,13.34 14.34,14M12,19.96C11.17,18.76 10.5,17.43 10.09,16H13.91C13.5,17.43 12.83,18.76 12,19.96M8,8H5.08C6.03,6.34 7.57,5.06 9.4,4.44C8.8,5.55 8.35,6.75 8,8M5.08,16H8C8.35,17.25 8.8,18.45 9.4,19.56C7.57,18.93 6.03,17.65 5.08,16M4.26,14C4.1,13.36 4,12.69 4,12C4,11.31 4.1,10.64 4.26,10H7.64C7.56,10.66 7.5,11.32 7.5,12C7.5,12.68 7.56,13.34 7.64,14M12,4.03C12.83,5.23 13.5,6.57 13.91,8H10.09C10.5,6.57 11.17,5.23 12,4.03M18.92,8H15.97C15.65,6.75 15.19,5.55 14.59,4.44C16.43,5.07 17.96,6.34 18.92,8M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"},Fe={key:0};function Qe(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon web-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",qe,[t.title?(r(),n("title",Fe,c(t.title),1)):_("",!0)])],8,Ge))],16,Ze)}const X=S(Be,[["render",Qe]]),We={name:"TwitterIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},Oe=["aria-hidden","aria-label"],Re=["fill","width","height"],Je={d:"M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"},Xe={key:0};function Ke(m,p,t,i,C,u){return r(),n("span",j(m.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon twitter-icon",role:"img",onClick:p[0]||(p[0]=f=>m.$emit("click",f))}),[(r(),n("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[s("path",Je,[t.title?(r(),n("title",Xe,c(t.title),1)):_("",!0)])],8,Re))],16,Oe)}const K=S(We,[["render",Ke]]),es={class:"container mx-auto sm:px-7 mt-5"},ss={class:"grid grid-cols-4"},ts={class:"col-span-4 m-2 relative w-full pt-20 mr-2 pr-4 lg:hidden block"},os={class:"w-full flex items-center justify-center absolute top-0 z-30"},ls=["src"],is={for:"img_profil",class:"flex items-center justify-center cursor-pointer h-7 w-7 absolute sm:right-[40%] xsm:right-[38%] right-[35%] top-2 rounded-full bg-primary-50 hover:bg-primary-100 transition duration-300"},as=s("div",{class:"w-full flex items-center justify-center absolute top-0 z-20"},[s("i",{class:"block bg-white rounded-full h-36 w-36"})],-1),rs={class:"bg-gray-50 drop-shadow-xl rounded-lg min-h-full pt-16 p-4 z-10"},ns={class:"text-center font-bold text-lg"},cs={class:"text-center font-semibold text-sm block"},ds=s("h3",{class:"text-center font-semibold text-lg mt-5"},"Contact : ",-1),us={class:"flex sm:flex-row flex-col mx-2 mt-2 items-center justify-center"},ms={class:"mr-1"},ps={class:"mr-1"},fs={class:"mr-1"},_s={class:"mr-1"},gs={class:"lg:col-span-3 col-span-4 bg-gray-50 m-2 p-4 drop-shadow-xl rounded-lg h-full"},bs=s("h1",{class:"text-center font-bold text-xl"},"Votre profil",-1),hs={class:"m-4"},xs={class:"flex"},ys={class:"font-semibold text-lg mr-4 mt-0.5"},vs=s("span",{class:"text-white absolute px-2 left-6"},"Modifier",-1),ws=s("span",{class:"text-white absolute px-2 left-6"},"Annuler",-1),Cs={key:0,class:"grid grid-cols-4 mt-3"},ks={class:"lg:col-span-2 col-span-4"},Ms=s("span",{class:"lg:col-span-2 col-span-4"},"Mot de passe : ****************",-1),zs={class:"2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Vs={for:"email",class:"lg:w-2/12 sm:w-3/12 w-full"},js={class:"2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Ss={for:"email_confirmation",class:"sm:w-5/12 w-full"},Ns={class:"col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Is={for:"actualPassword",class:"sm:w-6/12 w-full"},As={class:"2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Hs={for:"password",class:"sm:w-6/12 w-full"},Ls={class:"2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Ts={for:"password_confirmation",class:"lg:w-6/12 sm:w-7/12 w-full"},$s=s("div",{class:"col-span-4 flex justify-center items-center"},[s("button",{type:"submit",class:"rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300"},"Sauvegarder")],-1),Ds={class:"m-4"},Us={class:"flex"},Ps={class:"font-semibold text-lg mr-4 mt-0.5"},Es=s("span",{class:"text-white absolute px-2 left-6"},"Modifier",-1),Ys=s("span",{class:"text-white absolute px-2 left-6"},"Annuler",-1),Bs={key:0,class:"grid grid-cols-4 mt-3"},Zs={class:"lg:col-span-2 col-span-4"},Gs={class:"lg:col-span-2 col-span-4"},qs={class:"2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Fs={for:"contact",class:"sm:w-5/12 w-full"},Qs={class:"2xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Ws={for:"phone",class:"sm:w-5/12 w-full"},Os=s("div",{class:"col-span-4 flex justify-center items-center"},[s("button",{type:"submit",class:"rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300"},"Sauvegarder")],-1),Rs={class:"m-4"},Js={class:"flex"},Xs={class:"font-semibold text-lg mr-4 mt-0.5"},Ks=s("span",{class:"text-white absolute px-2 left-6"},"Modifier",-1),et=s("span",{class:"text-white absolute px-2 left-6"},"Annuler",-1),st={key:0,class:"grid grid-cols-4 mt-3"},tt={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},ot={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},lt={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},it={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},at={class:"xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},rt=s("label",{for:"adresse",class:"sm:w-5/12 w-full"},"Adresse entreprise :",-1),nt={class:"xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},ct=s("label",{for:"cp",class:"sm:w-5/12 w-full"},"Code postal : ",-1),dt={class:"xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},ut=s("label",{for:"ville",class:"sm:w-5/12 w-full"},"Ville : ",-1),mt={class:"xl:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},pt=s("label",{for:"pays",class:"sm:w-5/12 w-full"},"Pays : ",-1),ft=s("div",{class:"col-span-4 flex justify-center items-center"},[s("button",{type:"submit",class:"rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300"},"Sauvegarder")],-1),_t={class:"m-4"},gt={class:"flex"},bt={class:"font-semibold text-lg mr-4 mt-0.5"},ht=s("span",{class:"text-white absolute px-2 left-6"},"Modifier",-1),xt=s("span",{class:"text-white absolute px-2 left-6"},"Annuler",-1),yt={key:0,class:"grid grid-cols-4 mt-3"},vt={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},wt={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},Ct={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},kt={class:"2xl:col-span-1 lg:col-span-2 col-span-4"},Mt={class:"col-span-4"},zt={class:"lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Vt={for:"social_twitter",class:"w-5/12"},jt={class:"lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},St={for:"social_insta",class:"w-5/12"},Nt={class:"lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},It={for:"social_facebook",class:"w-5/12"},At={class:"lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Ht={for:"social_linkedin",class:"w-5/12"},Lt={class:"lg:col-span-2 col-span-4 text-gray-400 rounded-xl border border-gray-400 px-4 mx-4 my-2"},Tt={for:"social_website",class:"w-5/12"},$t=s("div",{class:"col-span-4 flex justify-center items-center"},[s("button",{type:"submit",class:"rounded-2xl bg-primary-100 text-white px-4 py-2 m-2 hover:bg-primary-50 transition duration-300"},"Sauvegarder")],-1),Dt={class:"col-span-1 m-2 relative h-full w-full pt-20 lg:block hidden"},Ut={class:"w-full flex items-center justify-center absolute top-0 z-30"},Pt=["src"],Et={for:"img_profil",class:"flex items-center justify-center cursor-pointer h-7 w-7 absolute 2xl:right-28 xl:right-24 right-14 top-2 rounded-full bg-primary-50 hover:bg-primary-100 transition duration-300"},Yt=s("div",{class:"w-full flex items-center justify-center absolute top-0 z-20"},[s("i",{class:"block bg-white rounded-full h-36 w-36"})],-1),Bt={class:"bg-gray-50 drop-shadow-xl rounded-lg min-h-full pt-16 p-4 z-10"},Zt={class:"text-center font-bold text-lg"},Gt={class:"text-center font-semibold text-sm block"},qt=s("h3",{class:"text-center font-semibold text-lg mt-5"},"Contact : ",-1),Ft={class:"flex flex-col mx-2 mt-2"},Qt={layout:(m,p)=>m(F,()=>child),layout:F},lo=Object.assign(Qt,{__name:"Settings",setup(m){var p=[{title:"Accueil",link:"/",icon:ae,active:!1},{title:"Votre profil",link:"/settings",icon:re,active:!0}],t=I(q().props.value.auth.user[0]),i=I(q().props.value.auth.user[0].client);const C="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDQwMDAgNDAwMCIgd2lkdGg9IjEwMDAiIGhlaWdodD0iMTAwMCI+PHN0eWxlPi5he2ZpbGw6I2EzYTNhM30uYntmaWxsOiNmZmZ9PC9zdHlsZT48cGF0aCBjbGFzcz0iYSIgZD0ibTQwMDAgNDAwMGgtNDAwMHYtNDAwMGg0MDAweiIvPjxwYXRoIGNsYXNzPSJiIiBkPSJtMzI2NSAzMDQ2Ljh2MjY1LjJoLTI1MzB2LTI2NS4yYzAtNDg5IDU2Ni40LTg4NS41IDEyNjUtODg1LjUgNjk4LjYgMCAxMjY1IDM5Ni41IDEyNjUgODg1LjV6Ii8+PHBhdGggY2xhc3M9ImIiIGQ9Im0yNjI0LjEgMTMxMi4xYzAgMzQ0LjYtMjc5LjQgNjI0LTYyNC4xIDYyNC0zNDQuNyAwLTYyNC4xLTI3OS40LTYyNC4xLTYyNCAwLTM0NC43IDI3OS40LTYyNC4xIDYyNC4xLTYyNC4xIDM0NC43IDAgNjI0LjEgMjc5LjQgNjI0LjEgNjI0LjF6Ii8+PC9zdmc+",u=H({email:t.value.email,email_confirmation:t.value.email,actualPassword:"",password:"",password_confirmation:""}),f=H({contact:i.value.contact,tel:i.value.tel1}),h=H({adresse:i.value.adresse1,cp:i.value.code_postal,ville:i.value.ville,pays:i.value.pays}),N=H({profil:i.value.img_profil}),g=H({social_twitter:i.value.social_twitter,social_insta:i.value.social_insta,social_facebook:i.value.social_facebook,social_linkedin:i.value.social_linkedin,social_website:i.value.social_website});var k=I(!1),M=I(!1),z=I(!1),V=I(!1),D=()=>{k.value=!0,M.value=!1,z.value=!1,V.value=!1},U=()=>{k.value=!1,M.value=!0,z.value=!1,V.value=!1},P=()=>{k.value=!1,M.value=!1,z.value=!0,V.value=!1},E=()=>{k.value=!1,M.value=!1,z.value=!1,V.value=!0},w=()=>{k.value=!1,M.value=!1,z.value=!1,V.value=!1},Y=()=>{u.post(route("settings/save/security"),{onSuccess:b=>{b.props.session.status?(t.value.email=u.email,w(),Toast.fire({icon:"success",title:"Mise \xE0 jour avec succ\xE8s !"})):b.props.session.message!=""?Toast.fire({icon:"error",title:b.props.session.message}):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})},onError:b=>{u.errors.length==0&&(b.props.session.message!=""?Toast.fire({icon:"error",title:b.props.session.message}):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"}))}})},B=()=>{f.post(route("settings/save/general"),{onSuccess:b=>{b.props.session.status?(i.value.contact=f.contact,i.value.tel1=f.tel,w(),Toast.fire({icon:"success",title:"Mise \xE0 jour avec succ\xE8s !"})):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})},onError:b=>{f.errors.length==0&&Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})}})},Z=()=>{h.post(route("settings/save/company"),{onSuccess:b=>{b.props.session.status?(i.value.adresse1=h.adresse,i.value.code_postal=h.cp,i.value.ville=h.ville,i.value.pays=h.pays,w(),Toast.fire({icon:"success",title:"Mise \xE0 jour avec succ\xE8s !"})):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})},onError:b=>{h.errors.length==0&&Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})}})},L=()=>{N.post(route("settings/save/profil"),{onSuccess:b=>{b.props.session.status?(t.value.img_profil=b.props.session.imgBase64,w(),Toast.fire({icon:"success",title:"Mise \xE0 jour avec succ\xE8s !"})):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})},onError:b=>{N.errors.length==0&&Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})}})},G=()=>{g.post(route("settings/save/sociaux"),{onSuccess:b=>{b.props.session.status?(console.log("test"),i.value.social_twitter=g.social_twitter,i.value.social_insta=g.social_insta,i.value.social_facebook=g.social_facebook,i.value.social_linkedin=g.social_linkedin,i.value.social_website=g.social_website,w(),Toast.fire({icon:"success",title:"Mise \xE0 jour avec succ\xE8s !"})):Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})},onError:b=>{g.errors.length==0&&Toast.fire({icon:"error",title:"Une erreur s'est produite lors de la modification des informations veuilliez ressayer plus tard !"})}})};return(b,o)=>(r(),n(ee,null,[a(e(se),{title:"Mon profil"}),s("section",es,[a(ie,{links:e(p)},null,8,["links"]),s("div",ss,[s("div",ts,[s("form",os,[s("img",{class:"h-32 w-32 rounded-full drop-shadow-xl",src:e(t).img_profil!=""?"data:image;base64,"+e(t).img_profil:C,alt:"Image profil"},null,8,ls),s("input",{type:"file",onChange:o[0]||(o[0]=(...l)=>e(L)&&e(L)(...l)),accept:".jpg, .jpeg, .png",id:"img_profil",class:"hidden",name:"img-profil",required:"",onInput:o[1]||(o[1]=l=>e(N).profil=l.target.files[0])},null,32),s("label",is,[a(A,{class:"absolute bottom-0.5"})]),a(x,{class:"mt-2",message:e(N).errors.profil},null,8,["message"])]),as,s("div",rs,[s("h2",ns,c(e(i).nom_societe),1),s("span",cs,"N\xB0 TVA : "+c(e(i).tva_intra),1),ds,s("div",us,[s("span",ms,c(e(i).contact)+",",1),s("span",ps,c(e(i).adresse1)+",",1),s("span",fs,c(e(i).code_postal)+", "+c(e(i).ville),1),s("span",_s,c(e(i).pays),1)])])]),s("div",gs,[bs,s("div",hs,[s("div",xs,[s("h2",ys,[a(fe),d(" S\xE9curiter")]),e(k)?_("",!0):(r(),n("button",{key:0,type:"button",onClick:o[2]||(o[2]=(...l)=>e(D)&&e(D)(...l)),class:"hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a(A,{class:"absolute bottom-0.5"}),d(),vs])),e(k)?(r(),n("button",{key:1,type:"button",onClick:o[3]||(o[3]=(...l)=>e(w)&&e(w)(...l)),class:"hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a($,{class:"absolute bottom-0.5"}),d(),ws])):_("",!0)]),e(k)?_("",!0):(r(),n("div",Cs,[s("span",ks,"E-mail : "+c(e(t).email),1),Ms])),e(k)?(r(),n("form",{key:1,onSubmit:o[9]||(o[9]=T((...l)=>e(Y)&&e(Y)(...l),["prevent"])),class:"grid grid-cols-4 mt-3"},[s("div",zs,[s("label",Vs,[a(Q),d(" Mail :")]),y(s("input",{type:"email",id:"email",class:"bg-transparent focus:ring-0 border-none lg:w-10/12 sm:w-9/12 w-full text-zinc-800",name:"email",required:"",autofocus:"",autocomplete:"email","onUpdate:modelValue":o[4]||(o[4]=l=>e(u).email=l)},null,512),[[v,e(u).email]]),a(x,{class:"mt-2",message:e(u).errors.email},null,8,["message"])]),s("div",js,[s("label",Ss,[a(Q),d(" Confirmation Mail :")]),y(s("input",{type:"email",id:"email_confirmation",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-zinc-800",name:"email_confirmation",required:"",autofocus:"",autocomplete:"email","onUpdate:modelValue":o[5]||(o[5]=l=>e(u).email_confirmation=l)},null,512),[[v,e(u).email_confirmation]]),a(x,{class:"mt-2",message:e(u).errors.email_confirmation},null,8,["message"])]),s("div",Ns,[s("label",Is,[a(Le),d(" Mot de passe actuelle : ")]),y(s("input",{type:"password",id:"actualPassword",class:"bg-transparent focus:ring-0 border-none sm:w-6/12 w-full text-zinc-800",name:"actualPassword",autofocus:"","onUpdate:modelValue":o[6]||(o[6]=l=>e(u).actualPassword=l)},null,512),[[v,e(u).actualPassword]]),a(x,{class:"mt-2",message:e(u).errors.actualPassword},null,8,["message"])]),s("div",As,[s("label",Hs,[a(J),d(" Nouveau mot de passe")]),y(s("input",{type:"password",id:"password",class:"bg-transparent focus:ring-0 border-none sm:w-6/12 w-full text-zinc-800",name:"password",autofocus:"","onUpdate:modelValue":o[7]||(o[7]=l=>e(u).password=l)},null,512),[[v,e(u).password]]),a(x,{class:"mt-2",message:e(u).errors.password},null,8,["message"])]),s("div",Ls,[s("label",Ts,[a(J),d(" Confirmation mot de passe :")]),y(s("input",{type:"password",id:"password_confirmation",class:"bg-transparent focus:ring-0 border-none lg:w-6/12 sm:w-4/12 w-full text-zinc-800",name:"password_confirmation",autofocus:"","onUpdate:modelValue":o[8]||(o[8]=l=>e(u).password_confirmation=l)},null,512),[[v,e(u).password_confirmation]]),a(x,{class:"mt-2",message:e(u).errors.password_confirmation},null,8,["message"])]),$s],32)):_("",!0)]),s("div",Ds,[s("div",Us,[s("h2",Ps,[a(te),d(" Informations g\xE9n\xE9rale")]),e(M)?_("",!0):(r(),n("button",{key:0,type:"button",onClick:o[10]||(o[10]=(...l)=>e(U)&&e(U)(...l)),class:"hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a(A,{class:"absolute bottom-0.5"}),d(),Es])),e(M)?(r(),n("button",{key:1,type:"button",onClick:o[11]||(o[11]=(...l)=>e(w)&&e(w)(...l)),class:"hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a($,{class:"absolute bottom-0.5"}),d(),Ys])):_("",!0)]),e(M)?_("",!0):(r(),n("div",Bs,[s("span",Zs,"Nom contact : "+c(e(i).contact),1),s("span",Gs,"T\xE9l\xE9phone : "+c(e(i).tel1),1)])),e(M)?(r(),n("form",{key:1,onSubmit:o[14]||(o[14]=T((...l)=>e(B)&&e(B)(...l),["prevent"])),class:"grid grid-cols-4 mt-3"},[s("div",qs,[s("label",Fs,[a(ve),d(" Nom contact :")]),y(s("input",{type:"text",id:"contact",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500",name:"text",required:"",autofocus:"",autocomplete:"name","onUpdate:modelValue":o[12]||(o[12]=l=>e(f).contact=l)},null,512),[[v,e(f).contact]]),a(x,{class:"mt-2",message:e(f).errors.contact},null,8,["message"])]),s("div",Qs,[s("label",Ws,[a(le),d(" T\xE9l\xE9phone :")]),y(s("input",{type:"text",id:"phone",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500",name:"phone",required:"",autofocus:"",autocomplete:"tel","onUpdate:modelValue":o[13]||(o[13]=l=>e(f).tel=l)},null,512),[[v,e(f).tel]]),a(x,{class:"mt-2",message:e(f).errors.tel},null,8,["message"])]),Os],32)):_("",!0)]),s("div",Rs,[s("div",Js,[s("h2",Xs,[a(oe),d(" Soci\xE9t\xE9")]),e(z)?_("",!0):(r(),n("button",{key:0,type:"button",onClick:o[15]||(o[15]=(...l)=>e(P)&&e(P)(...l)),class:"hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a(A,{class:"absolute bottom-0.5"}),d(),Ks])),e(z)?(r(),n("button",{key:1,type:"button",onClick:o[16]||(o[16]=(...l)=>e(w)&&e(w)(...l)),class:"hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a($,{class:"absolute bottom-0.5"}),d(),et])):_("",!0)]),e(z)?_("",!0):(r(),n("div",st,[s("span",tt,"Adresse : "+c(e(i).adresse1),1),s("span",ot,"Code Postal : "+c(e(i).code_postal),1),s("span",lt,"Ville : "+c(e(i).ville),1),s("span",it,"Pays : "+c(e(i).pays),1)])),e(z)?(r(),n("form",{key:1,onSubmit:o[21]||(o[21]=T((...l)=>e(Z)&&e(Z)(...l),["prevent"])),class:"grid grid-cols-4 mt-3"},[s("div",at,[rt,y(s("input",{type:"text",id:"adresse",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500",name:"text",required:"",autofocus:"",autocomplete:"street-address","onUpdate:modelValue":o[17]||(o[17]=l=>e(h).adresse=l)},null,512),[[v,e(h).adresse]]),a(x,{class:"mt-2",message:e(h).errors.adresse},null,8,["message"])]),s("div",nt,[ct,y(s("input",{type:"text",id:"cp",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500",name:"cp",required:"",autofocus:"",autocomplete:"postal-code","onUpdate:modelValue":o[18]||(o[18]=l=>e(h).cp=l)},null,512),[[v,e(h).cp]]),a(x,{class:"mt-2",message:e(h).errors.cp},null,8,["message"])]),s("div",dt,[ut,y(s("input",{type:"text",id:"ville",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500",name:"ville",required:"",autofocus:"",autocomplete:"city","onUpdate:modelValue":o[19]||(o[19]=l=>e(h).ville=l)},null,512),[[v,e(h).ville]]),a(x,{class:"mt-2",message:e(h).errors.ville},null,8,["message"])]),s("div",mt,[pt,y(s("input",{type:"text",id:"pays",class:"bg-transparent focus:ring-0 border-none sm:w-7/12 w-full text-primary-500",name:"pays",required:"",autofocus:"",autocomplete:"country-name","onUpdate:modelValue":o[20]||(o[20]=l=>e(h).pays=l)},null,512),[[v,e(h).pays]]),a(x,{class:"mt-2",message:e(h).errors.pays},null,8,["message"])]),ft],32)):_("",!0)]),s("div",_t,[s("div",gt,[s("h2",bt,[a(Ye),d(" R\xE9seaux sociaux")]),e(V)?_("",!0):(r(),n("button",{key:0,type:"button",onClick:o[22]||(o[22]=(...l)=>e(E)&&e(E)(...l)),class:"hover:text-white hover:bg-primary-100 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a(A,{class:"absolute bottom-0.5"}),d(),ht])),e(V)?(r(),n("button",{key:1,type:"button",onClick:o[23]||(o[23]=(...l)=>e(w)&&e(w)(...l)),class:"hover:text-white hover:bg-red-500 flex items-center justify-start px-2 py-2 rounded-full w-8 h-8 hover:w-28 transition-all transition duration-300 relative"},[a($,{class:"absolute bottom-0.5"}),d(),xt])):_("",!0)]),e(V)?_("",!0):(r(),n("div",yt,[s("span",vt,[a(K),d(" "+c(e(i).social_twitter==null?"(Votre pseudo ici)":e(i).social_twitter),1)]),s("span",wt,[a(W),d(" "+c(e(i).social_insta==null?"(Votre pseudo ici)":e(i).social_insta),1)]),s("span",Ct,[a(O),d(" "+c(e(i).social_facebook==null?"(Votre pseudo ici)":e(i).social_facebook),1)]),s("span",kt,[a(R),d(" "+c(e(i).social_linkedin==null?"(Votre pseudo ici)":e(i).social_linkedin),1)]),s("span",Mt,[a(X),d(" "+c(e(i).social_website==null?"(Votre url ici)":e(i).social_website),1)])])),e(V)?(r(),n("form",{key:1,onSubmit:o[29]||(o[29]=T((...l)=>e(G)&&e(G)(...l),["prevent"])),class:"grid grid-cols-4 mt-3"},[s("div",zt,[s("label",Vt,[a(K),d(" (pseudo)")]),y(s("input",{type:"text",id:"social_twitter",class:"bg-transparent focus:ring-0 border-none w-7/12 text-primary-500",name:"social_twitter",autofocus:"","onUpdate:modelValue":o[24]||(o[24]=l=>e(g).social_twitter=l)},null,512),[[v,e(g).social_twitter]]),a(x,{class:"mt-2",message:e(g).errors.social_twitter},null,8,["message"])]),s("div",jt,[s("label",St,[a(W),d(" (pseudo)")]),y(s("input",{type:"text",id:"social_insta",class:"bg-transparent focus:ring-0 border-none w-7/12 text-primary-500",name:"social_insta",autofocus:"","onUpdate:modelValue":o[25]||(o[25]=l=>e(g).social_insta=l)},null,512),[[v,e(g).social_insta]]),a(x,{class:"mt-2",message:e(g).errors.social_insta},null,8,["message"])]),s("div",Nt,[s("label",It,[a(O),d(" (pseudo)")]),y(s("input",{type:"text",id:"social_facebook",class:"bg-transparent focus:ring-0 border-none w-7/12 text-primary-500",name:"social_facebook",autofocus:"","onUpdate:modelValue":o[26]||(o[26]=l=>e(g).social_facebook=l)},null,512),[[v,e(g).social_facebook]]),a(x,{class:"mt-2",message:e(g).errors.social_facebook},null,8,["message"])]),s("div",At,[s("label",Ht,[a(R),d(" (pseudo)")]),y(s("input",{type:"text",id:"social_linkedin",class:"bg-transparent focus:ring-0 border-none w-7/12 text-primary-500",name:"social_linkedin",autofocus:"","onUpdate:modelValue":o[27]||(o[27]=l=>e(g).social_linkedin=l)},null,512),[[v,e(g).social_linkedin]]),a(x,{class:"mt-2",message:e(g).errors.social_linkedin},null,8,["message"])]),s("div",Lt,[s("label",Tt,[a(X),d(" (Link)")]),y(s("input",{type:"text",id:"social_website",class:"bg-transparent focus:ring-0 border-none w-7/12 text-primary-500",name:"social_website",autofocus:"","onUpdate:modelValue":o[28]||(o[28]=l=>e(g).social_website=l)},null,512),[[v,e(g).social_website]]),a(x,{class:"mt-2",message:e(g).errors.social_website},null,8,["message"])]),$t],32)):_("",!0)])]),s("div",Dt,[s("form",Ut,[s("img",{class:"h-32 w-32 rounded-full drop-shadow-xl",src:e(t).img_profil!=""?"data:image;base64,"+e(t).img_profil:C,alt:"Image profil"},null,8,Pt),s("input",{type:"file",onChange:o[30]||(o[30]=(...l)=>e(L)&&e(L)(...l)),accept:".jpg, .jpeg, .png",id:"img_profil",class:"hidden",name:"img-profil",required:"",onInput:o[31]||(o[31]=l=>e(N).profil=l.target.files[0])},null,32),s("label",Et,[a(A,{class:"absolute bottom-0.5"})]),a(x,{class:"mt-2",message:e(N).errors.profil},null,8,["message"])]),Yt,s("div",Bt,[s("h2",Zt,c(e(i).nom_societe),1),s("span",Gt,"N\xB0 TVA : "+c(e(i).tva_intra),1),qt,s("div",Ft,[s("span",null,c(e(i).contact),1),s("span",null,c(e(i).adresse1)+",",1),s("span",null,c(e(i).code_postal)+", "+c(e(i).ville),1),s("span",null,c(e(i).pays),1)])])])])])],64))}});export{lo as default};
