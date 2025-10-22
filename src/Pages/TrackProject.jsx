import { PieChart, Pie, Cell } from "recharts";
import Collapse from "react-bootstrap/Collapse";
import Button from "react-bootstrap/Button";
import { useState } from "react";
import { IoArrowForwardCircle } from "react-icons/io5";
import GaugeChart from "react-gauge-chart";
import { useEffect } from "react";
import { useSearchParams } from "react-router-dom";
import { environmentUrl } from "../env/enviroment";
import { Tooltip, Legend } from "recharts";
import Loader from "../Components/Spinner/Loader";

const TrackProject = () => {
  const [searchParams] = useSearchParams();
  const uid = searchParams.get("uid");
  const [projectData, setProjectData] = useState(null);
  const apiUrl = `${environmentUrl}/questionnaire/get_project_status.php`;

  const [pieChartData, setPieChartData] = useState([]);
  const [loading, setLoading] = useState(true);

  // const [open, setOpen] = useState(false);
  // const data = [
  //   { name: "Group A", value: 300 },
  //   { name: "Group B", value: 400 },
  //   { name: "Group C", value: 500 },
  //   { name: "Group E", value: 200 },
  //   { name: "Group F", value: 300 },
  //   { name: "Group G", value: 600 },
  // ];

  const COLORS = [
    "#7ac142",
    "#377b2b",
    "#FFBB28",
    "#FF8042",
    "#00529b",
    "#007cc3",
  ];

  const RADIAN = Math.PI / 180;
  // const renderCustomizedLabel = ({
  //   cx,
  //   cy,
  //   midAngle,
  //   innerRadius,
  //   outerRadius,
  //   percent,
  // }) => {
  //   const radius = innerRadius + (outerRadius - innerRadius) * 0.5;
  //   const x = cx + radius * Math.cos(-midAngle * RADIAN);
  //   const y = cy + radius * Math.sin(-midAngle * RADIAN);

  //   return (
  //     <text
  //       x={x}
  //       y={y}
  //       fill="white"
  //       textAnchor={x > cx ? "start" : "end"}
  //       dominantBaseline="central"
  //     >
  //       {`${(percent * 100).toFixed(0)}%`}
  //     </text>
  //   );
  // };

  // useEffect(() => {
  //   const needlePath = document.querySelector(
  //     "#gauge-chart5 svg g.needle path"
  //   );
  //   if (needlePath) {
  //     needlePath.setAttribute("d", "M -1.5 -13 L 60 -48 L 1.5 3");
  //   }
  // }, []);
  // useEffect(() => {
  //   const orangeArc = document.querySelector(
  //     "#gauge-chart5 svg g.arc:nth-child(2) path"
  //   );
  //   if (orangeArc) {
  //     let d = orangeArc.getAttribute("d");
  //     d = d.replace(/A135\.357,135\.357/g, "A125,125");
  //     d = d.replace(/A108\.286,108\.286/g, "A122,122");
  //     orangeArc.setAttribute("d", d);
  //   }
  // }, []);

  const renderCustomizedLabel = ({
    cx,
    cy,
    midAngle,
    innerRadius,
    outerRadius,
    value,
    name,
  }) => {
    if (name === "Remaining") {
      return null;
    }

    const radius = innerRadius + (outerRadius - innerRadius) * 0.5;
    const x = cx + radius * Math.cos(-midAngle * RADIAN);
    const y = cy + radius * Math.sin(-midAngle * RADIAN);

    return (
      <text
        x={x}
        y={y}
        fill="white"
        textAnchor="middle"
        dominantBaseline="central"
      >
        {`${value}%`}
      </text>
    );
  };

  // useEffect(() => {
  //   const fetchProjectData = async () => {
  //     try {
  //       const res = await fetch(`${apiUrl}?uid=${uid}`);
  //       const data = await res.json();
  //       setProjectData(data);
  //       console.log("Fetched projectData:", data);

  //       const pieData = [
  //         { name: "False Ceiling", value: parseFloat(data.false_ceiling || 0) },
  //         { name: "Electrical & Lighting", value: parseFloat(data.elec_light || 0) },
  //         { name: "Sanitary", value: parseFloat(data.sanitary || 0) },
  //         { name: "Wardrobes", value: parseFloat(data.wardrobes || 0) },
  //         { name: "Wall Putty", value: parseFloat(data.wall_putty || 0) },
  //         { name: "Painting", value: parseFloat(data.painting || 0) },
  //       ];
  //       setPieChartData(pieData);
  //       console.log("Pie chart data:", pieData);
  //     } catch (error) {
  //       console.error("Failed to fetch project data:", error);
  //     }
  //   };

  //   if (uid) {
  //     fetchProjectData();
  //   }
  // }, [uid]);

  useEffect(() => {
    const fetchProjectData = async () => {
      try {
        const res = await fetch(`${apiUrl}?uid=${uid}`);
        const data = await res.json();
        setProjectData(data);
        console.log("Fetched projectData:", data);

        const rawPieData = [
          { name: "False Ceiling", value: parseFloat(data.false_ceiling || 0) },
          {
            name: "Electrical & Lighting",
            value: parseFloat(data.elec_light || 0),
          },
          { name: "Sanitary", value: parseFloat(data.sanitary || 0) },
          { name: "Wardrobes", value: parseFloat(data.wardrobes || 0) },
          { name: "Wall Putty", value: parseFloat(data.wall_putty || 0) },
          { name: "Painting", value: parseFloat(data.painting || 0) },
        ];

        const total = rawPieData.reduce((sum, item) => sum + item.value, 0);

        const dataWithRemainder =
          total < 100
            ? [
                ...rawPieData,
                { name: "Remaining", value: 100 - total, fill: "#eee" },
              ]
            : rawPieData;

        const filteredData = dataWithRemainder.filter((item) => item.value > 0);

        setPieChartData(filteredData);
      } catch (error) {
        console.error("Failed to fetch project data:", error);
      } finally {
        setLoading(false);
      }
    };

    if (uid) {
      fetchProjectData();
    }
  }, [uid]);

  return (
    <>
      <div className="container graphContainer">
        <h4 className="my-projects-heading">Project Progress</h4>

        <div className="row graphsRow">
          {loading ? (
            <div
              style={{
                display: "flex",
                justifyContent: "center",
                alignItems: "center",
                height: 350,
                width: "100%",
              }}
            >
              <Loader />
            </div>
          ) : (
            (() => {
              const filteredData = pieChartData.filter(
                (entry) => entry.name !== "Remaining" && entry.value > 0
              );

              if (filteredData.length === 0) {
                return (
                  <div className="d-flex justify-content-center w-100">
                    <img
                      src="assets/images/noDataFound.png"
                      width={"200"}
                      alt="No Data Found"
                    />
                  </div>
                );
              }

              return (
                <>
                  <div className="project-graphs-container col-md-5">
                    <div className="my-projects-container">
                      <PieChart width={350} height={350}>
                        <Pie
                          data={pieChartData}
                          labelLine={false}
                          label={renderCustomizedLabel}
                          fill="#8884d8"
                          dataKey="value"
                          nameKey="name"
                        >
                          {pieChartData.map((entry, index) => (
                            <Cell
                              key={`cell-${index}`}
                              fill={entry.fill || COLORS[index % COLORS.length]}
                            />
                          ))}
                        </Pie>
                      </PieChart>

                      <div className="chartItems">
                        {pieChartData
                          .filter(
                            (item) =>
                              item.value > 0 && item.name !== "Remaining"
                          )
                          .map((item) => {
                            const colorIndex = pieChartData.findIndex(
                              (d) => d.name === item.name
                            );
                            return (
                              <div className="chartItem" key={item.name}>
                                <div
                                  className="colorBlock"
                                  style={{
                                    backgroundColor:
                                      COLORS[colorIndex % COLORS.length],
                                  }}
                                ></div>
                                <p title={item.name}>{item.name}</p>
                              </div>
                            );
                          })}
                      </div>
                    </div>
                  </div>

                  {projectData && (
                    <div className="col-md-7 task-speedometer-container">
                      {[
                        { key: "false_ceiling", label: "False Ceiling" },
                        { key: "elec_light", label: "Electrical & Lighting" },
                        { key: "sanitary", label: "Sanitary" },
                        { key: "wardrobes", label: "Wardrobes" },
                        { key: "wall_putty", label: "Wall Putty" },
                        { key: "painting", label: "Painting" },
                      ]
                        .filter(
                          (item) => parseFloat(projectData[item.key] || 0) > 0
                        )
                        .map((item) => (
                          <div className="col-md-4" key={item.key}>
                            <div className="task">
                              <GaugeChart
                                id={item.key}
                                className="graph-chart"
                                nrOfLevels={30}
                                arcsLength={[0.3, 0.3, 0.3, 0.3, 0.3, 0.3]}
                                colors={[
                                  "#FF0000",
                                  "#FF7F00",
                                  "#FFBF00",
                                  "#FFFF00",
                                  "#ADFF2F",
                                  "#00FF00",
                                ]}
                                percent={
                                  parseFloat(projectData[item.key]) / 100
                                }
                                arcPadding={0.02}
                                textColor="#000000"
                                arcWidth={0.1}
                                cornerRadius={0}
                                needleColor="#000"
                                needleBaseColor="#000"
                                needleScale={0.85}
                                hideNeedle={false}
                              />
                              <p className="mererTitle" title={item.label}>
                                {item.label}
                              </p>
                            </div>
                          </div>
                        ))}
                    </div>
                  )}
                </>
              );
            })()
          )}
        </div>
      </div>
    </>
  );
};

export default TrackProject;

// <>
//   <div className="container">
//     <h4 className="my-projects-heading">Project Progress</h4>
//     <div className="row graphsRow">
//       <div className="project-graphs-container col-md-5">
//         <div className="my-projects-container">
//           {loading ? (
//             <div
//               style={{
//                 display: "flex",
//                 justifyContent: "center",
//                 alignItems: "center",
//                 height: 350,
//               }}
//             >
//               <Loader />
//             </div>
//           ) : (
//             (() => {
//               const filteredData = pieChartData.filter(
//                 (entry) => entry.name !== "Remaining" && entry.value > 0
//               );
//               if (filteredData.length === 0) {
//                 return (
//                   <div className="d-flex justify-content-center">
//                     {" "}
//                     <img
//                       src="assets/images/noDataFound.png"
//                       width={"200"}
//                       alt=""
//                     />
//                   </div>
//                 );
//               }

//               return (
//                 <PieChart width={350} height={350}>
//                   <Pie
//                     data={pieChartData}
//                     labelLine={false}
//                     label={renderCustomizedLabel}
//                     fill="#8884d8"
//                     dataKey="value"
//                     nameKey="name"
//                   >
//                     {pieChartData.map((entry, index) => (
//                       <Cell
//                         key={`cell-${index}`}
//                         fill={entry.fill || COLORS[index % COLORS.length]}
//                       />
//                     ))}
//                   </Pie>
//                 </PieChart>
//               );
//             })()
//           )}

//           <div className="chartItems">
//             {pieChartData
//               .filter((item) => item.value > 0 && item.name !== "Remaining")
//               .map((item) => {
//                 const colorIndex = pieChartData.findIndex(
//                   (d) => d.name === item.name
//                 );
//                 return (
//                   <div className="chartItem" key={item.name}>
//                     <div
//                       className="colorBlock"
//                       style={{
//                         backgroundColor: COLORS[colorIndex % COLORS.length],
//                       }}
//                     ></div>
//                     <p title={item.name}>{item.name}</p>
//                   </div>
//                 );
//               })}
//           </div>
//         </div>
//       </div>
//       {projectData && (
//         <div className="col-md-7 task-speedometer-container">
//           {[
//             { key: "false_ceiling", label: "False Ceiling" },
//             { key: "elec_light", label: "Electrical & Lighting" },
//             { key: "sanitary", label: "Sanitary" },
//             { key: "wardrobes", label: "Wardrobes" },
//             { key: "wall_putty", label: "Wall Putty" },
//             { key: "painting", label: "Painting" },
//           ]
//             .filter((item) => parseFloat(projectData[item.key] || 0) > 0)
//             .map((item) => (
//               <div className="col-md-4" key={item.key}>
//                 <div className="task">
//                   <GaugeChart
//                     id={item.key}
//                     className="graph-chart"
//                     nrOfLevels={30}
//                     arcsLength={[0.3, 0.3, 0.3, 0.3, 0.3, 0.3]}
//                     colors={[
//                       "#FF0000",
//                       "#FF7F00",
//                       "#FFBF00",
//                       "#FFFF00",
//                       "#ADFF2F",
//                       "#00FF00",
//                     ]}
//                     percent={parseFloat(projectData[item.key]) / 100}
//                     arcPadding={0.02}
//                     textColor="#000000"
//                     arcWidth={0.1}
//                     cornerRadius={0}
//                     needleColor="#000" // change needle color
//                     needleBaseColor="#000" // change needle base circle color
//                     needleScale={0.85} // make needle shorter (0.1 → very short, 1 → full radius)
//                     hideNeedle={false}
//                   />
//                   <p className="mererTitle">{item.label}</p>
//                 </div>
//               </div>
//             ))}
//         </div>
//       )}
//     </div>
//   </div>
// </>
