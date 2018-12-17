<div>
    <div id="respond" v-if="can_review">
        <form @submit.prevent="saveReview()">
            <div class="form-group">
                <b>{{trans('strings.frontend.review-this-course')}}</b>
            </div>
            <div class="form-group">
                <star-rating v-model="rating" :increment="0.5" :star-size="30" :show-rating="true" active-color="#2196f3"></star-rating>
            </div>
            
            <div class="comment-form-comment">
                <textarea v-model="comment" placeholder="{{trans('strings.frontend.enter-your-review')}}..."></textarea>
            </div>
            <div class="form-submit">
                <input type="submit" value="Post" class="mc-btn-2 btn-style-2">
            </div>
        </form>
    </div>
    <div class="total-review">
        <div class="" v-if="course.total_reviews > 0" >
            <star-rating :inline="false" text-class="avg_rating" :read-only="true" :increment="0.1" :star-size="40" active-color="#2196f3" :rating="course.average_rating"></star-rating>
            <b>{{ trans('strings.frontend.average_rating_from_reviews', ['number' => $course->reviews->count(), 'review' => str_plural(trans('strings.frontend.review'), $course->reviews->count())]) }}</b>
        </div>
        <div class="" v-else>
            <p>{{trans('strings.frontend.no-reviews')}}...</p>
        </div>
    </div>
    
    <ul class="list-review" v-for="review in reviews">
        <li class="review">
            <div class="body-review">
                <div class="review-author">
                    <a href="#">
                        <img :src="review.author_image" alt="">
                    </a>
                </div>
                <div class="content-review">
                    <h4 class="sm review-heading">
                        <a href="#">@{{review.author.name}}</a>
                        <small class="text-muted">@{{review.created_at_human}}</small>
                    </h4>
                    <div class="rating">
                        <star-rating :increment="0.5" :read-only="true" :star-size="20" active-color="#2196f3" :rating="parseFloat(review.rating)"></star-rating>
                    </div>
                    <p>@{{review.comment}}</p>
                </div>
            </div>
        </li>
    </ul>
    <div class="load-more" v-if="reviews.length > 0 && current_page < total_pages">
        <a href="" @click.prevent="fetchMoreReviews()">{{trans('strings.frontend.load-more')}}...</a>
    </div>
</div>