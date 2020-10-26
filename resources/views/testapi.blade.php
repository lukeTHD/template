<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="app">
        <h1>Test Api</h1>
        <br>
        <br>
        <table>
            <tr>
                <th>id</th>
                <th>formid</th>
                <th>toid</th>
                <th>content</th>
            </tr>
            <tr v-for="item in list">
                <td>${item.id}</td>
                <td>${item.fromId}</td>
                <td>${item.toId}</td>
                <td>${item.content}</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <div>
            <input v-model="fromId" type="text" name="" id="">
            <input v-model="toId" type="text" name="" id="">
            <input v-model="content" type="text" name="" id="">
            <input v-model="status" type="text" name="" id="">
            <input v-model="link" type="text" name="" id="">
            <input v-model="type" type="text" name="" id="">
            <button @click="clickSubmit()">Submit</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script>
        new Vue({
            delimiters: ['${', '}'],
            el:"#app",
            data:{
                list:[],
                fromId:null,
                content:'',
                toId:null,
                status:'',
                link:'',
                type:''
            },
            mounted(){
                axios.get('http://localhost:81/template/public/api/testapi')
                .then(response=>{this.list=response.data});
            },
            methods:{
                clickSubmit:function(){
                    axios.post('http://localhost:81/template/public/api/testapi',{
                        fromId:this.fromId,
                        content:this.content,
                        toId:this.toId,
                        status:this.status,
                        link:this.link,
                        type:this.type                  
                    })
                    .then(response=>{
                        alert("Thanh cong");
                        this.list.push(response.data)
                    })
                    .catch(function (error) {
                        alert("That bai");
                    });               
                }
            }

        })
    </script>
</body>
</html>