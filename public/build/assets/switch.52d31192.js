import{P as m,t as D,d as K,f as j,V as G,b as O,w as R,g as d}from"./AuthenticatedLayout.2f8a5a90.js";import{K as A,P as q}from"./label.442218bf.js";import{P as B,S as M}from"./description.b65356c9.js";import{d as E,p as F}from"./use-controllable.be55a3b2.js";import{E as f,A as h,c as i,x as c,F as z,z as H,y as I}from"./app.5a12a6b8.js";let v=Symbol("GroupContext");f({name:"SwitchGroup",props:{as:{type:[Object,String],default:"template"}},setup(l,{slots:n,attrs:o}){let a=h(null),s=A({name:"SwitchLabel",props:{onClick(){!a.value||(a.value.click(),a.value.focus({preventScroll:!0}))}}}),t=B({name:"SwitchDescription"});return H(v,{switchRef:a,labelledby:s,describedby:t}),()=>m({theirProps:l,ourProps:{},slot:{},slots:n,attrs:o,name:"SwitchGroup"})}});let U=f({name:"Switch",emits:{"update:modelValue":l=>!0},props:{as:{type:[Object,String],default:"button"},modelValue:{type:Boolean,default:void 0},defaultChecked:{type:Boolean,default:!1},name:{type:String,optional:!0},value:{type:String,optional:!0}},inheritAttrs:!1,setup(l,{emit:n,attrs:o,slots:a,expose:s}){let t=I(v,null),y=`headlessui-switch-${D()}`,[r,b]=E(i(()=>l.modelValue),e=>n("update:modelValue",e),i(()=>l.defaultChecked));function p(){b(!r.value)}let S=h(null),u=t===null?S:t.switchRef,k=K(i(()=>({as:l.as,type:o.type})),u);s({el:u,$el:u});function w(e){e.preventDefault(),p()}function P(e){e.key===d.Space?(e.preventDefault(),p()):e.key===d.Enter&&F(e.currentTarget)}function $(e){e.preventDefault()}return()=>{let{name:e,value:g,...C}=l,x={checked:r.value},V={id:y,ref:u,role:"switch",type:k.value,tabIndex:0,"aria-checked":r.value,"aria-labelledby":t==null?void 0:t.labelledby.value,"aria-describedby":t==null?void 0:t.describedby.value,onClick:w,onKeyup:P,onKeypress:$};return c(z,[e!=null&&r.value!=null?c(j,G({features:O.Hidden,as:"input",type:"checkbox",hidden:!0,readOnly:!0,checked:r.value,name:e,value:g})):null,m({ourProps:V,theirProps:{...o,...R(C,["modelValue","defaultChecked"])},slot:x,attrs:o,slots:a,name:"Switch"})])}}});export{U as l};
