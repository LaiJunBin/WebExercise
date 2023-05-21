window.onload = () => {
    const router = async (path) => {
        history.pushState(null, null, path);
        const parser = new DOMParser();

        const htmlString = await fetch(path).then(res => res.text());
        const html = parser.parseFromString(htmlString, 'text/html');

        const newBody = html.querySelector('body');
        const oldBody = document.querySelector('body');

        oldBody.innerHTML = newBody.innerHTML;
        document.title = html.title;
    }

    window.addEventListener('click', e => {
        if (e.target.tagName === 'A') {
            e.preventDefault();
            const href = e.target.getAttribute('href');
            router(href);
        }
    })
}
