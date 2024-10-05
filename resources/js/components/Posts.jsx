import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

const Posts = () => {
    const [posts, setPosts] = useState([]);

    useEffect(() => {
        fetch('/api/posts') // Prilagodi API krajnju tačku po potrebi
            .then(response => response.json())
            .then(data => setPosts(data));
    }, []);

    return (
        <div>
            <h1>Postovi</h1>
            {posts.map(post => (
                <div key={post.id}>
                    <h2>{post.title}</h2>
                    <p>{post.content}</p>
                    <Link to={`/posts/${post.id}`}>Pogledaj Post</Link>
                </div>
            ))}
        </div>
    );
};

export default Posts;