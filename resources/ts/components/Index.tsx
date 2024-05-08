import {useState ,useEffect } from 'react';
import React from 'react';
import { createRoot } from 'react-dom/client';


type Todo = {
    created_at:string,
    deadline:string,
    id:number,
    todo_content:string,
    todo_title:string,
    updated_at:string,
}

const Index = () => {

    //検索欄が更新されたら検索欄のvalueを取得
    const [search_value,setSearchValue] = useState('');

    //検索欄が更新されたらvalueを保持する
    const handleChange =(e)=>{
        setSearchValue(e.target.value);
    }

    //検索ボタンが押されたらsearch_valueをパラメーターとしてセットし、APIを呼び出す
const handleClick = ()=>{
        // コンポーネントがマウントされたタイミングでAPIにリクエスト送信
        fetch(`todo?word=${search_value}`)　//Httpリクエストを送信する先(今回はweb.phpで指定したurl)
        .then(response => response.json()) //APIが返してきたresponseを受ける関数
        .then(todos => setTodo(todos))　//受け取ったresponseデータをstateで保持
        .catch(error => console.error('Error',error));
}

console.log('test',search_value);

    const [todos,setTodo] = useState<Todo[]>([]);

    useEffect(()=>{
        // コンポーネントがマウントされたタイミングでAPIにリクエスト送信
        fetch('todo')　//Httpリクエストを送信する先(今回はweb.phpで指定したurl)
        .then(response => response.json()) //APIが返してきたresponseを受ける関数
        .then(todos => setTodo(todos))　//受け取ったresponseデータをstateで保持
        .catch(error => console.error('Error',error));
    },[]);

    if(todos.length === 0){
        console.log("loadings")
        return <h1>読み込み中・・・</h1>
    }else{
        return (
        <>
            <div className="container">
                    <h3 className="my-3">TODOアプリ</h3>
                    <div className="card">
                        <div className="card-header">TODO一覧</div>

                        <div className="card-body">
                            <a href="" className="btn btn-success mb-3">新規作成</a>
                            <form method='GET'>
                                <input type='text' value={search_value} onChange={handleChange}></input>
                                <button　onClick={handleClick}>検索</button>
                            </form>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>タイトル</th>
                                        <th>内容</th>
                                        <th>作成日時</th>
                                        <th>締切</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {todos && todos.map((todo,index)=>(
                                    <>
                                        <tr key={index}>
                                            <td>{todo.id}</td>
                                            <td>{todo.todo_title}</td>
                                            <td>{todo.todo_content}</td>
                                            <td>{todo.updated_at}</td>
                                            {/* {todo.date_over_flg ? */}
                                            <td className="text-danger bg-warning">{todo.deadline}</td>
                                            {/* :
                                            <td>{todo.deadline}</td>} */}

                                            <td><a href="{{route('todos.show',$todo['id'])}}" className="btn btn-primary mb-3">詳細</a></td>
                                                <td><a href="{{route('todos.edit',$todo['id'])}}" className="btn btn-primary mb-3">編集</a></td>
                                            <td>
                                                <form method="post" action="{{route('todos.destroy',$todo['id'])}}">
                                                    <button type="submit" className="btn btn-danger">削除</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </>))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </>
        );
    }
}

export default Index;

const container = document.getElementById('index');
const root = createRoot(container!);
root.render(<Index/>);
