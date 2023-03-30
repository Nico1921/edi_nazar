import{u as B,x as G,a as I,y as Q,c as W,l as M,f as X,V as Y,b as Z,P as $,w as K,t as F,d as ee,o as P,R as L,p as oe,e as te,O as le,g as h}from"./AuthenticatedLayout.1bee4913.js";import{d as ae,e as ne}from"./use-controllable.5de0fcb1.js";import{G as E,s as D,c as S,P as v,B as ue,z as _,F as ie,C as q,Q as J,D as U,I as re,E as A,A as se}from"./app.1ea95840.js";function pe(t,m){return t===m}var de=(t=>(t[t.Open=0]="Open",t[t.Closed=1]="Closed",t))(de||{}),ve=(t=>(t[t.Single=0]="Single",t[t.Multi=1]="Multi",t))(ve||{}),be=(t=>(t[t.Pointer=0]="Pointer",t[t.Other=1]="Other",t))(be||{});let z=Symbol("ComboboxContext");function j(t){let m=se(z,null);if(m===null){let g=new Error(`<${t} /> is missing a parent <Combobox /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(g,j),g}return m}let xe=E({name:"Combobox",emits:{"update:modelValue":t=>!0},props:{as:{type:[Object,String],default:"template"},disabled:{type:[Boolean],default:!1},by:{type:[String,Function],default:()=>pe},modelValue:{type:[Object,String,Number,Boolean],default:void 0},defaultValue:{type:[Object,String,Number,Boolean],default:void 0},name:{type:String},nullable:{type:Boolean,default:!1},multiple:{type:[Boolean],default:!1}},inheritAttrs:!1,setup(t,{slots:m,attrs:g,emit:C}){let e=D(1),o=D(null),b=D(null),R=D(null),x=D(null),p=D({static:!1,hold:!1}),a=D([]),c=D(null),T=D(1),l=D(!1);function i(n=s=>s){let s=c.value!==null?a.value[c.value]:null,r=le(n(a.value.slice()),f=>P(f.dataRef.domRef)),u=s?r.indexOf(s):null;return u===-1&&(u=null),{options:r,activeOptionIndex:u}}let O=S(()=>t.multiple?1:0),w=S(()=>t.nullable),[k,V]=ae(S(()=>t.modelValue),n=>C("update:modelValue",n),S(()=>t.defaultValue)),d={comboboxState:e,value:k,mode:O,compare(n,s){if(typeof t.by=="string"){let r=t.by;return(n==null?void 0:n[r])===(s==null?void 0:s[r])}return t.by(n,s)},nullable:w,inputRef:b,labelRef:o,buttonRef:R,optionsRef:x,disabled:S(()=>t.disabled),options:a,change(n){V(n)},activeOptionIndex:S(()=>{if(l.value&&c.value===null&&a.value.length>0){let n=a.value.findIndex(s=>!s.dataRef.disabled);if(n!==-1)return n}return c.value}),activationTrigger:T,optionsPropsRef:p,closeCombobox(){l.value=!1,!t.disabled&&e.value!==1&&(e.value=1,c.value=null)},openCombobox(){if(l.value=!0,t.disabled||e.value===0)return;let n=a.value.findIndex(s=>{let r=v(s.dataRef.value);return B(O.value,{[0]:()=>d.compare(v(d.value.value),v(r)),[1]:()=>v(d.value.value).some(u=>d.compare(v(u),v(r)))})});n!==-1&&(c.value=n),e.value=0},goToOption(n,s,r){if(l.value=!1,t.disabled||x.value&&!p.value.static&&e.value===1)return;let u=i();if(u.activeOptionIndex===null){let y=u.options.findIndex(H=>!H.dataRef.disabled);y!==-1&&(u.activeOptionIndex=y)}let f=G(n===I.Specific?{focus:I.Specific,id:s}:{focus:n},{resolveItems:()=>u.options,resolveActiveIndex:()=>u.activeOptionIndex,resolveId:y=>y.id,resolveDisabled:y=>y.dataRef.disabled});c.value=f,T.value=r!=null?r:1,a.value=u.options},selectOption(n){let s=a.value.find(u=>u.id===n);if(!s)return;let{dataRef:r}=s;V(B(O.value,{[0]:()=>r.value,[1]:()=>{let u=v(d.value.value).slice(),f=v(r.value),y=u.findIndex(H=>d.compare(f,v(H)));return y===-1?u.push(f):u.splice(y,1),u}}))},selectActiveOption(){if(d.activeOptionIndex.value===null)return;let{dataRef:n,id:s}=a.value[d.activeOptionIndex.value];V(B(O.value,{[0]:()=>n.value,[1]:()=>{let r=v(d.value.value).slice(),u=v(n.value),f=r.findIndex(y=>d.compare(u,v(y)));return f===-1?r.push(u):r.splice(f,1),r}})),d.goToOption(I.Specific,s)},registerOption(n,s){let r={id:n,dataRef:s},u=i(f=>[...f,r]);if(c.value===null){let f=s.value.value;B(O.value,{[0]:()=>d.compare(v(d.value.value),v(f)),[1]:()=>v(d.value.value).some(y=>d.compare(v(y),v(f)))})&&(u.activeOptionIndex=u.options.indexOf(r))}a.value=u.options,c.value=u.activeOptionIndex,T.value=1},unregisterOption(n){let s=i(r=>{let u=r.findIndex(f=>f.id===n);return u!==-1&&r.splice(u,1),r});a.value=s.options,c.value=s.activeOptionIndex,T.value=1}};Q([b,R,x],()=>d.closeCombobox(),S(()=>e.value===0)),ue(z,d),W(S(()=>B(e.value,{[0]:M.Open,[1]:M.Closed})));let N=S(()=>d.activeOptionIndex.value===null?null:a.value[d.activeOptionIndex.value].dataRef.value);return()=>{let{name:n,disabled:s,...r}=t,u={open:e.value===0,disabled:s,activeIndex:d.activeOptionIndex.value,activeOption:N.value,value:k.value};return _(ie,[...n!=null&&k.value!=null?ne({[n]:k.value}).map(([f,y])=>_(X,Y({features:Z.Hidden,key:f,as:"input",type:"hidden",hidden:!0,readOnly:!0,name:f,value:y}))):[],$({theirProps:{...g,...K(r,["modelValue","defaultValue","nullable","multiple","onUpdate:modelValue","by"])},ourProps:{},slot:u,slots:m,attrs:g,name:"Combobox"})])}}});E({name:"ComboboxLabel",props:{as:{type:[Object,String],default:"label"}},setup(t,{attrs:m,slots:g}){let C=j("ComboboxLabel"),e=`headlessui-combobox-label-${F()}`;function o(){var b;(b=P(C.inputRef))==null||b.focus({preventScroll:!0})}return()=>{let b={open:C.comboboxState.value===0,disabled:C.disabled.value},R={id:e,ref:C.labelRef,onClick:o};return $({ourProps:R,theirProps:t,slot:b,attrs:m,slots:g,name:"ComboboxLabel"})}}});let Oe=E({name:"ComboboxButton",props:{as:{type:[Object,String],default:"button"}},setup(t,{attrs:m,slots:g,expose:C}){let e=j("ComboboxButton"),o=`headlessui-combobox-button-${F()}`;C({el:e.buttonRef,$el:e.buttonRef});function b(p){e.disabled.value||(e.comboboxState.value===0?e.closeCombobox():(p.preventDefault(),e.openCombobox()),A(()=>{var a;return(a=P(e.inputRef))==null?void 0:a.focus({preventScroll:!0})}))}function R(p){switch(p.key){case h.ArrowDown:p.preventDefault(),p.stopPropagation(),e.comboboxState.value===1&&e.openCombobox(),A(()=>{var a;return(a=e.inputRef.value)==null?void 0:a.focus({preventScroll:!0})});return;case h.ArrowUp:p.preventDefault(),p.stopPropagation(),e.comboboxState.value===1&&(e.openCombobox(),A(()=>{e.value.value||e.goToOption(I.Last)})),A(()=>{var a;return(a=e.inputRef.value)==null?void 0:a.focus({preventScroll:!0})});return;case h.Escape:if(e.comboboxState.value!==0)return;p.preventDefault(),e.optionsRef.value&&!e.optionsPropsRef.value.static&&p.stopPropagation(),e.closeCombobox(),A(()=>{var a;return(a=e.inputRef.value)==null?void 0:a.focus({preventScroll:!0})});return}}let x=ee(S(()=>({as:t.as,type:m.type})),e.buttonRef);return()=>{var p,a;let c={open:e.comboboxState.value===0,disabled:e.disabled.value,value:e.value.value},T={ref:e.buttonRef,id:o,type:x.value,tabindex:"-1","aria-haspopup":!0,"aria-controls":(p=P(e.optionsRef))==null?void 0:p.id,"aria-expanded":e.disabled.value?void 0:e.comboboxState.value===0,"aria-labelledby":e.labelRef.value?[(a=P(e.labelRef))==null?void 0:a.id,o].join(" "):void 0,disabled:e.disabled.value===!0?!0:void 0,onKeydown:R,onClick:b};return $({ourProps:T,theirProps:t,slot:c,attrs:m,slots:g,name:"ComboboxButton"})}}}),ge=E({name:"ComboboxInput",props:{as:{type:[Object,String],default:"input"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},displayValue:{type:Function}},emits:{change:t=>!0},setup(t,{emit:m,attrs:g,slots:C,expose:e}){let o=j("ComboboxInput"),b=`headlessui-combobox-input-${F()}`;e({el:o.inputRef,$el:o.inputRef});let R=D(o.value.value),x=()=>{var l;let i=o.value.value;return P(o.inputRef)?typeof t.displayValue<"u"?(l=t.displayValue(i))!=null?l:"":typeof i=="string"?i:"":""};const p=D("");q(()=>{J([o.value,p],()=>{R.value=x()},{flush:"sync",immediate:!0}),J([R,o.comboboxState],([l,i],[O,w])=>{let k=P(o.inputRef);!k||(w===0&&i===1||l!==O)&&(k.value=l)},{immediate:!0})});function a(l){switch(l.key){case h.Backspace:case h.Delete:if(o.mode.value!==0||!o.nullable.value)return;let i=l.currentTarget;requestAnimationFrame(()=>{if(i.value===""){o.change(null);let O=P(o.optionsRef);O&&(O.scrollTop=0),o.goToOption(I.Nothing)}});break;case h.Enter:if(o.comboboxState.value!==0||l.isComposing)return;if(l.preventDefault(),l.stopPropagation(),o.activeOptionIndex.value===null){o.closeCombobox();return}o.selectActiveOption(),o.mode.value===0&&o.closeCombobox();break;case h.ArrowDown:return l.preventDefault(),l.stopPropagation(),B(o.comboboxState.value,{[0]:()=>o.goToOption(I.Next),[1]:()=>o.openCombobox()});case h.ArrowUp:return l.preventDefault(),l.stopPropagation(),B(o.comboboxState.value,{[0]:()=>o.goToOption(I.Previous),[1]:()=>{o.openCombobox(),A(()=>{o.value.value||o.goToOption(I.Last)})}});case h.Home:case h.PageUp:return l.preventDefault(),l.stopPropagation(),o.goToOption(I.First);case h.End:case h.PageDown:return l.preventDefault(),l.stopPropagation(),o.goToOption(I.Last);case h.Escape:if(o.comboboxState.value!==0)return;l.preventDefault(),o.optionsRef.value&&!o.optionsPropsRef.value.static&&l.stopPropagation(),o.closeCombobox();break;case h.Tab:if(o.comboboxState.value!==0)return;o.mode.value===0&&o.selectActiveOption(),o.closeCombobox();break}}function c(l){m("change",l)}function T(l){o.openCombobox(),m("change",l)}return()=>{var l,i,O,w,k,V;let d={open:o.comboboxState.value===0},N={"aria-controls":(l=o.optionsRef.value)==null?void 0:l.id,"aria-expanded":o.disabled.value?void 0:o.comboboxState.value===0,"aria-activedescendant":o.activeOptionIndex.value===null||(i=o.options.value[o.activeOptionIndex.value])==null?void 0:i.id,"aria-multiselectable":o.mode.value===1?!0:void 0,"aria-labelledby":(k=(O=P(o.labelRef))==null?void 0:O.id)!=null?k:(w=P(o.buttonRef))==null?void 0:w.id,id:b,onKeydown:a,onChange:c,onInput:T,role:"combobox",type:(V=g.type)!=null?V:"text",tabIndex:0,ref:o.inputRef},n=K(t,["displayValue"]);return $({ourProps:N,theirProps:n,slot:d,attrs:g,slots:C,features:L.RenderStrategy|L.Static,name:"ComboboxInput"})}}}),Re=E({name:"ComboboxOptions",props:{as:{type:[Object,String],default:"ul"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},hold:{type:[Boolean],default:!1}},setup(t,{attrs:m,slots:g,expose:C}){let e=j("ComboboxOptions"),o=`headlessui-combobox-options-${F()}`;C({el:e.optionsRef,$el:e.optionsRef}),U(()=>{e.optionsPropsRef.value.static=t.static}),U(()=>{e.optionsPropsRef.value.hold=t.hold});let b=oe(),R=S(()=>b!==null?b.value===M.Open:e.comboboxState.value===0);return te({container:S(()=>P(e.optionsRef)),enabled:S(()=>e.comboboxState.value===0),accept(x){return x.getAttribute("role")==="option"?NodeFilter.FILTER_REJECT:x.hasAttribute("role")?NodeFilter.FILTER_SKIP:NodeFilter.FILTER_ACCEPT},walk(x){x.setAttribute("role","none")}}),()=>{var x,p,a,c;let T={open:e.comboboxState.value===0},l={"aria-activedescendant":e.activeOptionIndex.value===null||(x=e.options.value[e.activeOptionIndex.value])==null?void 0:x.id,"aria-labelledby":(c=(p=P(e.labelRef))==null?void 0:p.id)!=null?c:(a=P(e.buttonRef))==null?void 0:a.id,id:o,ref:e.optionsRef,role:"listbox"},i=K(t,["hold"]);return $({ourProps:l,theirProps:i,slot:T,attrs:m,slots:g,features:L.RenderStrategy|L.Static,visible:R.value,name:"ComboboxOptions"})}}}),Se=E({name:"ComboboxOption",props:{as:{type:[Object,String],default:"li"},value:{type:[Object,String,Number,Boolean]},disabled:{type:Boolean,default:!1}},setup(t,{slots:m,attrs:g,expose:C}){let e=j("ComboboxOption"),o=`headlessui-combobox-option-${F()}`,b=D(null);C({el:b,$el:b});let R=S(()=>e.activeOptionIndex.value!==null?e.options.value[e.activeOptionIndex.value].id===o:!1),x=S(()=>B(e.mode.value,{[0]:()=>e.compare(v(e.value.value),v(t.value)),[1]:()=>v(e.value.value).some(i=>e.compare(v(i),v(t.value)))})),p=S(()=>({disabled:t.disabled,value:t.value,domRef:b}));q(()=>e.registerOption(o,p)),re(()=>e.unregisterOption(o)),U(()=>{e.comboboxState.value===0&&(!R.value||e.activationTrigger.value!==0&&A(()=>{var i,O;return(O=(i=P(b))==null?void 0:i.scrollIntoView)==null?void 0:O.call(i,{block:"nearest"})}))});function a(i){if(t.disabled)return i.preventDefault();e.selectOption(o),e.mode.value===0&&e.closeCombobox()}function c(){if(t.disabled)return e.goToOption(I.Nothing);e.goToOption(I.Specific,o)}function T(){t.disabled||R.value||e.goToOption(I.Specific,o,0)}function l(){t.disabled||!R.value||e.optionsPropsRef.value.hold||e.goToOption(I.Nothing)}return()=>{let{disabled:i}=t,O={active:R.value,selected:x.value,disabled:i},w={id:o,ref:b,role:"option",tabIndex:i===!0?void 0:-1,"aria-disabled":i===!0?!0:void 0,"aria-selected":x.value,disabled:void 0,onClick:a,onFocus:c,onPointermove:T,onMousemove:T,onPointerleave:l,onMouseleave:l};return $({ourProps:w,theirProps:t,slot:O,attrs:g,slots:m,name:"ComboboxOption"})}}});export{xe as A,ge as B,Se as H,Oe as L,Re as j};
