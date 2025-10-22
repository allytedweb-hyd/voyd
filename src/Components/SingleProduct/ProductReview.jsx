import { Link } from "react-router-dom";
import { BiSolidStar } from "react-icons/bi";

const ProductReview = () => {
  return (
    <>
      <section className="product-details">
        <div className="container">
          {/* <!--Tab links--> */}

          <ul
            className="nav nav-pills nav-pills-flat justify-content-center singleproduct"
            id="pills-tab"
            role="tablist"
          >
            <li className="nav-item">
              <Link
                className="nav-link active"
                id="tab-review-tab"
                data-toggle="tab"
                to="#tab-review"
                role="tab"
              >
                Reviews
              </Link>
            </li>
            {/* <li className="nav-item">
              <Link
                className="nav-link"
                id="tab-desc-tab"
                data-toggle="tab"
                to="#tab-desc"
                role="tab"
              >
                Description
              </Link>
            </li> */}
            {/* <li className="nav-item">
              <Link
                className="nav-link"
                id="tab-info-tab"
                data-toggle="tab"
                to="#tab-shipping"
                role="tab"
              >
                Shipping
              </Link>
            </li> */}
          </ul>

          {/* <!--Tab content--> */}

          <div className="tab-content" id="pills-tabContent">
            {/* <!--Tab description--> */}

            <div className="tab-pane fade show active" id="tab-review">
              <div className="col-md-8 offset-md-2">
                {/* <!--Rating--> */}

                <div className="rating">
                  <div className="rating-overall">
                    <div className="rating-header">
                      <div className="row align-items-center">
                        <div className="col-2">
                          <div className="h1 m-0">4.8</div>
                        </div>

                        <div className="col-10">
                          <div className="h3 m-0">User rating overall</div>
                          <span>4.8 average based on 625 reviews</span>
                        </div>
                      </div>
                    </div>

                    <div className="row align-items-center">
                      <div className="col-2">
                        <p>
                          5 <BiSolidStar />
                        </p>
                      </div>

                      <div className="col-10">
                        <div className="progress">
                          <div
                            className="progress-bar progress5-width"
                            role="progressbar"
                            aria-valuenow="100"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          ></div>
                        </div>
                      </div>

                      <div className="col-2">
                        <p>
                          4 <BiSolidStar />
                        </p>
                      </div>

                      <div className="col-10">
                        <div className="progress">
                          <div
                            className="progress-bar progress4-width"
                            role="progressbar"
                            aria-valuenow="85"
                            aria-valuemin="0"
                            aria-valuemax="85"
                          ></div>
                        </div>
                      </div>

                      <div className="col-2">
                        <p>
                          3 <BiSolidStar />
                        </p>
                      </div>

                      <div className="col-10">
                        <div className="progress">
                          <div
                            className="progress-bar progress3-width"
                            role="progressbar"
                            aria-valuenow="30"
                            aria-valuemin="0"
                            aria-valuemax="30"
                          ></div>
                        </div>
                      </div>

                      <div className="col-2">
                        <p>
                          2 <BiSolidStar />
                        </p>
                      </div>

                      <div className="col-10">
                        <div className="progress">
                          <div
                            className="progress-bar progress2-width"
                            role="progressbar"
                            aria-valuenow="20"
                            aria-valuemin="0"
                            aria-valuemax="20"
                          ></div>
                        </div>
                      </div>

                      <div className="col-2">
                        <p>
                          1 <BiSolidStar />
                        </p>
                      </div>

                      <div className="col-10">
                        <div className="progress">
                          <div
                            className="progress-bar progress1-width"
                            role="progressbar"
                            aria-valuenow="15"
                            aria-valuemin="0"
                            aria-valuemax="15"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                {/* <!--Comments--> */}

                <div className="comments">
                  <div className="comment-header">
                    <div className="h3 m-0">Recent comments</div>
                    <span>14 reviews for Bedroom product</span>
                  </div>

                  <div className="comment-wrapper">
                    {/* <!--Comment--> */}

                    {/* <div className="comment-block"> */}
                      {/* <!--Comment user--> */}

                      {/* <div className="comment-user">
                        <div>
                          <img
                            src="assets/images/user.jpg"
                            alt="Alternate Text"
                            width="70"
                          />
                        </div>
                        <div>
                          <h5>
                            <span>John Doe</span>
                            <span className="pull-right">
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star"></i>
                            </span>
                            <small>03.05.2017</small>
                          </h5>
                        </div>
                      </div> */}

                      {/* <!--Comment description--> */}

                      {/* <div className="comment-desc">
                        <p>
                          In vestibulum tellus ut nunc accumsan eleifend. Donec
                          mattis cursus ligula, id iaculis dui feugiat nec.
                          Etiam ut ante sed neque lacinia volutpat. Maecenas
                          ultricies tempus nibh, sit amet facilisis mauris
                          vulputate in. Phasellus tempor justo et mollis
                          facilisis. Donec placerat at nulla sed suscipit.
                          Praesent accumsan, sem sit amet euismod ullamcorper,
                          justo sapien cursus nisl, nec gravida
                        </p>
                      </div> */}

                      {/* <!--Comment reply--> */}

                      {/* <div className="comment-block">
                        <div className="comment-user">
                          <div>
                            <img
                              src="assets/images/user.jpg"
                              alt="Alternate Text"
                              width="70"
                            />
                          </div>
                          <div>
                            <h5>
                              Administrator
                              <small>08.05.2017</small>
                            </h5>
                          </div>
                        </div>
                        <div className="comment-desc">
                          <p>
                            Curabitur sit amet elit quis tellus tincidunt
                            efficitur. Cras lobortis id elit eu vehicula. Sed
                            porttitor nulla vitae nisl varius luctus. Quisque a
                            enim nisl. Maecenas facilisis, felis sed blandit
                            scelerisque, sapien nisl egestas diam, nec blandit
                            diam ipsum eget dolor. Maecenas ultricies tempus
                            nibh, sit amet facilisis mauris vulputate in.
                          </p>
                        </div>
                      </div> */}
                      {/* <!--/reply--> */}
                    {/* </div> */}

                    {/* <!--Comment--> */}

                    <div className="comment-block">
                      {/* <!--Comment user--> */}

                      <div className="comment-user">
                        <div>
                          <img
                            src="assets/images/user.jpg"
                            alt="Alternate Text"
                            width="70"
                          />
                        </div>
                        <div>
                          <h5>
                            <span>John Doe</span>
                            <span className="pull-right">
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star active"></i>
                              <i className="fa fa-star"></i>
                              <i className="fa fa-star"></i>
                            </span>
                            <small>03.05.2017</small>
                          </h5>
                        </div>
                      </div>

                      {/* <!--Comment description--> */}

                      <div className="comment-desc">
                        <p>
                          Cras lobortis id elit eu vehicula. Sed porttitor nulla
                          vitae nisl varius luctus. Quisque a enim nisl.
                          Maecenas facilisis, felis sed blandit scelerisque,
                          sapien nisl egestas diam, nec blandit diam ipsum eget
                          dolor. In vestibulum tellus ut nunc accumsan eleifend.
                          Donec mattis cursus ligula, id iaculis dui feugiat
                          nec. Etiam ut ante sed neque lacinia volutpat.
                          Maecenas ultricies tempus nibh, sit amet facilisis
                          mauris vulputate in. Phasellus tempor justo et mollis
                          facilisis. Donec placerat at nulla sed suscipit.
                          Praesent accumsan, sem sit amet euismod ullamcorper,
                          justo sapien cursus nisl, nec gravida
                        </p>
                      </div>
                    </div>

                    {/* </div><!--/comment-wrapper--> */}

                    <div className="comment-header text-center">
                      <Link to="#" className="btn btn-main">
                        12 comments
                      </Link>
                    </div>

                    {/* <!--Add new comment--> */}

                    <div className="comment-add">
                      <div className="comment-reply-message">
                        <div className="h3 title">Leave a Reply </div>
                        <p>Your email address will not be published.</p>
                      </div>

                      <form action="#" method="post">
                        <div className="form-group">
                          <input
                            type="text"
                            className="form-control"
                            name="name"
                            value=""
                            placeholder="Your Name"
                          />
                        </div>
                        <div className="form-group">
                          <input
                            type="text"
                            className="form-control"
                            name="name"
                            value=""
                            placeholder="Your Email"
                          />
                        </div>
                        <div className="form-group">
                          <textarea
                            rows="10"
                            className="form-control"
                            placeholder="Your comment"
                          ></textarea>
                        </div>
                        <div className="clearfix text-center">
                          {/* <Link to="#" className="btn btn-main"> */}
                          <button className="btn btn-primary singleproduct">
                            Add Comment
                          </button>
                          {/* </Link> */}
                        </div>
                      </form>
                    </div>
                    {/* <!--/comment-add--> */}
                  </div>
                  {/* <!--/comments--> */}
                </div>
                {/* <!--/col-md-8--> */}
              </div>
              {/* <!--/tab-pane --> */}
              {/* <!--Tab specification--> */}

              {/* <div className="tab-pane fade" id="tab-desc">
                <div className="col-md-8 offset-md-2">
                  <div>
                    <div className="h3 m-0">Product specification</div>
                    <span>Additional information</span>
                  </div>

                  <hr />

                  <div className="row">
                    <div className="col-6">
                      <img
                        className="img-fluid"
                        src="assets/images/specs.png"
                        alt="Alternate Text"
                        width="350"
                      />
                    </div>
                    <div className="col-6">
                      <img
                        className="img-fluid"
                        src="assets/images/specs.png"
                        alt="Alternate Text"
                        width="350"
                      />
                    </div>
                  </div>
                </div>
              </div> */}
              {/* <!--/tab-pane --> */}
              {/* <!--Tab review--> */}

              {/* <div className="tab-pane fade" id="tab-shipping">
                <div className="col-md-8 offset-md-2">
                  <div>
                    <div className="h3 m-0">Shipping information</div>
                    <span>Additional information</span>
                  </div>

                  <hr />

                  <h5>Money Back Guarantee</h5>
                  <p>
                    Our Money Back Guarantee applies to virtually everything on
                    our site, and there&apos;s no extra fee for coverage. It’s
                    automatic and covers your purchase price plus original
                    shipping on eligible purchases*. Follow these steps to get
                    your refund.
                  </p>

                  <h5>Need to Return an Item?</h5>

                  <p>
                    Whatever you’re looking for, millions of items on our store
                    are returnable. Before you buy an item, check the seller’s
                    return policy, then follow these easy steps to make a
                    return. If the item you received doesn&apos;t match the
                    description in the original listing, or if it arrived faulty
                    or damaged,
                  </p>

                  <h5>Check an open return request</h5>

                  <p>
                    You can keep an eye on the progress of your return request
                    by selecting Check your return status below, or in your
                    Purchase history.
                  </p>

                  <h5>Send the item back</h5>

                  <p>
                    You&apos;ll need to send it back within 5 business days. Who
                    covers the shipping costs depends on why you&apos;re
                    returning it. Find more information about return shipping.
                    When you send your item back we recommend using tracked
                    shipping. Adding tracking details to your return helps
                    protect against delays or issues in the refund process.
                  </p>
                </div>
              </div> */}
              {/* <!--/tab-pane --> */}
            </div>
            {/* <!--/tab-content --> */}
          </div>
        </div>
      </section>
    </>
  );
};

export default ProductReview;
