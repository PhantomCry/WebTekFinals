function getProducts() {
    var xhr = new XMLHttpRequest();
    var cat = document.querySelector('#cat').value;
    var url = `GetProducts?view=json&cat=${cat}`;
    xhr.open('GET', url);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            showProducts(cat, xhr.responseText);
        }
    }
    xhr.send();
}

function showProducts(cat, json) {
    var products = JSON.parse(json);
    var div = document.querySelector('#productlist');

    var content = '<h1>Product List</h1>';
    content += `<h2>Category: ${cat}</h2>`;

    if (products.length == 0) {
        content += '<h2>No available products.</h2>';
    } else {
        content += `
                        <table style='border-collapse: collapse; border: 1px solid black'>
                            <thead style='color: yellow; background-color: black'>
                                <tr>
                                    <th>ProdID</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody style='border: inherit'>`;

        let style = "style = 'border: inherit; padding: 5px 10px'";
        products.forEach(product => {
            content += `
                            <tr style='border: inherit'>
                                <td ${style}>${product.prodid}</td>
                                <td ${style}>${product.description}</td>
                                <td ${style}>${Number(product.price).toFixed(2)}</td>
                                <td ${style}><img style='width: 50px' alt='${product.description}' src='dbimages/${product.prodid}'></td>
                            </tr>`;
        });

        content += `
                            </tbody>
                        </table>`;
    }

    div.innerHTML = content;
}