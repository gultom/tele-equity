<div id="policyTabs">
    <ul>
        <li><a href="#tabForm">Form</a></li>
        <li><a href="#tabPlan" onclick="Policy.checkId(Plan.loadPlanForm)">Plan</a></li>
        <li><a href="#tabBeneficiary" onclick="Policy.checkId(Beneficiary.loadPolicyBeneficiaries)">Beneficiary</a></li>
        <li><a href="#tabQuestion" onclick="Policy.checkId(Question.loadQuestions)">Questions</a></li>
        <li><a href="#tabLegals" onclick="Policy.checkId(Policy.loadLegals)">Legal Statements</a></li>
    </ul>
    <div id="tabForm"><div id="policyForm"></div></div>
    <div id="tabPlan"></div>
    <div id="tabBeneficiary"></div>
    <div id="tabQuestion"></div>
    <div id="tabLegals"></div>
</div>