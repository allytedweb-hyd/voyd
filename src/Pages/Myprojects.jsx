// // import React from 'react'

// import { useEffect, useState } from "react";
// import { environmentUrl } from "../env/enviroment";
// import { TbStatusChange } from "react-icons/tb";
// import { Link } from "react-router-dom";

// const Myprojects = () => {
//   const [freezedProjects, setFreezedProjects] = useState([]);
//   const getFreezedProjects = async () => {
//     const apiUrl = `${environmentUrl}/questionnaire/getFreezedProjects.php`;
//     const options = {
//       method: "GET",
//       headers: { Authorization: "Bearer " + localStorage.getItem("token") },
//     };
//     const fetching = await (await fetch(apiUrl, options)).json();
//     const response = fetching.response;
//     setFreezedProjects(response);
//   };

//   useEffect(() => {
//     getFreezedProjects();
//   }, []);
//   // console.log("freezed projects are====", freezedProjects);

//   return (
//     <>
//       <div className="container">
//         <div className="row">
//           <div className="group view-quotation my-quotes-container mt-5">
//             {freezedProjects.length > 0 && (
//               <>
//                 <h2 className="text-center">Freezed Projects</h2>
//                 <table>
//                   <thead>
//                     <tr>
//                       <th>S.No</th>
//                       <th>Customer Name</th>
//                       <th>Project Name</th>
//                       <th>Budget</th>
//                       <th>Project Type</th>
//                       <th>Mobile</th>
//                       <th>End Date</th>
//                       <th>Action</th>
//                     </tr>

//                     {freezedProjects.map((each, index) => (
//                       <tr key={index} id={each?.que_id}>
//                         <td>{index + 1}</td>
//                         <td>{`${each?.first_name} ${each?.last_name}`}</td>
//                         <td>
//                           {`Mr.INTRO0${each?.customer_id}-${each?.property}(${each?.property_type})-${each?.que_id}`}
//                         </td>
//                         <td>{each?.budget.toLocaleString("en-IN")}</td>
//                         <td>{`${each?.product_classification} / ${each?.manufacturer_classification}`}</td>

//                         <td>{each?.mobile}</td>
//                         <td>-</td>

//                         <td className="tracking-icon">
//                           <Link to={"/projectStatus"}>
//                             track <TbStatusChange />
//                           </Link>
//                         </td>
//                       </tr>
//                     ))}
//                   </thead>
//                 </table>
//               </>
//             )}
//             {freezedProjects.length == 0 && (
//               <>
//                 <div className="no-freezed-projects">
//                   <img src="assets/images/no-element.jpg" alt="" />
//                   <p>No Projects Were Freezed</p>
//                   <Link to="/myQuotes">Freeze Project</Link>
//                 </div>
//               </>
//             )}
//           </div>
//         </div>
//       </div>
//     </>
//   );
// };

// export default Myprojects;


import React from 'react'
import { useEffect, useState } from "react";
import { environmentUrl } from "../env/enviroment";
import { TbStatusChange } from "react-icons/tb";
import { Link } from "react-router-dom";
const Myprojects = () => {
  const [freezedProjects, setFreezedProjects] = useState([]);
  const getFreezedProjects = async () => {
    const apiUrl = `${environmentUrl}/questionnaire/getFreezedProjects.php`;
    const options = {
      method: "GET",
      headers: { Authorization: "Bearer " + localStorage.getItem("token") },
    };
    const fetching = await (await fetch(apiUrl, options)).json();
    const response = fetching.response;
    setFreezedProjects(response);
  };

  useEffect(() => {
    getFreezedProjects();
  }, []);
  console.log("freezed projects are====", freezedProjects);
  return (
    <div>
      <section>
        <div className="container borderr mb-5">

          {freezedProjects.length > 0 && (
            <>
              <h2 className="text-center">Freezed Projects</h2>

              <table className="table mt-4">
                <thead className="thead-darkk">
                  <tr className="bg-brown">
                    <th scope="col" className="text-center">
                      S.No
                    </th>
                    <th scope="col ">Customer Name</th>
                    <th scope="col ">
                      Project Name
                    </th>
                    <th scope="col ">Budget</th>
                    <th scope="col">Project Type</th>
                    <th scope="col" className="">Mobile</th>
                    <th scope="col" className="">
                      End Date
                    </th>
                    <th scope="col" className="">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {freezedProjects.map((each, index) => (
                    <tr key={index} id={each?.que_id} className="dynamicRowBg">
                      <td scope="row" className="text-center">
                        <b>{index + 1}</b>
                      </td>
                      <td>{`${each?.first_name} ${each?.last_name}`}</td>
                      <td>
                        {`VOYD0${each?.customer_id}-${each?.property}(${each?.property_type})-${each?.que_id}`}
                      </td>
                      <td>{each?.budget.toLocaleString("en-IN")}</td>
                      <td>{`${each?.product_classification} / ${each?.manufacturer_classification}`}</td>

                      <td className="">{each?.mobile}</td>
                      <td className="">28-03-2025</td>

                      <td className="tracking-icon">
                        <Link to={"/projectStatus"}>
                          track <TbStatusChange />
                        </Link>
                      </td>

                    </tr>
                  ))}

                </tbody>
              </table>
            </>
          )}
          {freezedProjects.length == 0 && (
            <>
              <div className="no-freezed-projects">
                <img src="assets/images/no-element.jpg" alt="" />
                <p>No Projects Were Freezed</p>
                <Link to="/myQuotes">Freeze Project</Link>
              </div>
            </>
          )}
        </div>
      </section>
    </div>
  )
}

export default Myprojects