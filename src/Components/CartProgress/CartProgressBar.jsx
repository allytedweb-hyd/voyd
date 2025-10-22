/* eslint-disable no-unused-vars */
import MoleculeProgressSteps, {
  MoleculeProgressStep,
  STATUSES,
} from "@s-ui/react-molecule-progress-steps";

import { FiChevronRight } from "react-icons/fi";

const CartProgressBar = () => {
  return (
    <MoleculeProgressSteps iconStepDone={<FiChevronRight />}>
      <MoleculeProgressStep label="Step 1" status="success">
        <p>Step 1 Content</p>
      </MoleculeProgressStep>

      <MoleculeProgressStep label="Step 2" status="In progress">
        <p>Step 2 Content</p>
      </MoleculeProgressStep>

      <MoleculeProgressStep label="Step 3" status="Warning">
        <p>Step 3 Content</p>
      </MoleculeProgressStep>
    </MoleculeProgressSteps>
  );
};

export default CartProgressBar;
