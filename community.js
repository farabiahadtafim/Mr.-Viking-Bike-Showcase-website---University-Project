/**

 * MR. VIKING - Community Page Logic

 * Handles feed, social interactions, and post creation

 */

document.addEventListener('DOMContentLoaded', () => {

    const Community = {

        currentUser: null,

        posts: [],

        activeFilter: 'All',

        activeSort: 'Latest',

        init() {

            this.checkAuth();

            this.setupEventListeners();

            this.loadPosts();

            this.loadBikeRatings();

            this.populateBikeSelect();

            // Custom cursor and preloader are handled by script.js, 

            // but we ensure preloader hides if not already.

            const preloader = document.getElementById('preloader');

            if (preloader) {

                setTimeout(() => preloader.classList.add('loaded'), 1000);

            }

        },

        async checkAuth() {

            try {

                const res = await fetch('auth_handler.php?check=1');

                const data = await res.json();

                if (data.loggedIn) {

                    this.currentUser = data.user;

                    this.updateUIForLoggedInUser();

                } else {

                    this.updateUIForGuest();

                }

            } catch (e) {

                console.error('Auth check failed', e);

            }

        },

        updateUIForLoggedInUser() {

            const user = this.currentUser;

            // Header

            document.getElementById('loginBtn').style.display = 'none';

            const userStatus = document.getElementById('userStatus');

            userStatus.style.display = 'flex';

            const avatarCircle = document.getElementById('userAvatarCircle');

            if (user.profile_image) {

                avatarCircle.innerHTML = `<img src="${user.profile_image}" class="avatar-img" />`;

            } else {

                avatarCircle.textContent = user.first_name[0].toUpperCase();

            }

            // Sidebar

            document.getElementById('sidebarName').textContent = `${user.first_name} ${user.last_name}`;

            document.getElementById('sidebarRole').textContent = user.is_admin == 1 ? 'MV Administrator' : 'Revolutionary Rider';

            const sidebarAvatar = document.getElementById('sidebarAvatar');

            if (user.profile_image) {

                sidebarAvatar.innerHTML = `<img src="${user.profile_image}" class="avatar-img" />`;

            } else {

                sidebarAvatar.textContent = user.first_name[0].toUpperCase();

            }

            // Create Post Box

            document.getElementById('createPostBox').style.display = 'block';

            const createPostAvatar = document.getElementById('createPostAvatar');

            if (user.profile_image) {

                createPostAvatar.innerHTML = `<img src="${user.profile_image}" class="avatar-img" />`;

            } else {

                createPostAvatar.textContent = user.first_name[0].toUpperCase();

            }

            // Modal

            document.getElementById('modalUserName').textContent = `${user.first_name} ${user.last_name}`;

            const modalAvatar = document.getElementById('modalUserAvatar');

            if (user.profile_image) {

                modalAvatar.innerHTML = `<img src="${user.profile_image}" class="avatar-img" />`;

            } else {

                modalAvatar.textContent = user.first_name[0].toUpperCase();

            }

        },

        updateUIForGuest() {

            document.getElementById('createPostBox').style.display = 'none';

            document.getElementById('sidebarName').textContent = 'Guest Rider';

            document.getElementById('sidebarRole').textContent = 'Join the Community';

        },

        setupEventListeners() {

            // Modal Toggles

            const openBtn = document.getElementById('openPostModal');

            const closeBtn = document.querySelector('.modal-close');

            const modal = document.getElementById('postModal');

            if (openBtn) {

                openBtn.onclick = () => modal.classList.add('active');

            }

            if (closeBtn) {

                closeBtn.onclick = () => modal.classList.remove('active');

            }

            window.onclick = (e) => {

                if (e.target === modal) modal.classList.remove('active');

            };

            // Post Type Toggle

            const typeSelect = document.getElementById('postTypeSelect');

            const reviewFields = document.getElementById('reviewFields');

            if (typeSelect) {

                typeSelect.onchange = (e) => {

                    reviewFields.style.display = e.target.value === 'Review' ? 'block' : 'none';

                };

            }

            // Create Post Form

            const postForm = document.getElementById('createPostForm');

            if (postForm) {

                postForm.onsubmit = async (e) => {

                    e.preventDefault();

                    const formData = new FormData(postForm);

                    formData.append('action', 'createPost');

                    try {

                        const res = await fetch('community_api.php', {

                            method: 'POST',

                            body: formData

                        });

                        const data = await res.json();

                        if (data.success) {

                            this.showToast('Post created successfully!');

                            modal.classList.remove('active');

                            postForm.reset();

                            reviewFields.style.display = 'none';

                            this.loadPosts();

                        } else {

                            alert(data.message || 'Error creating post');

                        }

                    } catch (err) {

                        console.error('Submit error', err);

                    }

                };

            }

            // Filters

            document.querySelectorAll('.filter-list li').forEach(li => {

                li.onclick = () => {

                    document.querySelector('.filter-list li.active').classList.remove('active');

                    li.classList.add('active');

                    this.activeFilter = li.dataset.filter;

                    this.loadPosts();

                };

            });

            // Media Preview

            const mediaInput = document.getElementById('mediaInput');

            const preview = document.getElementById('filePreview');

            if (mediaInput) {

                mediaInput.onchange = () => {

                    const file = mediaInput.files[0];

                    if (file) {

                        const reader = new FileReader();

                        reader.onload = (e) => {

                            preview.innerHTML = file.type.startsWith('video')

                                ? `<video src="${e.target.result}" controls></video>`

                                : `<img src="${e.target.result}" />`;

                        };

                        reader.readAsDataURL(file);

                    }

                };

            }

        },

        async loadPosts() {

            const feed = document.getElementById('feedPosts');

            feed.innerHTML = '<div class="loading-shimmer"><div class="shimmer-card"></div><div class="shimmer-card"></div></div>';

            try {

                const res = await fetch(`community_api.php?action=fetchPosts&type=${this.activeFilter}&sort=${this.activeSort}`);

                const data = await res.json();

                if (data.success) {

                    this.posts = data.posts;

                    this.renderPosts();

                }

            } catch (e) {

                console.error('Fetch posts failed', e);

            }

        },

        renderPosts() {

            const feed = document.getElementById('feedPosts');

            if (this.posts.length === 0) {

                feed.innerHTML = '<div class="no-posts">No posts found in this category. Be the first to share!</div>';

                return;

            }

            feed.innerHTML = this.posts.map(post => this.createPostHTML(post)).join('');

            // Update counts in sidebar summary if this is the current user

            if (this.currentUser) {

                const myPosts = this.posts.filter(p => p.user_id == this.currentUser.id).length;

                const sidebarStats = document.querySelectorAll('.stat-item span');

                if (sidebarStats[0]) sidebarStats[0].textContent = myPosts;

            }

        },

        createPostHTML(post) {

            const tagClass = `tag-${post.type.toLowerCase().replace(' ', '-')}`;

            const timeAgo = this.formatDate(post.created_at);

            const avatar = post.profile_image

                ? `<img src="${post.profile_image}" class="avatar-img" />`

                : post.first_name[0].toUpperCase();

            const media = post.media_url

                ? `<div class="post-media">${post.media_url.endsWith('.mp4') ? `<video src="${post.media_url}" controls></video>` : `<img src="${post.media_url}" loading="lazy" />`}</div>`

                : '';

            const rating = post.type === 'Review' && post.rating

                ? `<div class="post-rating-ribbon">

                    <span class="stars">${'&#x2605;'.repeat(post.rating)}${'&#x2606;'.repeat(5 - post.rating)}</span>

                    ${post.bike_id ? `<span class="bike-link">MR. VIKING ${post.bike_id.split('-').map(w => w.toUpperCase()).join(' ')}</span>` : ''}

                   </div>`

                : '';

            const reactionActive = post.my_reaction ? 'active' : '';

            const reactionEmoji = post.my_reaction === 'Love' ? '&#x2764;&#xFE0F;' : (post.my_reaction === 'Wow' ? '&#x1F525;' : '&#x1F44D;');

            const reactionText = post.my_reaction || 'Like';

            // Build reaction summary (e.g. &#x1F44D; 3  &#x2764;&#xFE0F; 2  &#x1F525; 1)

            let reactionSummary = '';

            const lc = parseInt(post.like_count) || 0;

            const lov = parseInt(post.love_count) || 0;

            const wc = parseInt(post.wow_count) || 0;

            if (lc > 0) reactionSummary += `&#x1F44D;${lc} `;

            if (lov > 0) reactionSummary += `&#x2764;&#xFE0F;${lov} `;

            if (wc > 0) reactionSummary += `&#x1F525;${wc}`;

            if (!reactionSummary) reactionSummary = '0';

            const formatCount = (num) => {

                if (num >= 1000) return (num / 1000).toFixed(1) + 'K';

                return num;

            };

            const isOwner = this.currentUser && post.user_id == this.currentUser.id;

            const isAdmin = this.currentUser && this.currentUser.is_admin == 1;

            const optionsMenu = `

                <div class="post-options-container">

                    <button class="options-trigger" onclick="Community.togglePostOptions(${post.id}, event)">

                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>

                    </button>

                    <div class="options-dropdown" id="options-dropdown-${post.id}">

                        <div class="option-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg> Save post</div>

                        <div class="option-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> Not interested</div>

                        ${isOwner || isAdmin ? `<div class="option-item delete" onclick="Community.handlePostAction(${post.id}, 'delete')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg> Delete Post</div>` : ''}

                        <div class="option-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg> Report post</div>

                    </div>

                </div>

            `;

            const commentsHTML = post.comments.map(c => `

                <div class="comment-item">

                    <div class="avatar-sm">${c.profile_image ? `<img src="${c.profile_image}" class="avatar-img" />` : c.first_name[0].toUpperCase()}</div>

                    <div class="comment-bubble">

                        <h5>${c.first_name} ${c.last_name}</h5>

                        <p>${this.escapeHtml(c.content)}</p>

                    </div>

                </div>

            `).join('');

            return `

                <div class="post-card" data-id="${post.id}">

                    <div class="post-header">

                        <div class="post-user-info">

                            <div class="avatar-round">${avatar}</div>

                            <div class="user-meta-main">

                                <div class="name-follow">

                                    <h4>${post.first_name} ${post.last_name}</h4>

                                    <span class="follow-btn">&#xB7; Follow</span>

                                </div>

                                <div class="post-time-meta">

                                    <span>${timeAgo}</span>

                                    <svg class="privacy-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>

                                </div>

                            </div>

                        </div>

                        <div class="post-header-actions">

                            ${optionsMenu}

                            <button class="close-post-btn"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>

                        </div>

                    </div>

                    <div class="post-caption">

                        ${this.escapeHtml(post.content)}

                    </div>

                    <div class="post-media-container">

                        ${media}

                        ${rating}

                    </div>

                    <div class="post-feedback-summary">

                        <div class="reaction-counts">

                            <div class="reaction-icons-stack">

                                ${(() => {

                    const counts = [

                        { type: 'Like', icon: '&#x1F44D;', count: parseInt(post.like_count) },

                        { type: 'Love', icon: '&#x2764;&#xFE0F;', count: parseInt(post.love_count) },

                        { type: 'Care', icon: '&#x1F970;', count: parseInt(post.care_count) },

                        { type: 'Haha', icon: '&#x1F606;', count: parseInt(post.haha_count) },

                        { type: 'Wow', icon: '&#x1F62E;', count: parseInt(post.wow_count) },

                        { type: 'Sad', icon: '&#x1F622;', count: parseInt(post.sad_count) },

                        { type: 'Angry', icon: '&#x1F621;', count: parseInt(post.angry_count) }

                    ].filter(r => r.count > 0).sort((a, b) => b.count - a.count).slice(0, 2);

                    if (counts.length === 0) return '<span class="summary-icon empty">&#x1F44D;</span>';

                    return counts.map(r => `<span class="summary-icon ${r.type.toLowerCase()}">${r.icon}</span>`).join('');

                })()}

                            </div>

                            <span class="count-text">${formatCount(post.reaction_count)}</span>

                        </div>

                        <div class="stats-counts">

                            <span>${formatCount(post.comment_count)} comments</span>

                            <span>${formatCount(post.share_count || 0)} shares</span>

                        </div>

                    </div>

                    <div class="post-actions-bar">

                        <div class="action-btn-container reaction-opener">

                            <button class="action-btn react-btn ${post.my_reaction ? post.my_reaction.toLowerCase() : ''}" onclick="Community.handleReaction(${post.id}, 'Like')">

                                ${post.my_reaction === 'Love' ? '<span>&#x2764;&#xFE0F;</span>' :

                    post.my_reaction === 'Care' ? '<span>&#x1F970;</span>' :

                        post.my_reaction === 'Haha' ? '<span>&#x1F606;</span>' :

                            post.my_reaction === 'Wow' ? '<span>&#x1F62E;</span>' :

                                post.my_reaction === 'Sad' ? '<span>&#x1F622;</span>' :

                                    post.my_reaction === 'Angry' ? '<span>&#x1F621;</span>' :

                                        '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>'}

                                <span>${post.my_reaction || 'Like'}</span>

                            </button>

                            <div class="reactions-popover-glass">

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Like')" title="Like">&#x1F44D;</span>

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Love')" title="Love">&#x2764;&#xFE0F;</span>

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Care')" title="Care">&#x1F970;</span>

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Haha')" title="Haha">&#x1F606;</span>

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Wow')" title="Wow">&#x1F62E;</span>

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Sad')" title="Sad">&#x1F622;</span>

                                <span onclick="event.stopPropagation(); Community.handleReaction(${post.id}, 'Angry')" title="Angry">&#x1F621;</span>

                            </div>

                        </div>

                        <button class="action-btn" onclick="Community.toggleComments(${post.id})">

                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>

                            <span>Comment</span>

                        </button>

                        <div class="action-btn-container share-opener">

                            <button class="action-btn" onclick="Community.toggleShareMenu(${post.id}, event)">

                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>

                                <span>Share</span>

                            </button>

                            <div class="share-dropdown-glass" id="share-menu-${post.id}">

                                <div class="share-option"><div class="share-icon messenger"></div> Messenger</div>

                                <div class="share-option"><div class="share-icon whatsapp"></div> WhatsApp</div>

                                <div class="share-option"><div class="share-icon story"></div> Your Story</div>

                                <div class="share-option"><div class="share-icon link"></div> Copy Link</div>

                            </div>

                        </div>

                    </div>

                    <div class="comments-section-glass" id="comments-${post.id}" style="display:none;">

                        <div class="comment-sort-header">Most relevant <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></div>

                        <div class="comments-list">${commentsHTML}</div>

                        ${this.currentUser ? `

                        <div class="comment-input-glass">

                            <div class="avatar-round">${this.currentUser.profile_image ? `<img src="${this.currentUser.profile_image}" class="avatar-img" />` : this.currentUser.first_name[0].toUpperCase()}</div>

                            <div class="input-wrapper">

                                <input type="text" placeholder="Comment as ${this.currentUser.first_name} ${this.currentUser.last_name}" onkeydown="if(event.key==='Enter') Community.submitComment(${post.id}, this)">

                                <div class="input-accessories">

                                    <span>&#x1F60A;</span><span>&#x1F4F7;</span><span>GIF</span><span>&#x1F3A8;</span>

                                </div>

                            </div>

                        </div>

                        ` : ''}

                    </div>

                </div>

            `;

        },

        async handleReaction(postId, type) {

            if (!this.currentUser) return alert('Please login to react to posts');

            try {

                const formData = new FormData();

                formData.append('action', 'toggleReaction');

                formData.append('post_id', postId);

                formData.append('type', type);

                const res = await fetch('community_api.php', { method: 'POST', body: formData });

                const data = await res.json();

                if (data.success) {

                    // Force refresh posts to update all counts and states

                    await this.loadPosts();

                    // Close all reaction popovers explicitly

                    document.querySelectorAll('.reactions-popover-glass').forEach(p => {

                        p.style.opacity = '0';

                        p.style.visibility = 'hidden';

                    });

                }

            } catch (e) { console.error(e); }

        },

        toggleComments(postId) {

            const section = document.getElementById(`comments-${postId}`);

            section.style.display = section.style.display === 'none' ? 'block' : 'none';

        },

        togglePostOptions(postId, event) {

            event.stopPropagation();

            const dropdown = document.getElementById(`options-dropdown-${postId}`);

            const isActive = dropdown.classList.contains('active');

            document.querySelectorAll('.options-dropdown').forEach(d => d.classList.remove('active'));

            if (!isActive) dropdown.classList.add('active');

            const closer = () => {

                dropdown.classList.remove('active');

                window.removeEventListener('click', closer);

            };

            setTimeout(() => window.addEventListener('click', closer), 10);

        },

        toggleShareMenu(postId, event) {

            event.stopPropagation();

            const menu = document.getElementById(`share-menu-${postId}`);

            const isActive = menu.classList.contains('active');

            document.querySelectorAll('.share-dropdown-glass').forEach(m => m.classList.remove('active'));

            if (!isActive) menu.classList.add('active');

            const closer = () => {

                menu.classList.remove('active');

                window.removeEventListener('click', closer);

            };

            setTimeout(() => window.addEventListener('click', closer), 10);

        },

        async handlePostAction(postId, action) {

            if (!confirm(`Are you sure you want to ${action} this post?`)) return;

            try {

                const formData = new FormData();

                formData.append('action', action === 'delete' ? 'deletePost' : 'archivePost');

                formData.append('post_id', postId);

                const res = await fetch('community_api.php', { method: 'POST', body: formData });

                const data = await res.json();

                if (data.success) {

                    this.showToast(`Post ${action}d successfully!`);

                    this.loadPosts();

                    // Navigate to upload section

                    const createPostBox = document.getElementById('createPostBox');

                    if (createPostBox) {

                        createPostBox.scrollIntoView({ behavior: 'smooth' });

                        // Optionally flash it or open modal

                        setTimeout(() => {

                            const openModalBtn = document.getElementById('openPostModal');

                            if (openModalBtn) openModalBtn.click();

                        }, 800);

                    }

                } else {

                    alert(data.message || 'Action failed');

                }

            } catch (e) { console.error(e); }

        },

        async submitComment(postId, input) {

            const content = input.value.trim();

            if (!content) return;

            try {

                const formData = new FormData();

                formData.append('action', 'addComment');

                formData.append('post_id', postId);

                formData.append('content', content);

                const res = await fetch('community_api.php', { method: 'POST', body: formData });

                const data = await res.json();

                if (data.success) {

                    input.value = '';

                    this.loadPosts();

                }

            } catch (e) { console.error(e); }

        },

        handleShare(postId) {

            const url = `${window.location.origin}${window.location.pathname}?post=${postId}`;

            navigator.clipboard.writeText(url).then(() => {

                this.showToast('Link copied to clipboard!');

            });

        },

        showToast(msg) {

            const toast = document.getElementById('toast');

            toast.textContent = msg;

            toast.classList.add('show');

            setTimeout(() => toast.classList.remove('show'), 3000);

        },

        populateBikeSelect() {

            const select = document.getElementById('bikeSelect');

            if (!select || !window.bikeData) return;

            Object.keys(window.bikeData).forEach(id => {

                const bike = window.bikeData[id];

                const opt = document.createElement('option');

                opt.value = id;

                opt.textContent = `${bike.name}`;

                select.appendChild(opt);

            });

        },

        async loadBikeRatings() {

            try {

                const res = await fetch('community_api.php?action=getBikeRatings');

                const data = await res.json();

                if (data.success) {

                    this.renderSidebarRatings(data.ratings);

                }

            } catch (e) { console.error(e); }

        },

        renderSidebarRatings(ratings) {

            const list = document.getElementById('topBikesList');

            if (ratings.length === 0) {

                list.innerHTML = '<p style="font-size:0.8rem; color:var(--color-text-tertiary);">No reviews yet.</p>';

                return;

            }

            list.innerHTML = ratings.slice(0, 5).map(r => {

                const bike = window.bikeData ? window.bikeData[r.bike_id] : { name: r.bike_id };

                return `

                    <div class="trending-item">

                        <div class="trending-info">

                            <h5>${bike.name}</h5>

                            <span class="stars">${'&#x2605;'.repeat(Math.round(r.avg_rating))}</span>

                        </div>

                        <span class="trending-count">${parseFloat(r.avg_rating).toFixed(1)}</span>

                    </div>

                `;

            }).join('');

        },

        formatDate(dateStr) {

            const date = new Date(dateStr);

            const now = new Date();

            const diff = (now - date) / 1000;

            if (diff < 60) return 'Just now';

            if (diff < 3600) return Math.floor(diff / 60) + 'm ago';

            if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';

            return date.toLocaleDateString();

        },

        escapeHtml(text) {

            const div = document.createElement('div');

            div.textContent = text;

            return div.innerHTML;

        }

    };

    Community.init();

    // Expose to window for inline onclicks

    window.Community = Community;

});