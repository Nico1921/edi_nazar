import{t as v,P as g}from"./LangueChoice.18bdd351.js";import{D as b,A as h,G as j,z as l,u as D,x as P,y as x,c as O}from"./app.42972bee.js";let u=Symbol("DescriptionContext");function y(){let t=P(u,null);if(t===null)throw new Error("Missing parent");return t}function C({slot:t=l({}),name:o="Description",props:i={}}={}){let e=l([]);function n(r){return e.value.push(r),()=>{let s=e.value.indexOf(r);s!==-1&&e.value.splice(s,1)}}return x(u,{register:n,slot:t,name:o,props:i}),O(()=>e.value.length>0?e.value.join(" "):void 0)}let M=b({name:"Description",props:{as:{type:[Object,String],default:"p"}},setup(t,{attrs:o,slots:i}){let e=y(),n=`headlessui-description-${v()}`;return h(()=>j(e.register(n))),()=>{let{name:r="Description",slot:s=l({}),props:a={}}=e,p=t,c={...Object.entries(a).reduce((d,[m,f])=>Object.assign(d,{[m]:D(f)}),{}),id:n};return g({ourProps:c,theirProps:p,slot:s.value,attrs:o,slots:i,name:r})}}});export{C as P,M as S};
