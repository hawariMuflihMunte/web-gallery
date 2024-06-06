import { router } from "@inertiajs/react";

export default function Index({ posts }) {
    function deletePost(id) {
        router.delete(`/post/${id}`);
        router.get('/post');
    }

  return (
    <>
        <h1>My Super Blog</h1>
        <a href="/post/create">Create Post</a>
        <hr/>
        { posts && posts.map( (item) => (
            <div key={item.id}>
                <h2>{item.id}) {item.title}</h2>
                <p>{item.body}</p>
                <button type="button" onClick={() => deletePost(item.id)}>Delete</button>
                <hr/>
            </div>
        )) }
    </>
  );
}
