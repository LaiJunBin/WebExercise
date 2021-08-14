(this.webpackJsonpcontacts=this.webpackJsonpcontacts||[]).push([[0],{29:function(e,t,a){},30:function(e,t,a){},38:function(e,t,a){"use strict";a.r(t);var s=a(1),c=a.n(s),n=a(20),r=a.n(n),l=(a(29),a(30),a(6)),i=a(4),o=a(3),j=a(7),h=a(8),u=a.n(h),x=a(14),m=a(5),d=a(0),b=Object(s.createContext)();var g=function(e){var t=Object(s.useState)([]),a=Object(l.a)(t,2),c=a[0],n=a[1],r=Object(s.useState)([]),i=Object(l.a)(r,2),o=i[0],h=i[1],g=Object(m.useIndexedDB)("users").getAll,f=Object(m.useIndexedDB)("tags").getAll,O={users:c,setUsers:n,tags:o,setTags:h,getUsersByDB:function(){return Object(x.a)(u.a.mark((function e(){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.abrupt("return",g());case 1:case"end":return e.stop()}}),e)})))()},refreshUsers:function(){var e=this;return Object(x.a)(u.a.mark((function t(){var a;return u.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.getUsersByDB();case 2:return a=t.sent,t.next=5,e.refreshTags();case 5:e.setUsers(a);case 6:case"end":return t.stop()}}),t)})))()},getTagsByDB:function(){return Object(x.a)(u.a.mark((function e(){return u.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.abrupt("return",f());case 1:case"end":return e.stop()}}),e)})))()},refreshTags:function(){var e=this;return Object(x.a)(u.a.mark((function t(){var a;return u.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.getUsersByDB();case 2:return a=t.sent,t.t0=e,t.next=6,f().then((function(e){return e.map((function(e){return Object(j.a)(Object(j.a)({},e),{},{userCount:a.filter((function(t){return t.tags.includes(e.name)})).length})}))}));case 6:t.t1=t.sent,t.t0.setTags.call(t.t0,t.t1);case 8:case"end":return t.stop()}}),t)})))()}};return Object(d.jsx)(b.Provider,{value:O,children:e.children})};var f=function(e){var t=e.close,a=Object(s.useContext)(b),c=Object(s.useState)(""),n=Object(l.a)(c,2),r=n[0],i=n[1],o=Object(m.useIndexedDB)("tags").add;return Object(d.jsx)("div",{id:"dialog",className:"fixed top-0 left-0 z-10 w-full h-full bg-gray-300 bg-opacity-40 flex items-center justify-center",children:Object(d.jsx)("div",{className:"bg-white p-5 rounded-md w-80",children:Object(d.jsxs)("form",{onSubmit:function(e){e.preventDefault(),o({name:r}).then((function(e){a.refreshTags(),t()}),(function(e){console.log(e)}))},className:"newTag",children:[Object(d.jsx)("h2",{className:"title text-lg",children:"\u5efa\u7acb\u6a19\u7c64"}),Object(d.jsx)("p",{className:"my-3",children:Object(d.jsx)("input",{name:"name",type:"text",className:"border-b w-full h-8 outline-none hover:bg-gray-50 focus-within:border-gray-400 duration-200",value:r,onChange:function(e){return i(e.target.value)},required:!0})}),Object(d.jsxs)("p",{className:"mt-5 flex justify-end text-blue-600",children:[Object(d.jsx)("button",{className:"close p-2 px-3 mx-1 hover:bg-gray-100 duration-150",type:"button",onClick:t,children:"\u53d6\u6d88"}),Object(d.jsx)("button",{className:"submit p-2 px-3 mx-1 hover:bg-gray-100 duration-150",type:"submit",children:"\u5132\u5b58"})]})]})})})},O=a(10),p=a(15),v=a(16),A=a(24),N=a(23),w=a(21),y=a(12),C=a(19),B=a(22),k=Object(B.a)("props"),E="data:image/png;base64,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",D=function(e){Object(A.a)(a,e);var t=Object(N.a)(a);function a(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return Object(p.a)(this,a),t.call(this,{avatar:e.avatar||E,emails:e.emails||[""],phones:e.phones||[""],lastName:e.lastName||"",firstName:e.firstName||"",tags:e.tags||[],note:e.note||""})}return Object(v.a)(a,[{key:"emailChange",value:function(e,t){var a=this.emails.slice(),s=e.target.value;a[t]=s,""===s&&this.emails.length>=2?a.splice(t,1):a.every((function(e){return""!==e}))&&a.push(""),this.setEmails(a)}},{key:"phoneChange",value:function(e,t){var a=this.phones.slice(),s=e.target.value;a[t]=s,""===s&&this.phones.length>=2?a.splice(t,1):a.every((function(e){return""!==e}))&&a.push(""),this.setPhones(a)}}]),a}(function(){function e(t){var a=this;for(var c in Object(p.a)(this,e),Object.defineProperty(this,k,{writable:!0,value:[]}),this.init=function(e,t){return function(){var c,n=Object(s.useState)(void 0),r=Object(l.a)(n,2),i=r[0],o=r[1];Object.assign(a,(c={},Object(y.a)(c,t,i),Object(y.a)(c,"set"+t.charAt(0).toUpperCase()+t.substr(1),o),c)),void 0===a[t]&&o(e[t])}},t)Object(C.a)(this,k)[k].push(c),this.init.call(this,t,c)()}return Object(v.a)(e,[{key:"toObject",value:function(){var e,t={},a=Object(w.a)(Object(C.a)(this,k)[k]);try{for(a.s();!(e=a.n()).done;){var s=e.value;t[s]=this[s]}}catch(c){a.e(c)}finally{a.f()}return t}}]),e}());var U=function(e){var t=e.close,a=Object(s.useContext)(b),c=new D,n=a.tags,r=Object(m.useIndexedDB)("users").add,l=Object(s.useRef)(null);return Object(s.useEffect)((function(){var e=l.current;if(e){var t=function(e){var t=e.target.files[0];if(t){var a=new FileReader;a.onload=function(e){c.setAvatar(e.target.result)},a.readAsDataURL(t)}else c.setAvatar(E)};return e.addEventListener("change",t),function(){e.removeEventListener("change",t)}}})),Object(d.jsx)(d.Fragment,{children:c.emails?Object(d.jsx)("div",{id:"dialog",className:"fixed top-0 left-0 z-10 w-full h-full bg-gray-300 bg-opacity-40 flex items-center justify-center",children:Object(d.jsx)("div",{className:"bg-white p-5 rounded-md w-[680px] max-h-[80vh] overflow-y-scroll",children:Object(d.jsxs)("form",{onSubmit:function(e){e.preventDefault();var s=c.toObject();s.emails=s.emails.slice(0,-1),s.phones=s.phones.slice(0,-1);var n=new Image;n.src=s.avatar,n.onload=function(){var e=document.createElement("canvas"),c=e.getContext("2d");e.width=120,e.height=120,c.fillStyle="#fff",c.fillRect(0,0,120,120),c.drawImage(n,0,0,n.width,n.height,0,0,120,120),s.avatar=e.toDataURL("image/jpeg"),r(s).then((function(){a.refreshUsers(),t()}),(function(e){console.log(e)}))}},className:"newContact",children:[Object(d.jsx)("h2",{className:"title text-lg",children:"\u5efa\u7acb\u65b0\u806f\u7d61\u4eba"}),Object(d.jsx)("hr",{className:"mx-[-1.25rem] my-7"}),Object(d.jsxs)("div",{className:"flex items-center",children:[Object(d.jsx)("input",{type:"file",className:"avatar hidden",ref:l}),Object(d.jsx)("img",{alt:"avatar",className:"avatar_preview w-20 h-20 mr-6 cursor-pointer",src:c.avatar,onClick:function(){l.current&&l.current.click()}}),Object(d.jsx)("input",{type:"text",name:"last_name",placeholder:"\u59d3\u6c0f",className:"mx-3 h-10 outline-none border-b w-60",value:c.lastName,onChange:function(e){return c.setLastName(e.target.value)},required:!0}),Object(d.jsx)("input",{type:"text",name:"first_name",placeholder:"\u540d\u5b57",className:"mx-3 h-10 outline-none border-b w-60",value:c.firstName,onChange:function(e){return c.setFirstName(e.target.value)},required:!0})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 mt-6 flex items-start justify-center",children:Object(d.jsx)(o.a,{icon:i.c,className:"text-gray-500 text-xl"})}),Object(d.jsx)("div",{className:"flex-grow flex flex-col",children:c.emails.map((function(e,t){return Object(d.jsx)("input",{type:"email",name:"email[]",placeholder:"\u96fb\u5b50\u90f5\u4ef6",className:"outline-none h-10 mx-3 my-3 border-b flex-grow",value:e,onChange:function(e){return c.emailChange(e,t)},required:0===t},t)}))})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 mt-6 flex items-start justify-center",children:Object(d.jsx)(o.a,{icon:i.e,className:"text-gray-500 text-xl"})}),Object(d.jsx)("div",{className:"flex-grow flex flex-col",children:c.phones.map((function(e,t){return Object(d.jsx)("input",{type:"tel",name:"phone[]",placeholder:"\u96fb\u8a71",className:"outline-none h-10 mx-3 my-3 border-b flex-grow",value:e,onChange:function(e){return c.phoneChange(e,t)},required:0===t},t)}))})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 flex-shrink-0 flex items-center justify-center",children:Object(d.jsx)(o.a,{icon:i.i,className:"text-gray-500 text-xl"})}),Object(d.jsx)("div",{className:"tags",children:n.map((function(e,t){return Object(d.jsxs)("label",{className:"tag_text border rounded-full px-4 py-2 mx-2 leading-[50px] whitespace-nowrap",children:[Object(d.jsx)("input",{type:"checkbox",name:"tags[]",onChange:function(t){return t.target.checked?c.setTags([].concat(Object(O.a)(c.tags),[e.name])):c.setTags(c.tags.filter((function(t){return t!==e.name})))}}),Object(d.jsx)("span",{className:"ml-3",children:e.name})]},t)}))})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 flex items-center justify-center",children:Object(d.jsx)(o.a,{icon:i.h,className:"text-gray-500 text-xl"})}),Object(d.jsx)("textarea",{name:"note",cols:30,rows:1,placeholder:"\u9644\u8a3b",className:"outline-none h-10 mx-3 border-b flex-grow resize-none",value:c.note,onChange:function(e){return c.setNote(e.target.value)}})]}),Object(d.jsx)("hr",{className:"mx-[-1.25rem] mt-5"}),Object(d.jsxs)("p",{className:"mt-5 flex justify-end text-blue-600",children:[Object(d.jsx)("button",{className:"close p-2 px-3 mx-1 hover:bg-gray-100 duration-150",type:"button",onClick:t,children:"\u53d6\u6d88"}),Object(d.jsx)("button",{className:"submit p-2 px-3 mx-1 hover:bg-gray-100 duration-150",type:"submit",children:"\u5132\u5b58"})]})]})})}):""})};var I=function(e){return Object(d.jsx)("li",Object(j.a)(Object(j.a)({},e),{},{className:"item flex justify-between items-center py-3 px-10 ".concat(void 0!==e.current?"current":"hover:bg-gray-50"," hover:cursor-pointer ").concat(e.className||""),children:e.children}))};var T=function(){var e=Object(s.useState)(!1),t=Object(l.a)(e,2),a=t[0],c=t[1],n=Object(s.useState)(!1),r=Object(l.a)(n,2),j=r[0],h=r[1],u=Object(s.useContext)(b),x=u.tags,g=u.users,O=Object(m.useIndexedDB)("users").add;return Object(s.useEffect)((function(){u.refreshUsers(),u.refreshTags()}),[]),Object(d.jsxs)(d.Fragment,{children:[Object(d.jsxs)("aside",{id:"aside",className:"w-80",children:[Object(d.jsxs)("button",{id:"addContact",onClick:function(){return h(!0)},className:"rounded-full ml-3 p-3 px-5 border border-gray-200 shadow-md hover:bg-gray-50 duration-75 active:bg-gray-100",children:[Object(d.jsx)(o.a,{icon:i.f,className:"text-blue-600 scale-150"}),Object(d.jsx)("span",{className:"pl-3",children:"\u5efa\u7acb\u806f\u7d61\u4eba"})]}),Object(d.jsxs)("ul",{className:"list mt-5",children:[Object(d.jsxs)(I,{current:"true",children:[Object(d.jsx)(o.a,{icon:i.k,className:"text-gray-400"}),Object(d.jsx)("span",{className:"flex-grow ml-5",children:"\u806f\u7d61\u4eba"}),Object(d.jsx)("span",{className:"num text-sm",children:g.length})]}),Object(d.jsx)("li",{children:Object(d.jsx)("hr",{className:"mt-3"})}),Object(d.jsxs)("li",{className:"item flex flex-col py-3",children:[Object(d.jsxs)("div",{className:"flex items-center py-3 px-10 hover:bg-gray-50 hover:cursor-pointer",children:[Object(d.jsx)(o.a,{className:"text-gray-400",icon:i.a}),Object(d.jsx)("span",{className:"ml-5",children:"\u6a19\u7c64"})]}),Object(d.jsxs)("ul",{id:"tagList",className:"list",children:[x.map((function(e,t){return Object(d.jsxs)(I,{children:[Object(d.jsx)(o.a,{className:"text-gray-400",icon:i.i}),Object(d.jsx)("span",{className:"ml-5 flex-grow",children:e.name}),Object(d.jsx)("div",{className:"num text-sm",children:e.userCount})]},t)})),Object(d.jsxs)(I,{id:"addTag",className:"item",onClick:function(){return c(!0)},children:[Object(d.jsx)(o.a,{className:"text-gray-400",icon:i.f}),Object(d.jsx)("span",{className:"flex-grow ml-5",children:"\u5efa\u7acb\u6a19\u7c64"})]})]})]}),Object(d.jsx)("li",{children:Object(d.jsx)("hr",{className:"mb-3"})}),Object(d.jsxs)(I,{children:[Object(d.jsx)(o.a,{className:"text-gray-400",icon:i.j}),Object(d.jsx)("span",{className:"flex-grow ml-5",children:"\u5783\u573e\u6876"})]}),Object(d.jsx)("li",{children:Object(d.jsx)("hr",{className:"my-3"})}),Object(d.jsxs)(I,{onClick:function(){var e={avatar:E,emails:[Math.random().toString(36).substr(2,4)+"@"+Math.random().toString(36).substr(2,4)],phones:["09"+Math.random().toString(10).substr(2,8)],lastName:Math.random().toString(36).substr(2,4),firstName:Math.random().toString(36).substr(2,4),tags:[],note:""},t=new Image;t.src=e.avatar,t.onload=function(){var a=document.createElement("canvas"),s=a.getContext("2d");a.width=120,a.height=120,s.fillStyle="#fff",s.fillRect(0,0,120,120),s.drawImage(t,0,0,t.width,t.height,0,0,120,120),e.avatar=a.toDataURL("image/jpeg"),O(e).then((function(){u.refreshUsers()}),(function(e){console.log(e)}))}},className:"active:bg-gray-100",children:[Object(d.jsx)(o.a,{className:"text-gray-400",icon:i.d}),Object(d.jsx)("span",{className:"flex-grow ml-5",children:"\u7522\u751f\u4e00\u500b\u806f\u7d61\u4eba"})]})]})]}),a?Object(d.jsx)(f,{close:function(){return c(!1)}}):"",j?Object(d.jsx)(U,{close:function(){return h(!1)}}):""]})},M=a.p+"static/media/logo.6ce24c58.svg";var R=function(){return Object(d.jsxs)("header",{id:"header",className:"flex m-5",children:[Object(d.jsxs)("h1",{id:"logo",className:"w-80 flex items-center text-2xl font-bold text-gray-500",children:[Object(d.jsx)("img",{src:M,className:"h-12",alt:"logo"}),"\u806f\u7d61\u4eba"]}),Object(d.jsx)("form",{id:"searchForm",className:"flex-grow rounded-md bg-gray-100 focus-within:bg-gray-200 focus-within:outline-white",children:Object(d.jsxs)("label",{className:"w-full h-full pl-3 flex items-center",children:[Object(d.jsx)(o.a,{icon:i.g,className:"text-gray-400"}),Object(d.jsx)("input",{type:"text",name:"search",placeholder:"\u641c\u5c0b",className:"pl-3 h-full flex-grow bg-transparent outline-none"})]})})]})};var q=function(e){var t=e.user,a=e.close,c=Object(s.useContext)(b),n=new D(t);Object(s.useEffect)((function(){n.setEmails([].concat(Object(O.a)(n.emails),[""])),n.setPhones([].concat(Object(O.a)(n.phones),[""]))}),[]);var r=c.tags,l=Object(m.useIndexedDB)("users").update,h=Object(s.useRef)(null);return Object(s.useEffect)((function(){var e=h.current;if(e){var t=function(e){var t=e.target.files[0];if(t){var a=new FileReader;a.onload=function(e){n.setAvatar(e.target.result)},a.readAsDataURL(t)}else n.setAvatar(E)};return e.addEventListener("change",t),function(){e.removeEventListener("change",t)}}})),Object(d.jsx)(d.Fragment,{children:n.emails?Object(d.jsx)("div",{id:"dialog",className:"fixed top-0 left-0 z-10 w-full h-full bg-gray-300 bg-opacity-40 flex items-center justify-center",children:Object(d.jsx)("div",{className:"bg-white p-5 rounded-md w-[680px] max-h-[80vh] overflow-y-scroll",children:Object(d.jsxs)("form",{onSubmit:function(e){e.preventDefault();var s=n.toObject();s.emails=s.emails.slice(0,-1),s.phones=s.phones.slice(0,-1);var r=new Image;r.src=s.avatar,r.onload=function(){var e=document.createElement("canvas"),n=e.getContext("2d");e.width=120,e.height=120,n.fillStyle="#fff",n.fillRect(0,0,120,120),n.drawImage(r,0,0,r.width,r.height,0,0,120,120),s.avatar=e.toDataURL("image/jpeg"),l(Object(j.a)(Object(j.a)({},s),{},{id:t.id})).then((function(){c.refreshUsers(),a()}),(function(e){console.log(e)}))}},className:"newContact",children:[Object(d.jsx)("h2",{className:"title text-lg",children:"\u7de8\u8f2f\u806f\u7d61\u4eba"}),Object(d.jsx)("hr",{className:"mx-[-1.25rem] my-7"}),Object(d.jsxs)("div",{className:"flex items-center",children:[Object(d.jsx)("input",{type:"file",className:"avatar hidden",ref:h}),Object(d.jsx)("img",{alt:"avatar",className:"avatar_preview w-20 h-20 mr-6 cursor-pointer",src:n.avatar,onClick:function(){h.current&&h.current.click()}}),Object(d.jsx)("input",{type:"text",name:"last_name",placeholder:"\u59d3\u6c0f",className:"mx-3 h-10 outline-none border-b w-60",value:n.lastName,onChange:function(e){return n.setLastName(e.target.value)},required:!0}),Object(d.jsx)("input",{type:"text",name:"first_name",placeholder:"\u540d\u5b57",className:"mx-3 h-10 outline-none border-b w-60",value:n.firstName,onChange:function(e){return n.setFirstName(e.target.value)},required:!0})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 mt-6 flex items-start justify-center",children:Object(d.jsx)(o.a,{icon:i.c,className:"text-gray-500 text-xl"})}),Object(d.jsx)("div",{className:"flex-grow flex flex-col",children:n.emails.map((function(e,t){return Object(d.jsx)("input",{type:"email",name:"email[]",placeholder:"\u96fb\u5b50\u90f5\u4ef6",className:"outline-none h-10 mx-3 my-3 border-b flex-grow",value:e,onChange:function(e){return n.emailChange(e,t)},required:0===t},t)}))})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 mt-6 flex items-start justify-center",children:Object(d.jsx)(o.a,{icon:i.e,className:"text-gray-500 text-xl"})}),Object(d.jsx)("div",{className:"flex-grow flex flex-col",children:n.phones.map((function(e,t){return Object(d.jsx)("input",{type:"tel",name:"phone[]",placeholder:"\u96fb\u8a71",className:"outline-none h-10 mx-3 my-3 border-b flex-grow",value:e,onChange:function(e){return n.phoneChange(e,t)},required:0===t},t)}))})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 flex-shrink-0 flex items-center justify-center",children:Object(d.jsx)(o.a,{icon:i.i,className:"text-gray-500 text-xl"})}),Object(d.jsx)("div",{className:"tags",children:r.map((function(e,t){return Object(d.jsxs)("label",{className:"tag_text border rounded-full px-4 py-2 mx-2 leading-[50px] whitespace-nowrap",children:[Object(d.jsx)("input",{type:"checkbox",name:"tags[]",checked:n.tags.includes(e.name),onChange:function(t){n.setTags(t.target.checked?[].concat(Object(O.a)(n.tags),[e.name]):n.tags.filter((function(t){return t!==e.name})))}}),Object(d.jsx)("span",{className:"ml-3",children:e.name})]},t)}))})]}),Object(d.jsxs)("div",{className:"flex my-7",children:[Object(d.jsx)("div",{className:"w-20 mr-6 flex items-center justify-center",children:Object(d.jsx)(o.a,{icon:i.h,className:"text-gray-500 text-xl"})}),Object(d.jsx)("textarea",{name:"note",cols:30,rows:1,placeholder:"\u9644\u8a3b",className:"outline-none h-10 mx-3 border-b flex-grow resize-none",value:n.note,onChange:function(e){return n.setNote(e.target.value)}})]}),Object(d.jsx)("hr",{className:"mx-[-1.25rem] mt-5"}),Object(d.jsxs)("p",{className:"mt-5 flex justify-end text-blue-600",children:[Object(d.jsx)("button",{className:"close p-2 px-3 mx-1 hover:bg-gray-100 duration-150",type:"button",onClick:a,children:"\u53d6\u6d88"}),Object(d.jsx)("button",{className:"submit p-2 px-3 mx-1 hover:bg-gray-100 duration-150",type:"submit",children:"\u5132\u5b58"})]})]})})}):""})};var Q=function(){var e=Object(s.useContext)(b),t=e.users,a=Object(s.useState)(null),c=Object(l.a)(a,2),n=c[0],r=c[1],j=Object(m.useIndexedDB)("users").deleteRecord,h=Object(s.useState)(0),u=Object(l.a)(h,2),x=u[0],g=u[1],f=Object(s.useState)(!1),O=Object(l.a)(f,2),p=O[0],v=O[1];return Object(d.jsxs)(d.Fragment,{children:[Object(d.jsx)("main",{id:"main",className:"flex-grow",children:Object(d.jsxs)("table",{className:"contacts w-full",children:[Object(d.jsxs)("thead",{children:[Object(d.jsxs)("tr",{className:"text-left h-14 text-gray-500",children:[Object(d.jsx)("th",{className:"pl-3 w-[22%]",children:"\u540d\u7a31"}),Object(d.jsx)("th",{className:"w-[15%]",children:"\u96fb\u5b50\u90f5\u4ef6"}),Object(d.jsx)("th",{className:"w-1/6",children:"\u96fb\u8a71\u865f\u78bc"}),Object(d.jsx)("th",{className:"w-1/2",children:"\u6a19\u7c64"}),Object(d.jsx)("th",{className:"text-right pr-8",children:Object(d.jsx)(o.a,{icon:i.b})})]}),Object(d.jsx)("tr",{children:Object(d.jsx)("th",{colSpan:5,children:Object(d.jsx)("hr",{className:"mb-3"})})})]}),Object(d.jsxs)("tbody",{className:"absolute overflow-y-scroll",style:{width:"calc(100% - 325px)",height:"calc(100% - 160px)"},onScroll:function(e){g(Math.floor(e.target.scrollTop/55))},children:[t.slice(x,x+20).map((function(a,s){return Object(d.jsxs)("tr",{className:"contact h-14",style:{transform:"translateY(".concat(56*x,"px)")},children:[Object(d.jsx)("td",{className:"w-1/4",children:Object(d.jsxs)("div",{className:"flex items-center",children:[Object(d.jsx)("img",{className:"avatar",width:"75",src:a.avatar,alt:"avatar"}),Object(d.jsx)("div",{className:"ml-3 fullname",children:"".concat(a.lastName," ").concat(a.firstName)})]})}),Object(d.jsx)("td",{className:"email w-1/6",children:a.emails[0]}),Object(d.jsx)("td",{className:"phone w-1/6",children:a.phones[0]}),Object(d.jsx)("td",{className:"overflow-x-scroll w-1/2",children:Object(d.jsx)("div",{className:"tags flex",children:a.tags.map((function(e,t){return Object(d.jsx)("div",{className:"tag flex-shrink-0 text-sm bg-gray-300 rounded-sm text-bray-800 px-2 py-1 mx-1",children:e},t)}))})}),Object(d.jsxs)("td",{className:"actions text-right pr-5 w-52 whitespace-nowrap opacity-0 duration-150",children:[Object(d.jsx)("button",{className:"edit rounded-md px-3 py-2 mx-2 bg-blue-200 hover:bg-opacity-75 duration-100",onClick:function(){r(a),v(!0)},children:"\u7de8\u8f2f"}),Object(d.jsx)("button",{className:"delete px-3 py-2 bg-red-500 text-white rounded-md mx-2 hover:bg-opacity-80 duration-100",onClick:function(){return function(a){var s=t[a];j(s.id).then((function(){e.refreshUsers()}))}(s)},children:"\u522a\u9664"})]})]},s)})),Object(d.jsx)("tr",{style:{height:56*(t.length-20)}})]})]})}),p?Object(d.jsx)(q,{user:n,close:function(){return v(!1)}}):""]})};Object(m.initDB)({name:"MyDB",version:1,objectStoresMeta:[{store:"tags",storeConfig:{keyPath:"id",autoIncrement:!0},storeSchema:[{name:"name",keypath:"name",options:{unique:!1}}]},{store:"users",storeConfig:{keyPath:"id",autoIncrement:!0},storeSchema:[{name:"tags",keypath:"tags",options:{unique:!1,multiEntry:!0}}]}]});var W=function(){return Object(d.jsx)(g,{children:Object(d.jsxs)("div",{className:"flex flex-col",children:[Object(d.jsx)(R,{}),Object(d.jsxs)("div",{className:"flex",children:[Object(d.jsx)(T,{}),Object(d.jsx)(Q,{})]})]})})},S=function(e){e&&e instanceof Function&&a.e(3).then(a.bind(null,39)).then((function(t){var a=t.getCLS,s=t.getFID,c=t.getFCP,n=t.getLCP,r=t.getTTFB;a(e),s(e),c(e),n(e),r(e)}))};r.a.render(Object(d.jsx)(c.a.StrictMode,{children:Object(d.jsx)(W,{})}),document.getElementById("root")),S()}},[[38,1,2]]]);
//# sourceMappingURL=main.f4029a0b.chunk.js.map