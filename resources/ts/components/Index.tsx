import React from 'react';
import { createRoot } from 'react-dom/client';

// type Props = {
//     todos : any
// }

// const Index:React.FC<Props> = ({
//   todos

const todos = document.getElementById('index')

const Index = ({
}) => {
    return (
    <>
        <div className="container">
                <h3 className="my-3">TODOアプリ</h3>
                <div className="card">
                    <div className="card-header">TODO一覧</div>

                    <div className="card-body">
                        <a href="{{route('todos.create')}}" className="btn btn-success mb-3">新規作成</a>
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
                                {todos.map((todo:any)=>{
                                return(
                                <>
                                    <tr>
                                        <td>{todo.id}</td>
                                        <td>{todo.todo_title}</td>
                                        <td>{todo.todo_content}</td>
                                        <td>{todo.updated_at}</td>
                                        {todo.date_over_flg ?
                                        <td className="text-danger bg-warning">{todo.deadline}</td>
                                        :
                                        <td>{todo.deadline}</td>}

                                        <td><a href="{{route('todos.show',$todo['id'])}}" className="btn btn-primary mb-3">詳細</a></td>
                                            <td><a href="{{route('todos.edit',$todo['id'])}}" className="btn btn-primary mb-3">編集</a></td>
                                        <td>
                                            <form method="post" action="{{route('todos.destroy',$todo['id'])}}">
                                                <button type="submit" className="btn btn-danger">削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                </>);}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </>
    );
}

export default Index;

const container = document.getElementById('index');
const root = createRoot(container!);
root.render(<Index/>);
