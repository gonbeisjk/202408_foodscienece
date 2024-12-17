jQuery(function($) {
    $('.js-slider').slick({
        fade: true,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: false
    });
});

async function fetchPostData() {
    const result = await fetch('http://foodscience.tokyo/wp-json/wp/v2/posts?per_page=3&order=desc')
    const posts = await result.json()
    console.log(posts)
    const cardList = document.querySelector('.cardList')

    let html = ''
    posts.forEach(post => {
        const title = post.title.rendered
        const link = post.link
        const date = post.date
        const dateObj = new Date(date)
        html += `
            <div class="item" style="width: 30%; border: 1px solid #ccc; padding: 10px;">
                <a href="${link}">
                    <h3>${title}</h3>
                    <time datetime="${date}">${dateObj.getFullYear()}年${dateObj.getMonth() + 1}月${dateObj.getDate()}日</time>
                </a>
            </div>
        `
    })

    cardList.insertAdjacentHTML('beforeend', html)
}
fetchPostData()