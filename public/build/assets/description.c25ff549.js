import{t as v,P as g}from"./AuthenticatedLayout.841911c1.js";import{A as l,z as b,c as h,E as j,B as P,G as D,u as O,y as x}from"./app.6b626bfd.js";let u=Symbol("DescriptionContext");function y(){let t=x(u,null);if(t===null)throw new Error("Missing parent");return t}function C({slot:t=l({}),name:o="Description",props:i={}}={}){let e=l([]);function n(r){return e.value.push(r),()=>{let s=e.value.indexOf(r);s!==-1&&e.value.splice(s,1)}}return b(u,{register:n,slot:t,name:o,props:i}),h(()=>e.value.length>0?e.value.join(" "):void 0)}let E=j({name:"Description",props:{as:{type:[Object,String],default:"p"}},setup(t,{attrs:o,slots:i}){let e=y(),n=`headlessui-description-${v()}`;return P(()=>D(e.register(n))),()=>{let{name:r="Description",slot:s=l({}),props:a={}}=e,p=t,c={...Object.entries(a).reduce((d,[m,f])=>Object.assign(d,{[m]:O(f)}),{}),id:n};return g({ourProps:c,theirProps:p,slot:s.value,attrs:o,slots:i,name:r})}}});export{C as P,E as S};
