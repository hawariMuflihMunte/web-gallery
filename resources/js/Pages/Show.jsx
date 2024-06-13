export default function Show({ post }) {
    return (
        <>
            <h1>{post.title}</h1>
            <hr />
            <p>{post.body}</p>
        </>
    );
}
