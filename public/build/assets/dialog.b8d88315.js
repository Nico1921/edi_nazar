import{m as B,n as we,f as Y,b as _,P,o as j,E as ue,j as C,u as W,k as le,q as Q,M as q,N as Pe,p as De,l as ae,t as x,y as Se,R as oe,g as Fe}from"./AuthenticatedLayout.1bee4913.js";import{t as Ee}from"./micro-task.fe338338.js";import{G as D,s as f,c,z as y,F as $e,C as T,Q as X,I,D as z,B as V,A as L,R as Re,S as Te,E as Ae}from"./app.1ea95840.js";import{P as Oe}from"./description.e99779c3.js";import{s as ke}from"./transition.f8320561.js";var se=(e=>(e[e.None=1]="None",e[e.InitialFocus=2]="InitialFocus",e[e.TabLock=4]="TabLock",e[e.FocusLock=8]="FocusLock",e[e.RestoreFocus=16]="RestoreFocus",e[e.All=30]="All",e))(se||{});let k=Object.assign(D({name:"FocusTrap",props:{as:{type:[Object,String],default:"div"},initialFocus:{type:Object,default:null},features:{type:Number,default:30},containers:{type:Object,default:f(new Set)}},inheritAttrs:!1,setup(e,{attrs:l,slots:a,expose:o}){let n=f(null);o({el:n,$el:n});let t=c(()=>B(n));Ce({ownerDocument:t},c(()=>Boolean(e.features&16)));let r=je({ownerDocument:t,container:n,initialFocus:c(()=>e.initialFocus)},c(()=>Boolean(e.features&2)));Be({ownerDocument:t,container:n,containers:e.containers,previousActiveElement:r},c(()=>Boolean(e.features&8)));let i=we();function s(){let u=j(n);!u||W(i.value,{[le.Forwards]:()=>Q(u,q.First),[le.Backwards]:()=>Q(u,q.Last)})}return()=>{let u={},m={ref:n},{features:p,initialFocus:S,containers:N,...h}=e;return y($e,[Boolean(p&4)&&y(Y,{as:"button",type:"button",onFocus:s,features:_.Focusable}),P({ourProps:m,theirProps:{...l,...h},slot:u,attrs:l,slots:a,name:"FocusTrap"}),Boolean(p&4)&&y(Y,{as:"button",type:"button",onFocus:s,features:_.Focusable})])}}}),{features:se});function Ce({ownerDocument:e},l){let a=f(null);function o(){var t;a.value||(a.value=(t=e.value)==null?void 0:t.activeElement)}function n(){!a.value||(C(a.value),a.value=null)}T(()=>{X(l,(t,r)=>{t!==r&&(t?o():n())},{immediate:!0})}),I(n)}function je({ownerDocument:e,container:l,initialFocus:a},o){let n=f(null),t=f(!1);return T(()=>t.value=!0),I(()=>t.value=!1),T(()=>{X([l,a,o],(r,i)=>{if(r.every((u,m)=>(i==null?void 0:i[m])===u)||!o.value)return;let s=j(l);!s||Ee(()=>{var u,m;if(!t.value)return;let p=j(a),S=(u=e.value)==null?void 0:u.activeElement;if(p){if(p===S){n.value=S;return}}else if(s.contains(S)){n.value=S;return}p?C(p):Q(s,q.First|q.NoScroll)===Pe.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),n.value=(m=e.value)==null?void 0:m.activeElement})},{immediate:!0,flush:"post"})}),n}function Be({ownerDocument:e,container:l,containers:a,previousActiveElement:o},n){var t;ue((t=e.value)==null?void 0:t.defaultView,"focus",r=>{if(!n.value)return;let i=new Set(a==null?void 0:a.value);i.add(l);let s=o.value;if(!s)return;let u=r.target;u&&u instanceof HTMLElement?xe(i,u)?(o.value=u,C(u)):(r.preventDefault(),r.stopPropagation(),C(s)):C(o.value)},!0)}function xe(e,l){var a;for(let o of e)if((a=o.value)!=null&&a.contains(l))return!0;return!1}let ne="body > *",A=new Set,$=new Map;function re(e){e.setAttribute("aria-hidden","true"),e.inert=!0}function ie(e){let l=$.get(e);!l||(l["aria-hidden"]===null?e.removeAttribute("aria-hidden"):e.setAttribute("aria-hidden",l["aria-hidden"]),e.inert=l.inert)}function Ie(e,l=f(!0)){z(a=>{if(!l.value||!e.value)return;let o=e.value,n=B(o);if(n){A.add(o);for(let t of $.keys())t.contains(o)&&(ie(t),$.delete(t));n.querySelectorAll(ne).forEach(t=>{if(t instanceof HTMLElement){for(let r of A)if(t.contains(r))return;A.size===1&&($.set(t,{"aria-hidden":t.getAttribute("aria-hidden"),inert:t.inert}),re(t))}}),a(()=>{if(A.delete(o),A.size>0)n.querySelectorAll(ne).forEach(t=>{if(t instanceof HTMLElement&&!$.has(t)){for(let r of A)if(t.contains(r))return;$.set(t,{"aria-hidden":t.getAttribute("aria-hidden"),inert:t.inert}),re(t)}});else for(let t of $.keys())ie(t),$.delete(t)})}})}let de=Symbol("ForcePortalRootContext");function Le(){return L(de,!1)}let J=D({name:"ForcePortalRoot",props:{as:{type:[Object,String],default:"template"},force:{type:Boolean,default:!1}},setup(e,{slots:l,attrs:a}){return V(de,e.force),()=>{let{force:o,...n}=e;return P({theirProps:n,ourProps:{},slot:{},slots:l,attrs:a,name:"ForcePortalRoot"})}}});function Me(e){let l=B(e);if(!l){if(e===null)return null;throw new Error(`[Headless UI]: Cannot find ownerDocument for contextElement: ${e}`)}let a=l.getElementById("headlessui-portal-root");if(a)return a;let o=l.createElement("div");return o.setAttribute("id","headlessui-portal-root"),l.body.appendChild(o)}let pe=D({name:"Portal",props:{as:{type:[Object,String],default:"div"}},setup(e,{slots:l,attrs:a}){let o=f(null),n=c(()=>B(o)),t=Le(),r=L(ce,null),i=f(t===!0||r==null?Me(o.value):r.resolveTarget());return z(()=>{t||r!=null&&(i.value=r.resolveTarget())}),I(()=>{var s,u;let m=(s=n.value)==null?void 0:s.getElementById("headlessui-portal-root");!m||i.value===m&&i.value.children.length<=0&&((u=i.value.parentElement)==null||u.removeChild(i.value))}),()=>{if(i.value===null)return null;let s={ref:o,"data-headlessui-portal":""};return y(Re,{to:i.value},P({ourProps:s,theirProps:e,slot:{},attrs:a,slots:l,name:"Portal"}))}}}),ce=Symbol("PortalGroupContext"),Ne=D({name:"PortalGroup",props:{as:{type:[Object,String],default:"template"},target:{type:Object,default:null}},setup(e,{attrs:l,slots:a}){let o=Te({resolveTarget(){return e.target}});return V(ce,o),()=>{let{target:n,...t}=e;return P({theirProps:t,ourProps:{},slot:{},attrs:l,slots:a,name:"PortalGroup"})}}}),fe=Symbol("StackContext");var Z=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(Z||{});function He(){return L(fe,()=>{})}function Ue({type:e,enabled:l,element:a,onUpdate:o}){let n=He();function t(...r){o==null||o(...r),n(...r)}T(()=>{X(l,(r,i)=>{r?t(0,e,a):i===!0&&t(1,e,a)},{immediate:!0,flush:"sync"})}),I(()=>{l.value&&t(1,e,a)}),V(fe,t)}function Ge(){return/iPhone/gi.test(window.navigator.platform)||/Mac/gi.test(window.navigator.platform)&&window.navigator.maxTouchPoints>0}var We=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(We||{});let K=Symbol("DialogContext");function M(e){let l=L(K,null);if(l===null){let a=new Error(`<${e} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(a,M),a}return l}let G="DC8F892D-2EBD-447C-A4C8-A03058436FF4",Qe=D({name:"Dialog",inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},open:{type:[Boolean,String],default:G},initialFocus:{type:Object,default:null}},emits:{close:e=>!0},setup(e,{emit:l,attrs:a,slots:o,expose:n}){var t;let r=f(!1);T(()=>{r.value=!0});let i=f(0),s=De(),u=c(()=>e.open===G&&s!==null?W(s.value,{[ae.Open]:!0,[ae.Closed]:!1}):e.open),m=f(new Set),p=f(null),S=f(null),N=c(()=>B(p));if(n({el:p,$el:p}),!(e.open!==G||s!==null))throw new Error("You forgot to provide an `open` prop to the `Dialog`.");if(typeof u.value!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${u.value===G?void 0:e.open}`);let h=c(()=>r.value&&u.value?0:1),ee=c(()=>h.value===0),H=c(()=>i.value>1),ve=L(K,null)!==null,ge=c(()=>H.value?"parent":"leaf");Ie(p,c(()=>H.value?ee.value:!1)),Ue({type:"Dialog",enabled:c(()=>h.value===0),element:p,onUpdate:(d,g,v)=>{if(g==="Dialog")return W(d,{[Z.Add](){m.value.add(v),i.value+=1},[Z.Remove](){m.value.delete(v),i.value-=1}})}});let me=Oe({name:"DialogDescription",slot:c(()=>({open:u.value}))}),he=`headlessui-dialog-${x()}`,U=f(null),R={titleId:U,panelRef:f(null),dialogState:h,setTitleId(d){U.value!==d&&(U.value=d)},close(){l("close",!1)}};return V(K,R),Se(()=>{var d,g,v;return[...Array.from((g=(d=N.value)==null?void 0:d.querySelectorAll("body > *, [data-headlessui-portal]"))!=null?g:[]).filter(w=>!(!(w instanceof HTMLElement)||w.contains(j(S))||R.panelRef.value&&w.contains(R.panelRef.value))),(v=R.panelRef.value)!=null?v:p.value]},(d,g)=>{R.close(),Ae(()=>g==null?void 0:g.focus())},c(()=>h.value===0&&!H.value)),ue((t=N.value)==null?void 0:t.defaultView,"keydown",d=>{d.defaultPrevented||d.key===Fe.Escape&&h.value===0&&(H.value||(d.preventDefault(),d.stopPropagation(),R.close()))}),z(d=>{var g;if(h.value!==0||ve)return;let v=N.value;if(!v)return;let w=ke();function b(E,O,be){let ye=E.style.getPropertyValue(O);return Object.assign(E.style,{[O]:be}),w.add(()=>{Object.assign(E.style,{[O]:ye})})}let F=v==null?void 0:v.documentElement,te=((g=v.defaultView)!=null?g:window).innerWidth-F.clientWidth;if(b(F,"overflow","hidden"),te>0){let E=F.clientWidth-F.offsetWidth,O=te-E;b(F,"paddingRight",`${O}px`)}if(Ge()){let E=window.pageYOffset;b(F,"position","fixed"),b(F,"marginTop",`-${E}px`),b(F,"width","100%"),w.add(()=>window.scrollTo(0,E))}d(w.dispose)}),z(d=>{if(h.value!==0)return;let g=j(p);if(!g)return;let v=new IntersectionObserver(w=>{for(let b of w)b.boundingClientRect.x===0&&b.boundingClientRect.y===0&&b.boundingClientRect.width===0&&b.boundingClientRect.height===0&&R.close()});v.observe(g),d(()=>v.disconnect())}),()=>{let d={...a,ref:p,id:he,role:"dialog","aria-modal":h.value===0?!0:void 0,"aria-labelledby":U.value,"aria-describedby":me.value},{open:g,initialFocus:v,...w}=e,b={open:h.value===0};return y(J,{force:!0},()=>[y(pe,()=>y(Ne,{target:p.value},()=>y(J,{force:!1},()=>y(k,{initialFocus:v,containers:m,features:ee.value?W(ge.value,{parent:k.features.RestoreFocus,leaf:k.features.All&~k.features.FocusLock}):k.features.None},()=>P({ourProps:d,theirProps:w,slot:b,attrs:a,slots:o,visible:h.value===0,features:oe.RenderStrategy|oe.Static,name:"Dialog"}))))),y(Y,{features:_.Hidden,ref:S})])}}});D({name:"DialogOverlay",props:{as:{type:[Object,String],default:"div"}},setup(e,{attrs:l,slots:a}){let o=M("DialogOverlay"),n=`headlessui-dialog-overlay-${x()}`;function t(r){r.target===r.currentTarget&&(r.preventDefault(),r.stopPropagation(),o.close())}return()=>P({ourProps:{id:n,"aria-hidden":!0,onClick:t},theirProps:e,slot:{open:o.dialogState.value===0},attrs:l,slots:a,name:"DialogOverlay"})}});D({name:"DialogBackdrop",props:{as:{type:[Object,String],default:"div"}},inheritAttrs:!1,setup(e,{attrs:l,slots:a,expose:o}){let n=M("DialogBackdrop"),t=`headlessui-dialog-backdrop-${x()}`,r=f(null);return o({el:r,$el:r}),T(()=>{if(n.panelRef.value===null)throw new Error("A <DialogBackdrop /> component is being used, but a <DialogPanel /> component is missing.")}),()=>{let i=e,s={id:t,ref:r,"aria-hidden":!0};return y(J,{force:!0},()=>y(pe,()=>P({ourProps:s,theirProps:{...l,...i},slot:{open:n.dialogState.value===0},attrs:l,slots:a,name:"DialogBackdrop"})))}}});let Je=D({name:"DialogPanel",props:{as:{type:[Object,String],default:"div"}},setup(e,{attrs:l,slots:a,expose:o}){let n=M("DialogPanel"),t=`headlessui-dialog-panel-${x()}`;o({el:n.panelRef,$el:n.panelRef});function r(i){i.stopPropagation()}return()=>{let i={id:t,ref:n.panelRef,onClick:r};return P({ourProps:i,theirProps:e,slot:{open:n.dialogState.value===0},attrs:l,slots:a,name:"DialogPanel"})}}}),Ze=D({name:"DialogTitle",props:{as:{type:[Object,String],default:"h2"}},setup(e,{attrs:l,slots:a}){let o=M("DialogTitle"),n=`headlessui-dialog-title-${x()}`;return T(()=>{o.setTitleId(n),I(()=>o.setTitleId(null))}),()=>P({ourProps:{id:n},theirProps:e,slot:{open:o.dialogState.value===0},attrs:l,slots:a,name:"DialogTitle"})}});export{Qe as N,Ze as U,Je as _};
