import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Row } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { ContractForm } from "@/Components/Forms/ContractForm/ContractForm";
import dayjs from "dayjs";

export default function EditContract({
  contract,
  customers,
  deliveries,
  tanks,
}) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.CONTRACTS_UPDATE, contract.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Kontrak Peminjaman", route: routes.CONTRACTS_INDEX },
              { name: "Ubah Kontrak Peminjaman" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Ubah Kontrak Peminjaman</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <ContractForm
                    name="edit-contract"
                    form={form}
                    onFinish={handleFinish}
                    customers={customers}
                    deliveries={deliveries}
                    tanks={tanks}
                    initialValues={{
                      ...contract,
                      from: dayjs(contract.from),
                      to: dayjs(contract.to),
                    }}
                  />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
