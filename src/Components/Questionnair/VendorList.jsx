/* eslint-disable react/prop-types */
// import React from 'react'
import React, { useState } from "react";
import ReactPaginate from "react-paginate";
import { Link } from "react-router-dom";
import { FaRegEye } from "react-icons/fa";

const VendorList = (props) => {
  console.log("props in vendor list", props);

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 10;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems =
    props.vendorList?.slice(indexOfFirstItem, indexOfLastItem) || [];
  const totalPages = Math.ceil((props.vendorList?.length || 0) / itemsPerPage);

  const handlePageChange = (pageNumber) => {
    setCurrentPage(pageNumber);
    // window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handlePrev = () => {
    if (currentPage > 1) setCurrentPage(currentPage - 1);
    // window.scrollTo({ top: 0, behavior: "smooth" });
  };

  const handleNext = () => {
    if (currentPage < totalPages) setCurrentPage(currentPage + 1);
    // window.scrollTo({ top: 0, behavior: "smooth" });
  };

  return (
    <>
      <div className="container v-tablle ">
        <div className="row justify-content-center">
          <div className="table-hdng text-center pb-3 w-100 ">
            <div className="list-vendor list-v">
              List Of Vendors Under{" "}
              <span className="ptnm-txt ptn-tb">{props?.vendorClass}</span>{" "}
              Classification
            </div>
            <div className="ovr-hidn margins">
              <div
                className="table-responsive"
                style={{ overflowX: "auto", whiteSpace: "nowrap" }}
              >
                <table className="table " style={{ minWidth: "800px" }}>
                  <thead className="thead-dark">
                    <tr className="bg-brown userTbl">
                      <th className="text-center text-light tbl-l-br">
                        <div className="tbl-iner center">S.No</div>
                      </th>
                      <th className="text-light tbl-brs">
                        {" "}
                        <div className="tbl-iner">Vendor Name</div>
                      </th>
                      <th className="width-15 text-light tbl-brs">
                        {" "}
                        <div className="tbl-iner ">Company Type</div>
                      </th>
                      <th className="text-light tbl-brs">
                        {" "}
                        <div className="tbl-iner">Company Name</div>
                      </th>
                      <th className="text-light tbl-brs">
                        {" "}
                        <div className="tbl-iner">Projects Done</div>
                      </th>
                      <th className="text-light tbl-r-br">
                        {" "}
                        <div className="tbl-iner">Vendor Info</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    {/* {props?.vendorList.map((each, index) => ( */}

                    {currentItems.map((each, index) => (
                      <tr className="brdr-brm-grey" key={index}>
                        <th>{index + 1}</th>
                        <td>
                          {`${each?.vendor_firstname} ${each?.vendor_lastname}`}
                        </td>
                        <td>{each?.vendor_company}</td>
                        <td>{each?.company_name}</td>
                        <td>{each?.projects_done}</td>
                        <td>
                          <Link to={`/VendorInfo?id=${each?.vendor_id}`}>
                            <button className="final-but">
                              <FaRegEye />
                            </button>
                          </Link>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        {props.vendorList?.length > 0 && (
          <div className="productPagination page-bg-btn-fil">
            <div className="pgn-fltr prev-flt" onClick={handlePrev}>
              Preview
            </div>

            <div className="numbers-main num-mn">
              {(() => {
                const pageButtons = [];
                const visiblePages = 2;

                for (let i = 1; i <= totalPages; i++) {
                  if (
                    i === 1 ||
                    i === totalPages ||
                    (i >= currentPage - visiblePages &&
                      i <= currentPage + visiblePages)
                  ) {
                    pageButtons.push(
                      <button
                        key={i}
                        className={`page-btns ${currentPage === i ? "grn-btn" : ""
                          }`}
                        onClick={() => handlePageChange(i)}
                      >
                        {i}
                      </button>
                    );
                  } else if (
                    (i === currentPage - visiblePages - 1 &&
                      currentPage - visiblePages > 2) ||
                    (i === currentPage + visiblePages + 1 &&
                      currentPage + visiblePages < totalPages - 1)
                  ) {
                    pageButtons.push(
                      <button
                        key={`ellipsis-${i}`}
                        className="page-btns"
                        disabled
                      >
                        ...
                      </button>
                    );
                  }
                }

                return pageButtons;
              })()}
            </div>

            <div className="pgn-fltr nxt-flt" onClick={handleNext}>
              Next
            </div>
          </div>
        )}

        {/* <div className="row py-3 pagins">
          <div className="col-md-3"></div>
          <div className="col-md-6 d-flex justify-content-center ">
            <button className="page-bg-btn d-flex justify-content-between">
              <div className="col-grey fnt-12 mr-4 mrgn-mob">prevoius page</div>
              <div className="mr-4 d-flex">
                <button className="page-btns2">1</button>{" "}
                <button className="page-btns2">2</button>{" "}
                <button className="page-btns2">3</button>{" "}
                <button className="page-btns2">4</button>{" "}
                <button className="page-btns2">5</button>{" "}
                <button className="page-btns2">6</button>{" "}
                <button className="page-btns2">7</button>
              </div>
              <div className="fnt-12 text-dark d-flex align-items-center">
                Next page
              </div>
            </button>
          </div>
          <div className="col-md-3"></div>
        </div> */}
      </div>
      {/* <div className="container">
        <div className="row">
          <div className="my-quotes-container">
            <div className="group view-quotation">
              <h2 className="text-center">
                List Of Vendors Under{" "}
                <span className="title_span">{props?.vendorClass}</span>{" "}
                Classification
              </h2>

              <div className="vendortable">
                <table>
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Vendor Name</th>
                      <th>Company Type</th>
                      <th>Company Name</th>
                      <th>GST No</th>
                    </tr>

                    {props?.vendorList.map((each, index) => (
                      <tr key={index}>
                        <td>{index + 1}</td>
                        <td>{`${each?.vendor_firstname} ${each?.vendor_lastname}`}</td>
                        <td>{each?.vendor_company}</td>
                        <td>{each?.company_name}</td>

                        <td>{each?.vendor_gst}</td>
                      </tr>
                    ))}
                  </thead>
                </table>
              </div>

              <div className="pagination-wrapper">
                <ReactPaginate
                  breakLabel="...."
                  nextLabel="Next >"
                  onPageChange={3}
                  pageRangeDisplayed={2}
                  pageCount={9}
                  previousLabel="< Prev"
                  // renderOnZeroPageCount={null}
                />
              </div>
            </div>
          </div>
        </div>
      </div> */}
    </>
  );
};

export default VendorList;
