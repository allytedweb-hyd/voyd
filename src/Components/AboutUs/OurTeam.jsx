// /* eslint-disable react/jsx-key */
// import { Link } from "react-router-dom";
// import { BiLogoFacebook } from "react-icons/bi";
// import { FaXTwitter } from "react-icons/fa6";
// import { FaInstagram } from "react-icons/fa";
// import { IoIosMail } from "react-icons/io";
import { environmentUrl } from "../../env/enviroment";
import { useEffect, useState } from "react";
import { envImgUrl } from "../../env/envImage";
import { MdMail } from "react-icons/md";
import { Link } from "react-router-dom";
import { FaSquareXTwitter } from "react-icons/fa6";
import { RiInstagramFill } from "react-icons/ri";

const OurTeam = () => {
  const [openQualityModal, setOpenQualityModal] = useState(false);
  const [team, setTeam] = useState([]);

  const getOurTeam = async () => {
    const apiurl = `${environmentUrl}/ourTeam/get.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiurl, options);
    const fetchedData = await response.json();
    const ourTeam = fetchedData?.response;
    setTeam(Array.isArray(ourTeam) ? ourTeam : []); // CHANGED: guard against non-array responses
  };

  useEffect(() => {
    getOurTeam();
  }, []);
  return (
    <div>
      <section className="aboutTeamSection">
        <div className="container">
          <div className="row">
            <div className="teamTitleHeading">
              Meet Our Team <span>Members</span>{" "}
            </div>
          </div>
          <div className="row">
            {Array.isArray(team) && team.length > 0 ? ( // CHANGED: added Array.isArray check
              team.map((each, index) => (
                <div className=" teamCardOuter" key={index}>
                  <div className="teamDetailsBlock">
                    <div className="tm-image">
                      <img
                        src={`${envImgUrl}/Uploads/ourteam/${each?.team_image}`}
                        alt={each?.team_alttext}
                      />
                    </div>
                    <div className="tm-name">
                      <h5>{each?.ourteam_name}</h5>
                      <p>{each?.team_designation}</p>
                      <div
                        className="description"
                        dangerouslySetInnerHTML={{
                          __html: each?.team_description,
                        }}
                      ></div>
                    </div>
                  </div>
                </div>
              ))
            ) : (
              <div className="container">
                <div className="row">
                  <div className="result-container conditionImg">
                    <img src="assets/images/noDataFound.png" alt="" />
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </section>
    </div>
  );
};

export default OurTeam;

// const OurTeam = () => {
//   const [team, setTeam] = useState([]);

//   const getOurTeam = async () => {
//     const apiurl = `${environmentUrl}/ourTeam/get.php`;
//     const options = {
//       method: "GET",
//     };
//     const response = await fetch(apiurl, options);
//     const fetchedData = await response.json();
//     const ourTeam = fetchedData?.response;
//     setTeam(ourTeam);
//   };

//   useEffect(() => {
//     getOurTeam();
//   }, []);
//   // console.log("our Team====", team);

//   return (
//     <>
//       <section className="team">
//         {/* <!--Header--> */}

//         <header>
//           <div className="container">
//             <h1 className="h2 title">Meet Our Team</h1>
//             <div className="text">
//               <p>
//                 Our architects and designers constantly and carefully monitor
//                 the environment, they accept and develop changes, research
//                 fashion and architectural, as well as sociological, changes and
//                 transform them into unique design.
//               </p>
//             </div>
//           </div>
//         </header>

//         {/* <!--Content--> */}

//         <div className="container">
//           <div className="container">
//             {/* <div className="row heading">
//               <div className="col-md-6 col-md-offset-3">
//                 <h2 className="text-center bottom-line">Meet Our Team</h2>
//                 <p className="subheading text-center">Creative Nerds</p>
//               </div>
//             </div> */}

//             <div className="row team-row">
//               {team.map((teamMem) => (
//                 <div className="col-md-3 col-sm-6 col-sm-6 team-wrap">
//                   <div className="team-member text-center">
//                     <div className="team-img">
//                       <img
//                         className="team-mem-img"
//                         src={`${envImgUrl}/Uploads/ourteam/${teamMem?.team_image}`}
//                         alt={teamMem?.team_alttext}
//                       />
//                       <div className="overlay">
//                         <div className="team-details text-center">
//                           <p>Connect us</p>
//                           <div className="socials mt-20">
//                             <Link to={teamMem?.facebook_link} target="_blank">
//                               <BiLogoFacebook />
//                             </Link>
//                             <Link to={teamMem?.twitter_link} target="_blank">
//                               <FaXTwitter />
//                             </Link>
//                             <Link to={teamMem?.instagram_link} target="_blank">
//                               <FaInstagram />
//                             </Link>
//                             <Link to={teamMem?.mail_link} target="_blank">
//                               <IoIosMail />
//                             </Link>
//                           </div>
//                         </div>
//                       </div>
//                     </div>
//                     <h6 className="team-title">{teamMem?.ourteam_name}</h6>
//                     <span>{teamMem?.team_designation}</span>
//                   </div>
//                 </div>
//               ))}
//               {/* <!-- end team member --> */}
//             </div>
//           </div>
//           {/* <!--/row--> */}
//         </div>
//       </section>
//     </>
//   );
// };

// export default OurTeam;
