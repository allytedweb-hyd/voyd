/* eslint-disable react/jsx-key */
import { Link } from "react-router-dom";
import { environmentUrl } from "../../env/enviroment";
import { useState, useEffect } from "react";
import { envImgUrl } from "../../env/envImage";
import Loader from "../Spinner/Loader";

const Projects = () => {
  const [prevProjects, setPrevProjects] = useState([]);
  const [loading, setLoading] = useState(true);

  const getPrevProjects = async () => {
    const apiUrl = `${environmentUrl}/previousProjects/get.php`;
    const options = {
      method: "GET",
    };
    const response = await fetch(apiUrl, options);
    const fetchedRes = await response.json();
    const res = fetchedRes?.response;
    setPrevProjects(res);
  };

  useEffect(() => {
    async function project() {
      await getPrevProjects();
      setLoading(false);
    }
    project();
  }, []);
  console.log("prev projects data", prevProjects);

  return (
    <>
      {loading && <Loader />}
      {!loading && (

        <>
          <se ction className="cards">
            {/* <!--Header--> */}

            <header>
              <div className="container-fluid">
                <h2 className="title">Our Projects</h2>
                <div className="text">
                  <p>Create an inviting space for yourself and family</p>
                </div>
              </div>
            </header>

            {/* <!--Content--> */}

            <div className="container-fluid">
              <div className="row">
                {/* <!--Item--> */}

                {prevProjects.map((eachProject, index) => (
                  <div
                    className={eachProject.type === "xl" ? "col-lg-8" : "col-lg-4"}
                    key={index}
                  >
                    <figure>
                      <figcaption
                        className={
                          eachProject.type === "xl"
                            ? "inspiration-img1"
                            : "inspiration-img2"
                        }
                      >
                        <img
                          src={`${envImgUrl}/Uploads/projects/${eachProject.project_image}`}
                          alt={eachProject.project_alttext}
                          key={eachProject.project_id}
                        />
                      </figcaption>
                      <Link to="/portfolioCategories" className="btn btn-clean">
                        {eachProject.project_title}
                      </Link>
                    </figure>
                  </div>
                ))}
              </div>
              {/* <!--/row--> */}
            </div>
            {/* <!--/container-fluid--> */}
          </se>
        </>
      )}
    </>
  );
};

export default Projects;
