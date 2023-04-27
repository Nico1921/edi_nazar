import{_ as f}from"./_plugin-vue_export-helper.cdc0426e.js";import{o as n,a as o,f as e,t as i,k as h,m as _,d as a,e as u,h as m,u as l,L as g,l as p,r as b}from"./app.3d88e537.js";import{i as x,f as C,l as w}from"./Linkedin.01285091.js";const k={name:"PinterestIcon",emits:["click"],props:{title:{type:String},fillColor:{type:String,default:"currentColor"},size:{type:Number,default:24}}},y=["aria-hidden","aria-label"],v=["fill","width","height"],T={d:"M9.04,21.54C10,21.83 10.97,22 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2A10,10 0 0,0 2,12C2,16.25 4.67,19.9 8.44,21.34C8.35,20.56 8.26,19.27 8.44,18.38L9.59,13.44C9.59,13.44 9.3,12.86 9.3,11.94C9.3,10.56 10.16,9.53 11.14,9.53C12,9.53 12.4,10.16 12.4,10.97C12.4,11.83 11.83,13.06 11.54,14.24C11.37,15.22 12.06,16.08 13.06,16.08C14.84,16.08 16.22,14.18 16.22,11.5C16.22,9.1 14.5,7.46 12.03,7.46C9.21,7.46 7.55,9.56 7.55,11.77C7.55,12.63 7.83,13.5 8.29,14.07C8.38,14.13 8.38,14.21 8.35,14.36L8.06,15.45C8.06,15.62 7.95,15.68 7.78,15.56C6.5,15 5.76,13.18 5.76,11.71C5.76,8.55 8,5.68 12.32,5.68C15.76,5.68 18.44,8.15 18.44,11.43C18.44,14.87 16.31,17.63 13.26,17.63C12.29,17.63 11.34,17.11 11,16.5L10.33,18.87C10.1,19.73 9.47,20.88 9.04,21.57V21.54Z"},z={key:0};function B(s,r,t,c,Z,q){return n(),o("span",_(s.$attrs,{"aria-hidden":!t.title,"aria-label":t.title,class:"material-design-icon pinterest-icon",role:"img",onClick:r[0]||(r[0]=d=>s.$emit("click",d))}),[(n(),o("svg",{fill:t.fillColor,class:"material-design-icon__svg",width:t.size,height:t.size,viewBox:"0 0 24 24"},[e("path",T,[t.title?(n(),o("title",z,i(t.title),1)):h("",!0)])],8,v))],16,y)}const L=f(k,[["render",B]]);const S={class:"min-h-screen flex items-stretch text-white"},N=e("div",{class:"absolute bg-black opacity-40 inset-0 z-0"},null,-1),$={class:"grid grid-rows-1 px-24 z-10"},V={class:"text-5xl font-bold text-left tracking-wide"},A={class:"text-3xl my-4"},I={class:"flex items-center my-4"},P=e("hr",{class:"w-full"},null,-1),j={class:"px-2 text-xl"},D=e("hr",{class:"w-full"},null,-1),E={class:"bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4 text-[28px]"},F={href:"https://www.pinterest.fr/nazarrugsfrance/",rel:"noopener",target:"_blank","aria-label":"Pinterest"},G={href:"https://www.instagram.com/nazar_rugs/",rel:"noopener",target:"_blank","aria-label":"Instagram"},M={href:"https://www.facebook.com/Nazarrugs-102036118298025",rel:"noopener",target:"_blank","aria-label":"Facebook"},O={href:"https://fr.linkedin.com/company/nazar-rugs",rel:"noopener",target:"_blank","aria-label":"Linkedin"},R={class:"lg:w-1/2 w-full flex sm:items-center items-start justify-center text-center md:px-16 px-0 z-0 bg-primary-50 relative"},U={class:"w-full z-20"},Q={__name:"GuestLayout",props:["TextTitre","SousTitre","TextBouttonTitre","hrefBtnTitre"],setup(s){const r=new URL("/build/assets/fond2.5b70c94d.webp",self.location).href;return(t,c)=>(n(),o("section",S,[e("div",{class:"lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center",style:p({"background-image":"url("+l(r)+")"})},[N,e("div",$,[e("h1",V,i(s.TextTitre),1),e("p",A,i(s.SousTitre),1),e("div",I,[P,e("span",j,i(t.$t("Or")),1),D]),a(l(g),{href:t.route(s.hrefBtnTitre),class:"block w-full text-center px-5 py-2 text-lg rounded-full transition ease-in-out duration-700 bg-primary-300 hover:bg-primary-400 focus:outline-none"},{default:u(()=>[m(i(s.TextBouttonTitre),1)]),_:1},8,["href"])]),e("div",E,[e("a",F,[a(L)]),e("a",G,[a(x)]),e("a",M,[a(C)]),e("a",O,[a(w)])])],4),e("div",R,[e("div",U,[b(t.$slots,"default")])])]))}};export{Q as _,L as p};